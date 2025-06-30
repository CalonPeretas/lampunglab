<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JenisGigiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembukuanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔰 Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// 📊 Dashboard (Login & Verifikasi Email Diperlukan)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Rute Untuk Pengguna yang Sudah Login
Route::middleware('auth')->group(function () {

    // 👤 Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🩺 Modul Dokter
    Route::resource('/dokter', DokterController::class);

    // 🦷 Modul Jenis Gigi
    Route::resource('/jenis-gigi', JenisGigiController::class);

    // 💳 Modul Transaksi
    Route::get('/transaksi/print-filter', [TransaksiController::class, 'cetakFilter'])->name('transaksi.print.filter');
    Route::get('/transaksi/rekap', [TransaksiController::class, 'rekap'])->name('transaksi.rekap');
    Route::get('/transaksi/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
    Route::get('/transaksi/{transaksi}/nota', [TransaksiController::class, 'cetakNota'])->name('transaksi.nota');
    Route::resource('/transaksi', TransaksiController::class);

    // 📚 Modul Pembukuan
    Route::resource('/pembukuan', PembukuanController::class)->except(['show']);
    Route::get('/pembukuan/print', [PembukuanController::class, 'print'])->name('pembukuan.print');
});

// 🛡️ Autentikasi (Login, Register, dll)
require __DIR__.'/auth.php';
