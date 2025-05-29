<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notifikasi;
use Carbon\Carbon;

class NotifikasiTableSeeder extends Seeder
{
    public function run()
    {
        Notifikasi::create([
            'user_id' => 5, // ganti dengan user_id yang ada di database Anda
            'pesan' => 'Welcome to our boarding house. Hope you enjoy your stay.',
            'status' => 'dibaca',
            'waktu_kirim' => Carbon::now(),
        ]);

        Notifikasi::create([
            'user_id' => 5, // ganti sesuai user_id yang ada
            'pesan' => 'Pembayaran Anda telah diterima.',
            'status' => 'terkirim',
            'waktu_kirim' => Carbon::parse('2025-05-25 08:23:54'),
        ]);
    }
}

