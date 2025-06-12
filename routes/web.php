<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KeluhanController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Authentication routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Kamar routes
Route::get('/kamar/{id}', [KamarController::class, 'show'])->name('kamar.detail');

// Pemesanan routes
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
Route::get('/pemesanan/{id}', [PemesananController::class, 'form'])->name('pemesanan.form');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');

// Notifikasi routes
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

// Keluhan routes
Route::get('/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index');
Route::get('/keluhan/form', [KeluhanController::class, 'form'])->name('keluhan.form');
Route::get('/keluhan/{id}', [KeluhanController::class, 'detail'])->name('keluhan.detail');

// Route untuk menampilkan form keluhan
Route::get('/keluhan/form', [KeluhanController::class, 'form'])->name('keluhan.form');

// Route untuk menyimpan data keluhan (POST)
Route::post('/keluhan/store', [KeluhanController::class, 'store'])->name('keluhan.store');

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// pembayaran routes
Route::get('/riwayat-pembayaran', [PembayaranController::class, 'index'])->name('riwayat.pembayaran');

Route::get('/kontrak-saya', [PemesananController::class, 'kontrakSaya'])->name('kontrak.saya');
