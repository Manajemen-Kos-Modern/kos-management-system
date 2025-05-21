<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function pemilik()
    {
        return view('pemilik.dashboard');
    }

    public function pengguna()
    {
        return view('pengguna.dashboard');
    }
    public function index()
    {
        // Contoh data kamar (bisa diganti dengan data dari database)
        $kamar = [
            (object) [
                'gambar' => 'https://via.placeholder.com/150',
                'nama_kamar' => 'ManKost Type A',
                'fasilitas' => 'Single Bed, Furniture',
                'kamar_mandi' => 'Kamar Mandi Dalam',
                'ac' => 'AC',
                'tv' => 'TV',
            ],
            (object) [
                'gambar' => 'https://via.placeholder.com/150',
                'nama_kamar' => 'ManKost Type B',
                'fasilitas' => 'Single Bed, Furniture',
                'kamar_mandi' => 'Kamar Mandi Dalam',
                'ac' => 'AC',
                'tv' => 'TV',
            ],
            (object) [
                'gambar' => 'https://via.placeholder.com/150',
                'nama_kamar' => 'ManKost Type C',
                'fasilitas' => 'Single Bed, Furniture',
                'kamar_mandi' => 'Kamar Mandi Dalam',
                'ac' => 'AC',
                'tv' => 'TV',
            ],
        ];

        // Kirim data ke view
        return view('pengguna.dashboard', compact('kamar'));
    }
}