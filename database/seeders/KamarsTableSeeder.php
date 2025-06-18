<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil 5 user id penyewa dari database
        $penyewa = DB::table('users')
            ->where('role', 'pengguna')
            ->pluck('id')
            ->take(5)
            ->toArray();

        // Daftar kamar
        $kamars = [
            ['nomor_kamar' => 'A101', 'tipe_kamar' => 'Premium',  'harga' => 1000000],
            ['nomor_kamar' => 'A102', 'tipe_kamar' => 'Premium',  'harga' => 1000000],
            ['nomor_kamar' => 'B101', 'tipe_kamar' => 'Standar',  'harga' => 750000],
            ['nomor_kamar' => 'B102', 'tipe_kamar' => 'Standar',  'harga' => 750000],
            ['nomor_kamar' => 'C101', 'tipe_kamar' => 'Ekonomis', 'harga' => 600000],
            ['nomor_kamar' => 'A103', 'tipe_kamar' => 'Premium',  'harga' => 1000000],
            ['nomor_kamar' => 'B103', 'tipe_kamar' => 'Standar',  'harga' => 750000],
            ['nomor_kamar' => 'C102', 'tipe_kamar' => 'Ekonomis', 'harga' => 600000],
            ['nomor_kamar' => 'C103', 'tipe_kamar' => 'Ekonomis', 'harga' => 600000],
            ['nomor_kamar' => 'C104', 'tipe_kamar' => 'Ekonomis', 'harga' => 600000],
        ];

        foreach ($kamars as $index => $kamar) {
            DB::table('kamars')->insert([
                'nomor_kamar' => $kamar['nomor_kamar'],
                'tipe_kamar' => $kamar['tipe_kamar'],
                'harga' => $kamar['harga'],
                'status' => $index < 5 ? 'terisi' : 'belum_terisi',
                'user_id' => $index < 5 ? $penyewa[$index] : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
