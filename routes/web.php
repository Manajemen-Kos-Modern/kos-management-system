<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemeliharaanController;


// Halaman utama
Route::get('/', function () {
    return view('index', ['title' => 'Welcome']);
});

// ==========================
// AUTH USER
// ==========================
Route::get('pengguna/login', [AuthController::class, 'showLoginForm'])->name('pengguna.login');
Route::post('pengguna/login', [AuthController::class, 'login'])->name('pengguna.login.post');

Route::get('pengguna/register', [AuthController::class, 'showRegisterForm'])->name('pengguna.register');
Route::post('pengguna/register', [AuthController::class, 'register'])->name('pengguna.register.post');

// ==========================
// AUTH ADMIN
// ==========================
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// ==========================
// AUTH PEMILIK
// ==========================
Route::get('/pemilik/login', [AuthController::class, 'showPemilikLoginForm'])->name('pemilik.login');
Route::post('/pemilik/login', [AuthController::class, 'pemilikLogin']);

// ==========================
// DASHBOARD (semua butuh auth)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengguna/dashboard', [DashboardController::class, 'index'])->name('pengguna.dashboard');

    Route::get('/admin/dashboard', function () {
        return Auth::user()->role === 'admin'
            ? view('admin.dashboard')
            : redirect('/admin/login')->with('error', 'Anda harus login terlebih dahulu.');
    })->name('admin.dashboard');

    Route::get('/pemilik/dashboard', function () {
        return view('pemilik.dashboard');
    })->name('pemilik.dashboard');
});

// ==========================
// DETAIL KAMAR (semua yang login bisa akses)
// ==========================
Route::middleware('auth')->get('/dashboard/detail/{id}', [KamarController::class, 'show'])->name('detail');

// ==========================
// MANAJEMEN KAMAR (ADMIN SAJA)
// ==========================
Route::middleware('auth')->prefix('admin/kamar')->name('admin.kamar.')->group(function () {
    Route::get('/', [KamarController::class, 'index'])->name('index');
    Route::get('/create', [KamarController::class, 'create'])->name('create');
    Route::post('/', [KamarController::class, 'store'])->name('store');
    Route::get('/{kamar}/edit', [KamarController::class, 'edit'])->name('edit');
    Route::put('/{kamar}', [KamarController::class, 'update'])->name('update');
    Route::delete('/{kamar}', [KamarController::class, 'destroy'])->name('destroy');
});

// ==========================
// KELUHAN (ADMIN & PENGGUNA)
// ==========================
Route::middleware('auth')->group(function () {
    // User
    Route::get('/keluhan/create', [KeluhanController::class, 'create'])->name('keluhan.create');
    Route::post('/keluhan', [KeluhanController::class, 'store'])->name('keluhan.store');

    // Admin
    Route::prefix('admin/keluhan')->name('admin.keluhan.')->group(function () {
        Route::get('/', [KeluhanController::class, 'index'])->name('index');
        Route::patch('/{id}/status', [KeluhanController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/{id}/tanggapan', [KeluhanController::class, 'tanggapi'])->name('tanggapi');
        Route::delete('/{id}', [KeluhanController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/edit', [KeluhanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KeluhanController::class, 'update'])->name('update');
    });
});

// ==========================
// PEMBAYARAN (ADMIN SAJA)
// ==========================
Route::middleware(['auth', 'checkrole:admin'])->prefix('admin/pembayarans')->name('pembayarans.')->group(function () {
    Route::get('/', [PembayaranController::class, 'index'])->name('index');
    Route::post('/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('konfirmasi');
    Route::post('/{id}/tolak', [PembayaranController::class, 'tolak'])->name('tolak');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('pemeliharaan', PemeliharaanController::class)->except(['show', 'edit', 'update']);
});
// ==========================
// LOGOUT
// ==========================
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
