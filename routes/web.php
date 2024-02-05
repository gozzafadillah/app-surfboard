<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstimasiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanProduksiController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\UsersController;
use App\Models\User;
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

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('halaman_utama.index');
})->middleware('auth');

Route::get('/dashboard/profile', [UsersController::class, 'profile']);


Route::get('/dashboard/produksi', [ProduksiController::class, 'index'])->name('produksi.index');
Route::get('/dashboard/produksi/create', [ProduksiController::class, 'create'])->name('produksi.create');
Route::post('/dashboard/produksi/create', [ProduksiController::class, 'store'])->name('produksi.store');

Route::get("/dashboard/penjadwalan/{idEstimasi}", [PenjadwalanController::class, 'getPenjadwalan']);
Route::get("/dashboard/penjadwalan/{id}/status", [PenjadwalanController::class, 'changeStatusProduksi']);

Route::get("/dashboard/produksi/generateJadwal", [PenjadwalanController::class, 'generateProductionSchedule']);

Route::get('/dashboard/estimasi', [EstimasiController::class, 'index'])->name('estimasi.index');
Route::get('/dashboard/estimasi/create', [EstimasiController::class, 'create'])->name('estimasi.create');
Route::post('/dashboard/estimasi/create', [EstimasiController::class, 'store'])->name('estimasi.store');
Route::get('/dashboard/estimasi/prediksi/{model_produk_id}/{bln_estimasi}', [EstimasiController::class, 'singleMovingAvgJSON']);
Route::get('/dashboard/estimasi/{id}', [EstimasiController::class, 'edit'])->name('estimasi.edit');
Route::put('/dashboard/estimasi/{id}/edit', [EstimasiController::class, 'update']);
Route::delete('/dashboard/estimasi/{id}/delete', [EstimasiController::class, 'destroy']);

Route::get('/dashboard/pegawai', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('/dashboard/pegawai/create', [KaryawanController::class, 'createKaryawan'])->name('karyawan.create');
Route::post('/dashboard/pegawai/create', [KaryawanController::class, 'storeKaryawan'])->name('karyawan.store');


Route::get('/dashboard/laporan-produksi', [LaporanProduksiController::class, 'index'])->name('laporan.index');
