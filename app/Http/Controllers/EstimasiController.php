<?php

namespace App\Http\Controllers;

use App\Models\Estimasi;
use App\Http\Requests\StoreEstimasiRequest;
use App\Http\Requests\UpdateEstimasiRequest;
use App\Models\DetailProduksi;
use App\Models\ModelProduk;
use App\Models\Produksi;
use DateTime;
use Illuminate\Http\Request;

class EstimasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estimasi = Estimasi::latest()->get();
        return view('estimasi.index', compact('estimasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modelProduk = ModelProduk::all();
        return view('estimasi.create', [
            'modelProduk' => $modelProduk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bln_estimasi = new DateTime($request->bln_estimasi);
        $estimasi = Estimasi::create([
            'model_produk_id' => $request->model_produk_id,
            'jumlah' => $request->jumlah,
            "user_id" => auth()->user()->id,
            'bulan_estimasi' => $bln_estimasi->format('F Y'),
            'rasio' => $request->rasio,
        ]);
        Produksi::create([
            'model_produk' => $estimasi->modelProduk->model,
            'bulan_produksi' => $request->bln_estimasi,
            'estimasi_id' => $estimasi->id,
            'status' => 0,
        ]);
        return redirect()->route('estimasi.index');
    }

    public function singleMovingAvgJSON($model_produk_id, $bln_estimasi)
    {
        // Inisialisasi nilai SMA awal
        $singleMovingAvg = 0;
        $bln_estimasi = new DateTime($bln_estimasi);


        // Mengambil data estimasi
        $estimasi = Estimasi::where('model_produk_id', $model_produk_id)
            ->where('bulan_estimasi', '<', $bln_estimasi->format('F Y'))
            ->orderBy('bulan_estimasi', 'desc')
            ->take(4)
            ->get();

        // Periksa apakah data cukup untuk menghitung SMA (minimal 3 data bulan sebelumnya)
        if ($estimasi->count() == 4) {
            // Hitung SMA
            $singleMovingAvg = $this->singleMovingAvg($estimasi->pluck('jumlah')->toArray(), 4);
            // Pembulatan ke atas
        }

        return response()->json([
            'jumlah' =>  ceil($singleMovingAvg),
            'rasio' => $singleMovingAvg,
        ]);
    }

    private function singleMovingAvg($data, $n)
    {
        $sum = array_sum($data);
        return $sum / $n;
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimasi $estimasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $modelProduk = ModelProduk::all();
        $estimasi = Estimasi::find($id);
        return view('estimasi.edit', [
            'estimasi' => $estimasi,
            'modelProduk' => $modelProduk,
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estimasi = Estimasi::find($id);
        if ($estimasi != null) {
            // edit estimasi
            $bln_estimasi = new DateTime($request->bln_estimasi);
            $estimasi->jumlah = $request->jumlah;
            $estimasi->bulan_estimasi = $bln_estimasi->format('F Y');
            $estimasi->update();
        } else {
            return view('estimasi.index')->with('error', 'Data tidak ditemukan');
        }
        return redirect()->route('estimasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estimasi = Estimasi::find($id);
        if ($estimasi != null) {
            $estimasi->delete();
            $findProduksi = Produksi::where('estimasi_id', $id)->first();
            if ($findProduksi != null) {
                $findProduksi->delete();
            }
        } else {
            return view('estimasi.index')->with('error', 'Data tidak ditemukan');
        }
        return redirect()->route('estimasi.index');
    }
}
