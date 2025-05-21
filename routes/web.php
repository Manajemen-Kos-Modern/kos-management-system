<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\RoomManagementController;
use App\Http\Controllers\Owner\TenantManagementController;
use App\Http\Controllers\Owner\PaymentManagementController;
use App\Http\Controllers\Owner\MaintenanceScheduleController;
use App\Http\Controllers\Owner\NotificationController;
use App\Http\Controllers\Owner\ComplaintManagementController;
use App\Http\Controllers\Owner\FinancialReportController;

Route::get('/', function () {return view('index', ['title' => 'Welcome']); });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Dashboard Owner
Route::get('/dashboard-own', [DashboardController::class, 'index'])->name('dashboard');

// Manajemen Kamar Owner
Route::get('/manajemen-kamar-own', [RoomManagementController::class, 'index'])->name('manajemenKamar.index');
Route::get('/manajemen-kamar-own/create', [RoomManagementController::class, 'create'])->name('manajemenKamar.create');
Route::post('/manajemen-kamar-own', [RoomManagementController::class, 'store'])->name('manajemenKamar.store');
Route::get('/manajemen-kamar-own/{kamar}/edit', [RoomManagementController::class, 'edit'])->name('manajemenKamar.edit');
Route::put('/manajemen-kamar-own/{kamar}', [RoomManagementController::class, 'update'])->name('manajemenKamar.update');
Route::get('/manajemen-kamar-own/{kamar}/delete', [RoomManagementController::class, 'delete'])->name('manajemenKamar.delete');
Route::delete('/manajemen-kamar-own/{kamar}', [RoomManagementController::class, 'destroy'])->name('manajemenKamar.destroy');

// Manajemen Penyewa Owner
Route::get('/manajemen-penyewa-own', [TenantManagementController::class, 'index'])->name('manajemenPenyewa.index');
Route::get('/manajemen-penyewa-own/create', [TenantManagementController::class, 'create'])->name('manajemenPenyewa.create');
Route::post('/manajemen-penyewa-own', [TenantManagementController::class, 'store'])->name('manajemenPenyewa.store');
Route::get('/manajemen-penyewa-own/{penyewa}/edit', [TenantManagementController::class, 'edit'])->name('manajemenPenyewa.edit');
Route::put('/manajemen-penyewa-own/{penyewa}', [TenantManagementController::class, 'update'])->name('manajemenPenyewa.update');
Route::get('/manajemen-penyewa-own/{penyewa}/delete', [TenantManagementController::class, 'delete'])->name('manajemenPenyewa.delete');
Route::delete('/manajemen-penyewa-own/{penyewa}', [TenantManagementController::class, 'destroy'])->name('manajemenPenyewa.destroy');

// Manajemen Pembayaran Owner
Route::get('/manajemen-pembayaran-own', [PaymentManagementController::class, 'index'])->name('manajemenPembayaran.index');
Route::get('/manajemen-pembayaran-own/verify/{id}', [PaymentManagementController::class, 'verify'])->name('manajemenPembayaran.verify');
Route::get('/manajemen-pembayaran-own/cancel/{id}', [PaymentManagementController::class, 'cancel'])->name('manajemenPembayaran.cancel');
Route::get('/payments/view-file/{id}', [PaymentManagementController::class, 'viewFile'])->name('manajemenPembayaran.viewFile');

// Jadwal Pemeliharaan Owner
Route::get('/jadwal-pemeliharaan-own', [MaintenanceScheduleController::class, 'index'])->name('jadwalPemeliharaan.index');
Route::get('/jadwal-pemeliharaan-own/create', [MaintenanceScheduleController::class, 'create'])->name('jadwalPemeliharaan.create');
Route::post('//jadwal-pemeliharaan-own', [MaintenanceScheduleController::class, 'store'])->name('jadwalPemeliharaan.store');
Route::get('/jadwal-pemeliharaan-own/{pemeliharaan}', [MaintenanceScheduleController::class, 'show'])->name('jadwalPemeliharaan.show');
Route::get('/jadwal-pemeliharaan-own/{pemeliharaan}/edit', [MaintenanceScheduleController::class, 'edit'])->name('jadwalPemeliharaan.edit');
Route::put('/jadwal-pemeliharaan-own/{pemeliharaan}', [MaintenanceScheduleController::class, 'update'])->name('jadwalPemeliharaan.update');
Route::get('/jadwal-pemeliharaan-own/{pemeliharaan}/delete', [MaintenanceScheduleController::class, 'delete'])->name('jadwalPemeliharaan.delete');
Route::delete('/jadwal-pemeliharaan-own/{pemeliharaan}', [MaintenanceScheduleController::class, 'destroy'])->name('jadwalPemeliharaan.destroy');


// Notifikasi Owner
Route::get('/notifikasi-own', [TenantManagementController::class, 'index'])->name('manajemenPenyewa.index');

// Keluhan Owner
Route::get('/keluhan-own', [ComplaintManagementController::class, 'index'])->name('manajemenKeluhan.index');
Route::get('/keluhan-own/create', [ComplaintManagementController::class, 'create'])->name('manajemenKeluhan.create');
Route::post('/keluhan-own', [ComplaintManagementController::class, 'store'])->name('manajemenKeluhan.store');
Route::get('/keluhan-own/{keluhan}', [ComplaintManagementController::class, 'show'])->name('manajemenKeluhan.show');
Route::get('/keluhan-own/{keluhan}/edit', [ComplaintManagementController::class, 'edit'])->name('manajemenKeluhan.edit');
Route::put('/keluhan-own/{keluhan}', [ComplaintManagementController::class, 'update'])->name('manajemenKeluhan.update');
Route::put('/keluhan-own/{keluhan}/status', [ComplaintManagementController::class, 'updateStatus'])->name('manajemenKeluhan.updateStatus');
Route::delete('/keluhan-own/{keluhan}', [ComplaintManagementController::class, 'destroy'])->name('manajemenKeluhan.destroy');


// Laporan Keuangan
Route::get('/laporan-keuangan-own', [TenantManagementController::class, 'index'])->name('manajemenPenyewa.index');