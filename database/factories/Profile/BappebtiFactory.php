<?php

namespace Database\Factories\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile\Bappebti>
 */
class BappebtiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap'=> fake()->name(),
            'nip'=> fake()->numberBetween(999999,1000000)
        ];
    }
}
