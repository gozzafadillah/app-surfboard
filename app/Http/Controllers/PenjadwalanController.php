<?php

namespace App\Http\Controllers;

use App\Models\DetailProduksi;
use App\Models\Estimasi;
use App\Models\ModelProduk;
use App\Models\penjadwalan;
use App\Models\Penjadwalan as ModelsPenjadwalan;
use App\Models\Produksi;
use App\Models\Proses;
use DateTime;
use Illuminate\Http\Request;

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

        return response()->json($schedule);
    }

    public function getPenjadwalan($idEstimasi = null)
    {
        //    ambil tanggal hari ini
        $today = date('Y-m-d');
        //    ambil data detail_produksi
        $penjadwalan = DetailProduksi::where('estimasi_id', $idEstimasi)
            ->with(['estimasi' => function ($query) {
                $query->with('modelProduk');
            }])
            ->first();
        //    ambil data proses
        $proses = Proses::where('model_id', $penjadwalan->estimasi->model_produk_id)
            ->orderByRaw("FIELD(proses, 'layer', 'pole frame', 'press body', 'press full', 'finishing')")
            ->get();
        //    ambil data penjadwalan untuk hari ini
        $penjadwalanHariIni = ModelsPenjadwalan::where('jadwal_start', 'like', "%{$today}%")
            ->where('estimasi_id', $penjadwalan->estimasi_id)->with('estimasi')
            ->get();

        foreach ($penjadwalanHariIni as $jadwalHariIni) {
            // Asumsikan bahwa 'proses' adalah relasi yang sudah terurut sesuai dengan proses pengerjaan
            // dan kita ingin menampilkan nama dari setiap proses dalam jadwal.
            $prosesList = $jadwalHariIni->estimasi->modelProduk->proses->map(function ($proses) {
                return $proses->nama; // Ganti 'nama' dengan nama kolom yang menyimpan nama proses
            })->implode(', ');

            $jadwal[] = [
                'start' => $jadwalHariIni->jadwal_start,
                'end' => $jadwalHariIni->jadwal_end,
                'proses' => $prosesList,
            ];
        }



        $data = [
            'penjadwalan' => $penjadwalan,
            'proses' => $proses,
            'jadwal' => $jadwal
        ];


        return view('penjadwalan.index', [
            'data' => $data
        ]);
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
