<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarTableSeeder extends Seeder
{
    public function run()
    {
        Kamar::create([
            'nomor_kamar' => 'A101',
            'tipe_kamar' => 'Single',
            'harga' => 1000000,
            'status' => 'kosong',
            'user_id' => null,
        ]);

        Kamar::create([
            'nomor_kamar' => 'A102',
            'tipe_kamar' => 'Single',
            'harga' => 1000000,
            'status' => 'kosong',
            'user_id' => null,
        ]);
        Kamar::create([
            'nomor_kamar' => 'A103',
            'tipe_kamar' => 'Single',
            'harga' => 1000000,
            'status' => 'kosong',
            'user_id' => null,
        ]);
        Kamar::create([
            'nomor_kamar' => 'A201',
            'tipe_kamar' => 'Double',
            'harga' => 1500000,
            'status' => 'kosong',
            'user_id' => null,
        ]);
        Kamar::create([
            'nomor_kamar' => 'A202',
            'tipe_kamar' => 'Double',
            'harga' => 1500000,
            'status' => 'terisi',
            'user_id' => 2,
        ]);
    }
}