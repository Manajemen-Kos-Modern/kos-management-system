<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\KeluhanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\PemeliharaanController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\PenyewaController;
use App\Http\Controllers\Admin\KontrakController;

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

    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('auth');
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

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
        Route::get('/create', [KeluhanController::class, 'create'])->name('create'); 
        Route::post('/', [KeluhanController::class, 'store'])->name('store');    
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
Route::middleware('auth')->prefix('admin/pembayarans')->name('admin.pembayarans.')->group(function () {
    Route::get('/', [PembayaranController::class, 'index'])->name('index');
    Route::post('/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('konfirmasi');
    Route::post('/{id}/tolak', [PembayaranController::class, 'tolak'])->name('tolak');
    Route::post('/{id}/verify', [PembayaranController::class, 'verify'])->name('verify'); // tambah ini
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('pemeliharaan', PemeliharaanController::class)->except(['show', 'edit', 'update']);
});
// ==========================
// PEMELIHARAAN (ADMIN SAJA)
// ==========================
Route::middleware('auth')->prefix('admin/pemeliharaan')->name('admin.pemeliharaan.')->group(function () {
    Route::get('/', [PemeliharaanController::class, 'index'])->name('index');
    Route::get('/create', [PemeliharaanController::class, 'create'])->name('create');
    Route::post('/', [PemeliharaanController::class, 'store'])->name('store');
    Route::get('/{pemeliharaan}/edit', [PemeliharaanController::class, 'edit'])->name('edit');
    Route::put('/{pemeliharaan}', [PemeliharaanController::class, 'update'])->name('update');
    Route::delete('/{pemeliharaan}', [PemeliharaanController::class, 'destroy'])->name('destroy');
});

// ==========================
// NOTIFIKASI (ADMIN SAJA)
// ==========================
Route::middleware('auth')->prefix('admin/notifikasi')->name('admin.notifikasi.')->group(function () {
    Route::get('/', [NotifikasiController::class, 'index'])->name('index');
    Route::get('/create', [NotifikasiController::class, 'create'])->name('create');
    Route::post('/', [NotifikasiController::class, 'store'])->name('store');
    Route::get('/{notifikasi}/edit', [NotifikasiController::class, 'edit'])->name('edit');
    Route::put('/{notifikasi}', [NotifikasiController::class, 'update'])->name('update');
    Route::delete('/{notifikasi}', [NotifikasiController::class, 'destroy'])->name('destroy');
});
// NOTIFIKASI UNTUK PENGGUNA
Route::middleware('auth')->get('/notifikasi', [NotifikasiController::class, 'userIndex'])->name('notifikasi.user');

// ==========================
// PENYEWA (ADMIN SAJA)
// ==========================
Route::middleware('auth')->prefix('admin/penyewa')->name('admin.penyewa.')->group(function () {
    Route::get('/', [PenyewaController::class, 'index'])->name('index');
    Route::get('/create', [PenyewaController::class, 'create'])->name('create');
    Route::post('/', [PenyewaController::class, 'store'])->name('store');
    Route::get('/{penyewa}/edit', [PenyewaController::class, 'edit'])->name('edit');
    Route::put('/{penyewa}', [PenyewaController::class, 'update'])->name('update');
    Route::delete('/{penyewa}', [PenyewaController::class, 'destroy'])->name('destroy');
});



Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/kontrak', [KontrakController::class, 'index'])->name('kontrak.index');
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
