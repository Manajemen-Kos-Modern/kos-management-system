<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KamarController;


// Rute untuk menampilkan halaman login pengguna
Route::get('pengguna/login', [AuthController::class, 'showLoginForm'])->name('pengguna.login');

// Rute untuk memproses login pengguna
Route::post('pengguna/login', [AuthController::class, 'login'])->name('pengguna.login.post');


// Rute untuk menampilkan halaman register pengguna
Route::get('pengguna/register', [AuthController::class, 'showRegisterForm'])->name('pengguna.register');

// Rute untuk memproses register pengguna
Route::post('pengguna/register', [AuthController::class, 'register'])->name('pengguna.register.post');

// Rute untuk dashboard pengguna (hanya untuk pengguna yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/pengguna/dashboard', [DashboardController::class, 'index'])->name('pengguna.dashboard');
});

// Route untuk login admin
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// Route untuk login pemilik
Route::get('/pemilik/login', [AuthController::class, 'showPemilikLoginForm'])->name('pemilik.login');
Route::post('/pemilik/login', [AuthController::class, 'pemilikLogin']);

// Route untuk dashboard pengguna
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route untuk dashboard admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // 
})->name('admin.dashboard')->middleware('auth');

// Route untuk dashboard pemilik
Route::get('/pemilik/dashboard', function () {
    return view('pemilik.dashboard'); // Mengarahkan ke dashboard.pemilik.blade.php
})->name('pemilik.dashboard')->middleware('auth');


Route::get('/dashboard/detail/{id}', [KamarController::class, 'show'])->name('detail');


// Route untuk mengelola kamar (hanya untuk admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/kamar', [KamarController::class, 'index'])->name('admin.kamar.index'); // Menampilkan daftar kamar
    Route::get('/admin/kamar/create', [KamarController::class, 'create'])->name('admin.kamar.create'); // Form tambah kamar
    Route::post('/admin/kamar', [KamarController::class, 'store'])->name('admin.kamar.store'); // Simpan kamar baru
    Route::get('/admin/kamar/{id}/edit', [KamarController::class, 'edit'])->name('admin.kamar.edit'); // Form edit kamar
    Route::put('/admin/kamar/{id}', [KamarController::class, 'update'])->name('admin.kamar.update'); // Update kamar
    Route::delete('/admin/kamar/{id}', [KamarController::class, 'destroy'])->name('admin.kamar.destroy'); // Hapus kamar
});

// Route untuk logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');