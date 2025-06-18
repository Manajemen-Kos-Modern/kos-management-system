<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KontraksTableSeeder extends Seeder
{
    public function run(): void
    {
        $penyewa = DB::table('users')->where('role', 'pengguna')->pluck('id')->take(5)->toArray();
        $kamarsTerisi = DB::table('kamars')->where('status', 'terisi')->pluck('id')->take(5)->toArray();

        // Data tanggal mulai dan selesai yang beda-beda
        $tanggalMulaiArr = [
            Carbon::now()->subMonths(3),
            Carbon::now()->subMonths(2),
            Carbon::now()->subMonth(),
            Carbon::now()->subDays(15),
            Carbon::now()->subDays(7),
        ];

        $tanggalSelesaiArr = [
            Carbon::now()->addMonth(),
            Carbon::now()->addMonths(2),
            Carbon::now()->addMonths(3),
            Carbon::now()->addWeeks(6),  // 1.5 bulan kira2 6 minggu
            Carbon::now()->addMonth(),
        ];

        for ($i = 0; $i < 5; $i++) {
            DB::table('kontraks')->insert([
                'user_id' => $penyewa[$i],
                'kamar_id' => $kamarsTerisi[$i],
                'tanggal_mulai' => $tanggalMulaiArr[$i]->toDateString(),
                'tanggal_selesai' => $tanggalSelesaiArr[$i]->toDateString(),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
