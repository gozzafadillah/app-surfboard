<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanProduksiController extends Controller
{
    public function index()
    {
        return view('laporan_produksi.index');
    }
}
