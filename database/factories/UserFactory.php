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
            'name' => fake()->name(),
            'faculty' => fake()->randomElement(['Teknik', 'Ekonomi', 'Ilmu Komunikasi', 'MIPA']),
            'major' => fake()->randomElement(['Informatika', 'Manajemen', 'Biologi', 'Komunikasi']),
            'pin' => '123456',
            'role' => 'voter',
            'has_voted' => false,
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }
}
