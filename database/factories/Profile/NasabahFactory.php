<?php

namespace Database\Factories\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile\Nasabah>
 */
class NasabahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'identitas' => 'KTP',
            'nomor_identitas' => fake()->numberBetween(999999, 1000000),
            'gender' => rand(0, 10) / 10 < 0.5 ? "Perempuan" : "Laki-Laki",
            'alamat'=> fake()->address(),
            'provinsi'=> fake()->city(),
            'kota_kabupaten' => fake()->city(),
            'nomor_hp'=> fake()->phoneNumber(),
        ];
    }
}
