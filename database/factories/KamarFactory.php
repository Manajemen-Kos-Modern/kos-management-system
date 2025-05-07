<?php

namespace Database\Factories;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Kamar::class;

    public function definition(): array
    {
        return [
            'nomor_kamar' => 'KMR-' . $this->faker->unique()->numberBetween(100, 999),
            'tipe_kamar' => $this->faker->randomElement(['Standard', 'Deluxe', 'VIP']),
            'harga' => $this->faker->numberBetween(500000, 2000000),
            'status' => 'belum_terisi',
            'gambar_kamar' => null,
            'user_id' => null
        ];
    }
}