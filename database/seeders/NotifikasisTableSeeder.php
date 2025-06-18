<?php

namespace Database\Seeders;

use App\Models\{Notifikasi, User, Pembayaran, Keluhan, Kontrak};
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class NotifikasisTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        // Notifikasi individu (pengingat kontrak hampir selesai)
        $kontraks = Kontrak::all();
        foreach ($kontraks as $kontrak) {
            if (Carbon::parse($kontrak->tanggal_selesai)->diffInDays(Carbon::now()) <= 7) {
                Notifikasi::create([
                    'user_id' => $kontrak->user_id,
                    'pesan' => "Kontrak Anda akan berakhir pada " . $kontrak->tanggal_selesai . ". Segera perpanjang.",
                    'status' => 'terkirim',
                    'waktu_kirim' => Carbon::now(),
                ]);
            }
        }

        // Notifikasi dari pembayaran sukses
        $pembayarans = Pembayaran::where('status', 'sukses')->get();
        foreach ($pembayarans as $bayar) {
            Notifikasi::create([
                'user_id' => $bayar->user_id,
                'pesan' => "Pembayaran sejumlah Rp" . number_format($bayar->harga, 0, ',', '.') . " berhasil dilakukan.",
                'status' => 'terkirim',
                'waktu_kirim' => Carbon::now()->subMinutes(rand(1, 60)),
            ]);
        }

        // Notifikasi keluhan update status
        $keluhans = Keluhan::all();
        foreach ($keluhans as $keluhan) {
            if ($keluhan->status == 'diterima') {
                $pesan = "Keluhan Anda tentang \"{$keluhan->jenis_keluhan}\" telah diterima dan sedang diproses.";
            } elseif ($keluhan->status == 'selesai') {
                $pesan = "Keluhan Anda tentang \"{$keluhan->jenis_keluhan}\" telah diselesaikan. Terima kasih atas laporannya.";
            } else {
                continue;
            }

            Notifikasi::create([
                'user_id' => $keluhan->user_id,
                'pesan' => $pesan,
                'status' => 'terkirim',
                'waktu_kirim' => Carbon::now()->subHours(rand(1, 24)),
            ]);
        }

        // Notifikasi massal
        foreach ($users as $user) {
            Notifikasi::create([
                'user_id' => $user->id,
                'pesan' => "Info penting: Akan ada pemeliharaan air pada tanggal " . Carbon::now()->addDays(1)->format('d-m-Y') . ".",
                'status' => 'terkirim',
                'waktu_kirim' => Carbon::now(),
            ]);
        }
    }
}
