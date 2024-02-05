<?php

namespace App\Http\Controllers;

use App\Models\DetailProduksi;
use App\Models\Estimasi;
use App\Models\ModelProduk;
use App\Models\Penjadwalan as ModelsPenjadwalan;
use App\Models\Produksi;
use App\Models\Proses;
use DateTime;

class PenjadwalanController extends Controller
{
    public function index()
    {
        $jadwalProduksi = $this->hitungJadwalProduksi();
        return view('penjadwalan.index', compact('jadwalProduksi'));
    }

    public function generateProductionSchedule()
    {
        $schedule = [];
        $models = ModelProduk::with(['proses' => function ($query) {
            $query->orderByRaw("FIELD(proses, 'layer', 'pole frame', 'press body', 'press full', 'finishing')");
        }])->get();

        foreach ($models as $model) {
            $smaCounts = Estimasi::where('model_produk_id', $model->id)
                ->orderBy('bulan_estimasi', 'asc')
                ->get(['bulan_estimasi', 'jumlah', 'id']);

            foreach ($smaCounts as $sma) {
                $currentDate = new DateTime($sma->bulan_estimasi);
                $workStart = new DateTime($currentDate->format('Y-m-d') . ' 08:00');
                $workEnd = new DateTime($currentDate->format('Y-m-d') . ' 16:00');
                $lunchStart = new DateTime($currentDate->format('Y-m-d') . ' 12:00');
                $lunchEnd = new DateTime($currentDate->format('Y-m-d') . ' 13:00');
                $currentProcessStart = clone $workStart;

                for ($i = 0; $i < $sma->jumlah; $i++) {
                    foreach ($model->proses as $proses) {
                        if ($currentProcessStart >= $lunchStart && $currentProcessStart < $lunchEnd) {
                            $currentProcessStart = clone $lunchEnd;
                        }

                        if ($currentProcessStart >= $workEnd) {
                            $currentDate->modify('+1 weekday');
                            $currentProcessStart = new DateTime($currentDate->format('Y-m-d') . ' 08:00');
                            $workEnd = new DateTime($currentDate->format('Y-m-d') . ' 16:00');
                            $lunchStart = new DateTime($currentDate->format('Y-m-d') . ' 12:00');
                            $lunchEnd = new DateTime($currentDate->format('Y-m-d') . ' 13:00');
                        }

                        $endTime = clone $currentProcessStart;
                        $endTime->modify("+{$proses->estimasi} minutes");

                        $schedule[] = [
                            'bulan' => $currentDate->format('Y-m'),
                            'model' => $model->model,
                            'proses' => $proses->proses,
                            'start' => $currentProcessStart->format('Y-m-d H:i'),
                            'end' => $endTime->format('Y-m-d H:i')
                        ];
                        ModelsPenjadwalan::where('estimasi_id', $sma->id)
                            ->first();
                        $produksi = Produksi::where('estimasi_id', $sma->id)
                            ->first();
                        $uuid =  $this->generateUUID();
                        // masukan ke dalam penjadwalan table

                        ModelsPenjadwalan::create([
                            'uuid' => $uuid,
                            'estimasi_id' => $sma->id,
                            'proses_id' => $proses->id,
                            'jadwal_start' => $currentProcessStart->format('Y-m-d H:i'),
                            'jadwal_end' => $endTime->format('Y-m-d H:i'),
                        ]);
                        DetailProduksi::create([
                            'estimasi_id' => $sma->id,
                            'jumlah_produksi' => $sma->jumlah,
                            'produksi_id' => $produksi->id,
                            'penjadwalan_id' => $uuid,
                        ]);

                        $currentProcessStart = $endTime;
                    }
                }
            }
        }
        return  redirect()->route('produksi.index')->with('success', 'Penjadwalan berhasil dibuat');
    }

    public function getPenjadwalan($idEstimasi = null)
    {
        // ambil tanggal estimasi table
        $estimasi = Estimasi::where('id', $idEstimasi)->first();
        // mulai pada tanggal estimasi dan diawal bulan tanggal 1
        $today = new DateTime($estimasi->bulan_estimasi);
        $today->modify('first day of this month');
        $today = $today->format('Y-m-d');

        // ambil data penjadwalan berdasarkan estimasi_id
        $penjadwalan = DetailProduksi::where('estimasi_id', $idEstimasi)
            ->with(['estimasi.modelProduk.proses' => function ($query) {
                $query->orderByRaw("FIELD(proses, 'layer', 'pole frame', 'press body', 'press full', 'finishing')");
            }])
            ->first();


        // Jika tidak ada penjadwalan atau proses, kembali ke view dengan pesan error
        if (is_null($penjadwalan) || is_null($penjadwalan->estimasi->modelProduk->proses)) {
            // kirim pesan error ke view
            return view('penjadwalan.index', ['error' => 'Tidak ada penjadwalan atau proses ditemukan.']);
        }

        $penjadwalanHariIni = ModelsPenjadwalan::where('jadwal_start', 'like', "%{$today}%")
            ->where('estimasi_id', $idEstimasi)
            ->get();

        $prosesRecords = $penjadwalan->estimasi->modelProduk->proses;

        $jadwal = [];
        foreach ($prosesRecords as $proses) {
            $jadwalItem = $penjadwalanHariIni->first(function ($item) use ($proses) {

                return $item->proses_id == $proses['id'];
            });

            if (!$jadwalItem) {
                // Log or handle the error that no jadwalItem was found for this proses
                continue;
            }
            $start = new DateTime($jadwalItem->jadwal_start);
            $end = new DateTime($jadwalItem->jadwal_end);
            $detail_produksi = DetailProduksi::where('id', $penjadwalan->estimasi_id)->first();


            $jadwal[] = [
                'proses' => $proses['proses'], // Assuming 'proses' is the correct field name
                'start' => $start->format('H:i'),
                'end' => $end->format('H:i'),
                'action' => 'Tentukan Action',
                'estimasi_id' => $penjadwalan->estimasi_id,
                'status' => $detail_produksi,
            ];
        }
        return  view('penjadwalan.index', [
            'jadwal' => $jadwal,
            'tanggal' => $start->format('F, d Y'),
        ]);
    }

    public function changeStatusProduksi($id)
    {
        $penjadwalan = ModelsPenjadwalan::where('uuid', $id)->first();
        //  cek apakah ada
        if ($penjadwalan == null) {
            return  redirect()->route('produksi.index')->with('error', 'Penjadwalan tidak ditemukan');
        }
        // update status
        $penjadwalan->status = 1;
        // redirect ke halaman sebellumnnya
        return  redirect()->route('produksi.index')->with('success', 'Penjadwalan berubah berhasil dibuat');
    }

    private function generateUUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
