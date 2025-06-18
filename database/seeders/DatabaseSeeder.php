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
    $this->call([
        UsersTableSeeder::class, // ini seeder yang kamu buat sendiri
        KamarsTableSeeder::class,
        KontraksTableSeeder::class,
        PembayaransTableSeeder::class,
        PemeliharaansTableSeeder::class,
        KeluhansTableSeeder::class,
        NotifikasisTableSeeder::class,
    ]);
}

}
