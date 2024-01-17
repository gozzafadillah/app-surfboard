<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Estimasi;
use App\Models\ModelProduk;
use App\Models\P_Produksi;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produksi = Produksi::all();
        return view('produksi.index', compact('produksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modelProduk = ModelProduk::all();
        return view('produksi.create', compact('modelProduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'model_produk_id' => 'required',
                'produksi' => 'required',
                'tgl_produksi' => 'required',
                'jumlah_produksi' => 'required|numeric',
            ]);

            $kode = $this->makeKode($request->produksi);

            $produksi = Produksi::create([
                'model_produk_id' => $request->model_produk_id,
                'produksi' => $request->produksi,
                'kode_produksi' => $kode,
            ]);

            Estimasi::create([
                'kode_produksi' => $kode,
                'model_produksi' => $request->produksi,
                'bulan_estimasi' => $request->tgl_produksi,
            ]);

            P_Produksi::create([
                'kode_produksi' => $kode,
                'tgl_produksi' => $request->tgl_produksi,
                'jumlah_produksi' => $request->jumlah_produksi,
                'produksi_id' => $produksi->id,
                'estimasi_id' => $produksi->id,
            ]);


            return redirect()->route('produksi.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('produksi.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    public function scheduleProduction($productions)
    {
        $totalProcessingTime = [];

        foreach ($productions as $production) {
            $model = $production['Model'];
            $totalTime = 0;

            $totalTime += strtotime($production['Size']);
            $totalTime += strtotime($production['Layer']);
            $totalTime += strtotime($production['Pole Frame']);
            $totalTime += strtotime($production['Press Body']);
            $totalTime += strtotime($production['Press full']);
            $totalTime += strtotime($production['Finishing']);

            $totalProcessingTime[$model] = $totalTime;
        }

        asort($totalProcessingTime);

        return $totalProcessingTime;
    }


    private function makeKode($model)
    {
        $kode = explode(' ', $model);
        $kode = implode('-', $kode);
        return strtolower($kode);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $produksi = Produksi::findOrFail($id);
            return view('produksi.show', compact('produksi'));
        } catch (\Throwable $th) {
            return redirect()->route('produksi.index')->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $produksi = Produksi::findOrFail($id);
            return view('produksi.edit', compact('produksi'));
        } catch (\Throwable $th) {
            return redirect()->route('produksi.index')->with('error', 'Data tidak ditemukan');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kode_produksi' => 'required',
                'model_produksi' => 'required',
                'tgl_produksi' => 'required',
            ]);

            $produksi = Produksi::findOrFail($id);
            $produksi->update([
                'kode_produksi' => $request->kode_produksi,
                'model_produksi' => $request->model_produksi,
                'tgl_produksi' => $request->tgl_produksi,
            ]);

            return redirect()->route('produksi.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('produksi.index')->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $produksi = Produksi::findOrFail($id);
            $produksi->delete();
            return redirect()->route('produksi.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('produksi.index')->with('error', 'Data gagal dihapus');
        }
    }
}
