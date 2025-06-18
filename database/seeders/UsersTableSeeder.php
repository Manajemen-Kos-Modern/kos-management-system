<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        DB::table('users')->insert([
            'nama' => 'Admin Kos',
            'email' => 'admin@kos.com',
            'password' => Hash::make('admin123'), // password admin
            'no_hp' => '081234567890',
            'role' => 'admin',
            'foto_profile' => null,
            'gender' => 'L',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Penyewa dengan password berbeda-beda
        $penyewa = [
            ['nama' => 'Chan',   'email' => 'chan@kos.com',  'gender' => 'L', 'password' => 'chan123'],
            ['nama' => 'Shina',  'email' => 'shina@kos.com', 'gender' => 'P', 'password' => 'shina123'],
            ['nama' => 'Chris',  'email' => 'chris@kos.com', 'gender' => 'L', 'password' => 'chris123'],
            ['nama' => 'Shera',  'email' => 'shera@kos.com', 'gender' => 'P', 'password' => 'shera123'],
            ['nama' => 'Felix',  'email' => 'felix@kos.com', 'gender' => 'L', 'password' => 'felix123'],
        ];

        foreach ($penyewa as $user) {
            DB::table('users')->insert([
                'nama' => $user['nama'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'no_hp' => '0812345678' . rand(10, 99),
                'role' => 'pengguna',
                'foto_profile' => null,
                'gender' => $user['gender'],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
