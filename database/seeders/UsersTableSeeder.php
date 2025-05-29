<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Admin Kost',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'no_hp' => '081234567890',
            'role' => 'admin',
            'foto_profile' => null,
            'gender' => 'L',
        ]);

        User::create([
            'nama' => 'Bayu Setiawan',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'no_hp' => '089876543210',
            'role' => 'penyewa',
            'foto_profile' => null,
            'gender' => 'L',
        ]);
    }
}
