<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\ManajemenKamarController;
use App\Http\Controllers\ManajemenPenyewaController;

Route::get('/', function () {return view('index', ['title' => 'Welcome']); });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Dashboard Owner
Route::get('/dashboard-own', [DashboardController::class, 'index'])->name('dashboard');

// Manajemen Kamar Owner
Route::get('/manajemen-kamar-own', [ManajemenKamarController::class, 'index'])->name('manajemenKamar.index');
Route::post('/manajemen-kamar-own', [ManajemenKamarController::class, 'store'])->name('manajemenKamar.store');
Route::put('/manajemen-kamar-own/{kamar}', [ManajemenKamarController::class, 'update'])->name('manajemenKamar.update');
Route::delete('/manajemen-kamar-own/{kamar}', [ManajemenKamarController::class, 'destroy'])->name('manajemenKamar.destroy');

// Manajemen Penyewa Owner
Route::get('/manajemen-penyewa-own', [ManajemenPenyewaController::class, 'index'])->name('manajemenPenyewa.index');

// Manajemen Pembayaran Owner
Route::get('/manajemen-pembayaran-own', [ManajemenPenyewaController::class, 'index'])->name('manajemenPenyewa.index');

// Jadwal Pemeliharaan Owner
Route::get('/jadwal-pemeliharaan-own', [ManajemenPenyewaController::class, 'index'])->name('manajemenPenyewa.index');

// Notifikasi Owner
Route::get('/notifikasi-own', [ManajemenPenyewaController::class, 'index'])->name('manajemenPenyewa.index');

// Keluhan Owner
Route::get('/keluhan-own', [ManajemenPenyewaController::class, 'index'])->name('manajemenPenyewa.index');

// Laporan Keuangan
Route::get('/laporan-keuangan-own', [ManajemenPenyewaController::class, 'index'])->name('manajemenPenyewa.index');