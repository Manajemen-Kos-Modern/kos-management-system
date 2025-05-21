<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nama' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'no_hp' => '081234567890',
            'role' => 'admin',
            'foto_profile' => null,
            'gender' => 'L',
        ]);
    }
}
