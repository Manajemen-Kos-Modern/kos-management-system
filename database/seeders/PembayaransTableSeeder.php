<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaransTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data kontrak
        $kontraks = DB::table('kontraks')->get();

        // Contoh variasi metode dan status pembayaran
        $metodePembayaran = ['cash', 'bank', 'cash', 'bank', 'cash'];
        $statusPembayaran = ['sukses', 'pending', 'gagal', 'sukses', 'pending'];

        foreach ($kontraks as $index => $kontrak) {
            // Ambil harga kamar dari kamar terkait kontrak
            $harga = DB::table('kamars')->where('id', $kontrak->kamar_id)->value('harga');

            DB::table('pembayarans')->insert([
                'kontrak_id' => $kontrak->id,
                'user_id' => $kontrak->user_id,
                'harga' => $harga,
                'metode_pembayaran' => $metodePembayaran[$index] ?? 'cash',
                'status' => $statusPembayaran[$index] ?? 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
