<?php

namespace App\Http\Controllers;

use App\Models\Estimasi;
use App\Http\Requests\StoreEstimasiRequest;
use App\Http\Requests\UpdateEstimasiRequest;
use App\Models\Produksi;

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
        Produksi::all();
        return view('estimasi.create', [
            'produksi' => Produksi::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstimasiRequest $request)
    {
        //
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
