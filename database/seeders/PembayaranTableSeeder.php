<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranTableSeeder extends Seeder
{
    public function run()
    {
        Pembayaran::create([
            'kontrak_id' => 1,
            'user_id' => 2,
            'harga' => 1500000,
            'metode_pembayaran' => 'transfer',
            'status' => 'dibayar',
        ]);
    }
}

