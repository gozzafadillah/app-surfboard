<?php

use App\Http\Controllers\AuthController;
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

Route::get('/dashboard/penjadwalan', function () {
    return view('penjadwalan.index');
});

Route::get('/dashboard/produksi', function () {
    return view('produksi.index');
});

Route::get('/dashboard/karyawan', function () {
    return view('karyawan.index');
});
