<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'npm' => fake()->unique()->numerify('23#####'),
            'nama' => fake()->name(),
            'jurusan' => fake()->randomElement(['Teknik', 'Ekonomi', 'Ilmu Komunikasi', 'MIPA']),
            'prodi' => fake()->randomElement(['Informatika', 'Manajemen', 'Biologi', 'Komunikasi']),
            'pin' => '123456',
            'peran' => 'voter',
            'sudah_memilih' => false,
            'aktif' => true,
            'remember_token' => Str::random(10),
        ];
    }
}
