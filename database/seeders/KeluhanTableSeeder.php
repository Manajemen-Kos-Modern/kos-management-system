<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Keluhan;

class KeluhanTableSeeder extends Seeder
{
    public function run()
    {
        Keluhan::create([
            'user_id' => 2,
            'kamar_id' => 2,
            'keterangan' => 'AC tidak dingin',
            'status' => 'pending',
            'jenis_keluhan' => 'Fasilitas',
        ]);
    }
}

