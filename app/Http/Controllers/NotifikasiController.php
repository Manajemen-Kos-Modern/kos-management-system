<?php

namespace App\Http\Controllers;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
 

public function index()
{
    $notifikasi = Notifikasi::where('user_id', auth()->id())
        ->orderBy('waktu_kirim', 'desc')
        ->get();

    return view('notifikasi', compact('notifikasi'));
}
}
