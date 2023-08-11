<?php

namespace Database\Factories\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile\Bursa>
 */
class BursaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_bursa' => '',
            'status' => 'aktif',
            'alamat_lengkap' => fake()->address(),
            'deskripsi' => fake()->text(),
        ];
    }
}
