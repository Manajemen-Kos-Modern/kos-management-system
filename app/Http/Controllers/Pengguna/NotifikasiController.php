<?php

namespace App\Http\Controllers\Pengguna;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class NotifikasiController extends Controller
{
 

public function index()
{
    $notifikasi = Notifikasi::where('user_id', auth()->id())
        ->orderBy('waktu_kirim', 'desc')
        ->get();

    return view('pengguna.notifikasi', compact('notifikasi'));
}
}
