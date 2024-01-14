<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/', function () {
    return view('halaman_utama.index');
});

Route::get('/dashboard/penjadwalan', function () {
    return view('penjadwalan.index');
});

Route::get('/dashboard/produksi', function () {
    return view('produksi.index');
});

Route::get('/dashboard/karyawan', function () {
    return view('karyawan.index');
});
