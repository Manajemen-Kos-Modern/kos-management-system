<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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

require __DIR__.'/auth.php';

// Authentication routes
use App\Http\Controllers\Auth\RegisterController;
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard routes
use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Kamar routes
use App\Http\Controllers\KamarController;

Route::get('/kamar/{id}', [KamarController::class, 'show'])->name('kamar.detail');

// Pemesanan routes
use App\Http\Controllers\PemesananController;
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
Route::get('/pemesanan/{id}', [PemesananController::class, 'form'])->name('pemesanan.form');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');

// Notifikasi routes
use App\Http\Controllers\NotifikasiController;
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

// Keluhan routes
use App\Http\Controllers\KeluhanController;
Route::get('/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index');
Route::get('/keluhan/form', [KeluhanController::class, 'form'])->name('keluhan.form');
Route::get('/keluhan/{id}', [KeluhanController::class, 'detail'])->name('keluhan.detail');

// Route untuk menampilkan form keluhan
Route::get('/keluhan/form', [\App\Http\Controllers\KeluhanController::class, 'form'])->name('keluhan.form');

// Route untuk menyimpan data keluhan (POST)
Route::post('/keluhan/store', [\App\Http\Controllers\KeluhanController::class, 'store'])->name('keluhan.store');

// Profile routes

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');