<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pemeliharaan;

class PemeliharaanTableSeeder extends Seeder
{
    public function run()
    {
        Pemeliharaan::create([
            'kamar_id' => 1,
            'status' => 'dijadwalkan',
            'keterangan' => 'Pengecekan listrik',
        ]);
    }
}

