<?php

namespace Database\Factories\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile\Pialang>
 */
class PialangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alamat_lengkap' => fake()->address(),
            'status'=> "aktif",
            'deskripsi' => fake()->text(100),
            'aduan_bulanan'=>0,
            'aduan_tahunan'=>0,
        ];
    }
}
