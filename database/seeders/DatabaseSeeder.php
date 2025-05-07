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
        // Buat 1 admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Kos',
            'email' => 'admin@kos.com',
            'password' => Hash::make('password123'),
            'status' => 'active',
            'is_admin' => true
        ]);

        // Buat 5 pengguna biasa
        User::factory(5)->create();

        // Buat 5 kamar kosong
        Kamar::factory(5)->create([
            'status' => 'belum_terisi',
            'user_id' => null
        ]);

        // Buat 2 kamar terisi (dengan penghuni)
        $users = User::where('is_admin', false)->take(2)->get();
        foreach ($users as $user) {
            Kamar::factory()->create([
                'status' => 'terisi',
                'user_id' => $user->id
            ]);
        }
    }
}