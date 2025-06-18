<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keluhan;
use App\Models\Kontrak;
use Illuminate\Support\Arr;

class KeluhansTableSeeder extends Seeder
{
    public function run(): void
    {
        $jenisKeluhan = ['Listrik', 'AC', 'Air', 'Fasilitas', 'Kebersihan', 'Internet'];
        $statusList = ['diterima', 'proses', 'selesai'];
        $keteranganList = [
            'Lampu sering mati.',
            'AC tidak dingin.',
            'Air keran tidak mengalir.',
            'Tempat tidur goyang.',
            'Kamar bau meskipun dibersihkan.',
            'Koneksi internet putus-putus.',
            'Toilet mampet.',
            'Kunci pintu rusak.',
        ];

        $kontraks = Kontrak::with('user', 'kamar')->get();

        foreach ($kontraks as $kontrak) {
            // Tiap user/kamar punya 1-3 keluhan
            $keluhanCount = rand(1, 3);
            for ($i = 0; $i < $keluhanCount; $i++) {
                Keluhan::create([
                    'user_id'       => $kontrak->user_id,
                    'kamar_id'      => $kontrak->kamar_id,
                    'jenis_keluhan' => Arr::random($jenisKeluhan),
                    'keterangan'    => Arr::random($keteranganList),
                    'status'        => Arr::random($statusList),
                ]);
            }
        }
    }
}
