<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 1 admin jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Cek berdasarkan email
            [
                'nama' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'no_hp' => '08123455678',
                'foto_profile' => 'default-admin.jpg',
                'gender' => 'L',
            ]
        );

        // Hitung jumlah pengguna non-admin yang sudah ada
        $existingUserCount = User::where('role', 'pengguna')->count();
        
        // Hanya buat pengguna baru jika jumlahnya kurang dari 5
        $newUserCount = max(0, 5 - $existingUserCount);
        if ($newUserCount > 0) {
            // Buat beberapa pengguna biasa
            User::factory($newUserCount)->create([
                'role' => 'pengguna' // Memastikan role-nya adalah pengguna
            ]);
        }

        // Buat beberapa kamar kosong tanpa pengguna
        $kamarCount = Kamar::count();
        if ($kamarCount < 10) {
            $additionalKamarCount = 10 - $kamarCount;
            
            // Buat kamar satu per satu untuk menangani masalah
            for ($i = 0; $i < $additionalKamarCount; $i++) {
                $kamar = new Kamar();
                $kamar->nomor_kamar = 'K' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);
                $kamar->tipe_kamar = $this->getRandomTipeKamar();
                $kamar->harga = $this->getHargaByTipe($kamar->tipe_kamar);
                $kamar->status = 'belum_terisi';
                $kamar->gambar_kamar = 'default-' . strtolower($kamar->tipe_kamar) . '.jpg';
                // user_id dibiarkan NULL untuk kamar kosong
                $kamar->save();
            }
        }

        // Seeder untuk kontrak dan pembayaran
        // Pastikan model Kontrak dan Pembayaran sudah ada
        $penyewa = User::where('role', 'pengguna')->get();
        foreach ($penyewa as $user) {
            // Cari kamar yang sudah terisi oleh user ini
            $kamar = Kamar::where('user_id', $user->id)->first();
            if ($kamar) {
                // Buat kontrak jika belum ada
                $kontrak = \App\Models\Kontrak::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'kamar_id' => $kamar->id,
                    ],
                    [
                        'tanggal_mulai' => now()->subMonths(rand(1, 6)),
                        'tanggal_selesai' => now()->addMonths(rand(1, 6)),
                        'status' => 'aktif',
                    ]
                );

                // Buat pembayaran untuk kontrak ini
                \App\Models\Pembayaran::firstOrCreate(
                    [
                        'kontrak_id' => $kontrak->id,
                        'user_id' => $user->id,
                    ],
                    [
                        'harga' => $kamar->harga,
                        'metode_pembayaran' => 'transfer',
                        'status' => 'lunas',
                    ]
                );
            }
        }

        // Pilih 2 kamar kosong secara random untuk "diisi" oleh pengguna
        $emptyKamars = Kamar::where('status', 'belum_terisi')->take(2)->get();
        $availableUsers = User::where('role', 'pengguna')
                            ->whereDoesntHave('kamar')
                            ->take($emptyKamars->count())
                            ->get();

        // Pasangkan kamar dengan pengguna
        foreach ($availableUsers as $index => $user) {
            if (isset($emptyKamars[$index])) {
                $kamar = $emptyKamars[$index];
                $kamar->status = 'terisi';
                $kamar->user_id = $user->id;
                $kamar->save();
            }
        }
    }

    private function getRandomTipeKamar(): string
    {
        $types = ['Standard', 'Deluxe', 'Premium'];
        return $types[array_rand($types)];
    }
    
    /**
     * Mendapatkan harga berdasarkan tipe kamar
     */
    private function getHargaByTipe(string $tipe): int
    {
        return [
            'Standard' => 500000,
            'Deluxe' => 750000,
            'Premium' => 1000000,
        ][$tipe] ?? 500000;
    }
}