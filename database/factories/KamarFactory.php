<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    protected $model = Kamar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Nomor kamar acak dengan format yang konsisten (misalnya "K001", "K002", dll)
        static $number = 1;
        $kamarNumber = 'K' . str_pad($number++, 3, '0', STR_PAD_LEFT);
        
        // Opsi tipe kamar
        $tipeKamar = $this->faker->randomElement(['Standard', 'Deluxe', 'Premium']);
        
        // Harga berdasarkan tipe kamar
        $harga = [
            'Standard' => 500000,
            'Deluxe' => 750000,
            'Premium' => 1000000,
        ][$tipeKamar];
        
        return [
            'nomor_kamar' => $kamarNumber,
            'tipe_kamar' => $tipeKamar,
            'harga' => $harga,
            'status' => 'belum_terisi', // Default status
            'gambar_kamar' => 'default-' . strtolower($tipeKamar) . '.jpg',
        ];
    }
    
    /**
     * Indicate that the kamar is terisi.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function terisi()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'terisi',
            ];
        });
    }
    
    /**
     * Indicate that the kamar is belum_terisi.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function belumTerisi()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'belum_terisi',
            ];
        });
    }
}