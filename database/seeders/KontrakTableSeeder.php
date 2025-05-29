<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kontrak;
use Carbon\Carbon;

class KontrakTableSeeder extends Seeder
{
    public function run()
    {
        Kontrak::create([
            'user_id' => 2,
            'kamar_id' => 2,
            'tanggal_mulai' => Carbon::now()->subMonth(),
            'durasi_sewa' => 6,
            'status' => 'aktif',
        ]);
    }
}
