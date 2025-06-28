<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JenisGigiController;
use App\Http\Controllers\TransaksiController;

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

    // 📄 Fitur Tambahan Transaksi (letakkan SEBELUM resource)
    Route::get('/transaksi/rekap', [TransaksiController::class, 'rekap'])->name('transaksi.rekap');
    Route::get('/transaksi/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
    Route::get('/transaksi/print-filter', [TransaksiController::class, 'cetakFilter'])->name('transaksi.print.filter');
    Route::get('/transaksi/{transaksi}/nota', [TransaksiController::class, 'cetakNota'])->name('transaksi.nota');

    // 💳 Modul Transaksi (harus diletakkan setelah custom route)
    Route::resource('/transaksi', TransaksiController::class);

    // 📚 Modul Pembukuan
    Route::get('/pembukuan', [TransaksiController::class, 'pembukuan'])->name('pembukuan.index');
});


// 🛡️ Autentikasi (Login, Register, dll)
require __DIR__.'/auth.php';
