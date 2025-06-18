<?php

namespace App\Http\Controllers\Admin;


use App\Models\Kamar;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\Pemeliharaan;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();
        $kamarKosong = Kamar::where('status', 'belum_terisi')->count();
        $totalPendapatan = Pembayaran::where('status', 'sukses')->sum('harga');

        // Ambil 5 notifikasi terbaru
        $notifikasi = Notifikasi::with('user')->orderBy('waktu_kirim', 'desc')->take(5)->get();

        // Ambil 5 pemeliharaan terbaru
        $jadwalPemeliharaan = Pemeliharaan::with('kamar')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKamar',
            'kamarTerisi',
            'kamarKosong',
            'totalPendapatan',
            'notifikasi',
            'jadwalPemeliharaan'
        ));
    }
}
