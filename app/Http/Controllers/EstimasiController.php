<?php

namespace App\Http\Controllers;

use App\Models\Estimasi;
use App\Http\Requests\StoreEstimasiRequest;
use App\Http\Requests\UpdateEstimasiRequest;
use App\Models\DetailProduksi;
use App\Models\ModelProduk;
use App\Models\Produksi;
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
        $estimasi = Estimasi::create([
            'model_produk_id' => $request->model_produk_id,
            'jumlah' => $request->jumlah,
            "user_id" => auth()->user()->id,
            'bulan_estimasi' => $request->bln_estimasi,
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


        // Mengambil data estimasi
        $estimasi = Estimasi::where('model_produk_id', $model_produk_id)
            ->where('bulan_estimasi', '<', $bln_estimasi)
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
    public function edit(Estimasi $estimasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstimasiRequest $request, Estimasi $estimasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $response = Estimasi::destroy($id);
            return view('estimasi.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return view('estimasi.index')->with('error', "Data gagal dihapus, $th");
        }
    }
}
