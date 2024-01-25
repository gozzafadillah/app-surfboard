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
        $estimasi = Estimasi::all();
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
        $dataEstimasi = Estimasi::where('model_produk_id', $request->model_produk_id)->get();
        if ($dataEstimasi->count() < 4) {
            $estimasi = Estimasi::create([
                'model_produk_id' => $request->model_produk_id,
                'jumlah' => $request->jumlah,
                "user_id" => auth()->user()->id,
                'bulan_estimasi' => $request->bln_estimasi,
            ]);
            Produksi::create([
                'model_produk' => $estimasi->modelProduk->model,
                'bulan_produksi' => $request->bln_estimasi,
                'estimasi_id' => $estimasi->id,
                'status' => 0,
            ]);
            return redirect()->route('estimasi.index');
        }
        // sistem single moving average
        $estimasi = Estimasi::where('model_produk_id', $request->model_produk_id)->get();
        // ambil data 3 bulan terakhir tapi bertambah dihitung dengan bulan yang dipilih dan ambil data 3 bulan terbaru 
        // ex : jika bulan dipilih bulan juni maka diambil bulan april mei
        $estimasi = $estimasi->where('bulan_estimasi', '<', $request->bln_estimasi)->sortByDesc('bulan_estimasi')->take(3);

        $singleMovingAvg = $this->singleMovingAvg($estimasi->pluck('jumlah')->toArray(), $estimasi->count());
        // pembulatan ke atas
        $singleMovingAvg = ceil($singleMovingAvg);

        $estimasi = Estimasi::create([
            'model_produk_id' => $request->model_produk_id,
            'jumlah' => $singleMovingAvg,
            "user_id" => auth()->user()->id,
            'bulan_estimasi' => $request->bln_estimasi,
        ]);
        return redirect()->route('estimasi.index');
    }

    public function singleMovingAvgJSON(Request $request)
    {
        // sistem single moving average
        $estimasi = Estimasi::where('model_produk_id', $request->model_produk_id)->get();
        // ambil data 3 bulan terakhir tapi bertambah dihitung dengan bulan yang dipilih dan ambil data 3 bulan terbaru 
        // ex : jika bulan dipilih bulan juni maka diambil bulan april mei
        $estimasi = $estimasi->where('bulan_estimasi', '<', $request->bln_estimasi)->sortByDesc('bulan_estimasi')->take(3);

        $singleMovingAvg = $this->singleMovingAvg($estimasi->pluck('jumlah')->toArray(), $estimasi->count());
        // pembulatan ke atas
        $singleMovingAvg = ceil($singleMovingAvg);

        $estimasi = Estimasi::create([
            'model_produk_id' => $request->model_produk_id,
            'jumlah' => $singleMovingAvg,
            "user_id" => auth()->user()->id,
            'bulan_estimasi' => $request->bln_estimasi,
        ]);

        return response()->json([
            'jumlah' => $singleMovingAvg,
        ]);
    }

    private function singleMovingAvg($data, $n)
    {
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += $data[$i];
        }
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
    public function destroy(Estimasi $estimasi)
    {
        //
    }
}
