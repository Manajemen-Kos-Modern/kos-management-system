<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemeliharaan;
use App\Models\Kamar;
use Illuminate\Support\Carbon;

class PemeliharaansTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['keterangan' => 'Pengecekan listrik', 'status' => 'sedang-proses', 'hari' => 1],
            ['keterangan' => 'Perbaikan AC', 'status' => 'selesai', 'hari' => -2],
            ['keterangan' => 'Pembersihan kamar', 'status' => 'selesai', 'hari' => -1],
            ['keterangan' => 'Perbaikan pintu', 'status' => 'sedang-proses', 'hari' => 2],
            ['keterangan' => 'Pengecekan pipa air', 'status' => 'selesai', 'hari' => -3],
        ];

        $kamars = Kamar::inRandomOrder()->take(5)->get();

        foreach ($kamars as $index => $kamar) {
            Pemeliharaan::create([
                'kamar_id' => $kamar->id,
                'status' => $data[$index]['status'],
                'keterangan' => $data[$index]['keterangan'],
                'jadwal' => Carbon::now()->addDays($data[$index]['hari']),
            ]);
        }
    }
}
