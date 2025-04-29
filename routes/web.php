<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {return view('index', ['title' => 'Welcome']); });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Route untuk manajemen kamar (hanya untuk admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/kamar', [KamarController::class, 'index'])->name('admin.kamar.index'); // Menampilkan daftar kamar
    Route::get('/admin/kamar/create', [KamarController::class, 'create'])->name('admin.kamar.create'); // Form tambah kamar
    Route::post('/admin/kamar', [KamarController::class, 'store'])->name('admin.kamar.store'); // Simpan kamar baru
    Route::get('/admin/kamar/{id}/edit', [KamarController::class, 'edit'])->name('admin.kamar.edit'); // Form edit kamar
    Route::put('/admin/kamar/{id}', [KamarController::class, 'update'])->name('admin.kamar.update'); // Update kamar
    Route::delete('/admin/kamar/{id}', [KamarController::class, 'destroy'])->name('admin.kamar.destroy'); // Hapus kamar
});