<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['L', 'P']);
        
        return [
            'nama' => $this->faker->name($gender === 'L' ? 'male' : 'female'),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password default
            'role' => 'pengguna', // Secara default, buat sebagai pengguna
            'no_hp' => $this->faker->numerify('08##########'),
            'foto_profile' => 'default-user.jpg',
            'gender' => $gender,
            'remember_token' => Str::random(10),
        ];
    }
    
    /**
     * Indicate that the user is an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'admin',
                'foto_profile' => 'default-admin.jpg',
            ];
        });
    }
    
    /**
     * Indicate that the user is a regular user.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pengguna()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'pengguna',
            ];
        });
    }
}