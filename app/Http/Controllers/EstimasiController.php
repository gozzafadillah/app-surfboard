<?php

namespace App\Http\Controllers;

use App\Models\Estimasi;
use App\Http\Requests\StoreEstimasiRequest;
use App\Http\Requests\UpdateEstimasiRequest;
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
        // get year and month from date
        $year = date('Y');
        $month = date('m');
        if ($month == 12) {
            $month = 1;
            $year++;
        } else {
            $month++;
        }
        // change to month name
        switch ($month) {
            case 1:
                $month = 'Januari';
                break;
            case 2:
                $month = 'Februari';
                break;
            case 3:
                $month = 'Maret';
                break;
            case 4:
                $month = 'April';
                break;
            case 5:
                $month = 'Mei';
                break;
            case 6:
                $month = 'Juni';
                break;
            case 7:
                $month = 'Juli';
                break;
            case 8:
                $month = 'Agustus';
                break;
            case 9:
                $month = 'September';
                break;
            case 10:
                $month = 'Oktober';
                break;
            case 11:
                $month = 'November';
                break;
            case 12:
                $month = 'Desember';
                break;
        }
        $date = $month . ', ' . $year;
        $modelProduk = ModelProduk::all();
        return view('estimasi.create', [
            'modelProduk' => $modelProduk,
            'date' => $date
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
