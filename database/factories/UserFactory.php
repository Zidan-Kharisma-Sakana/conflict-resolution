<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $name = fake()->name();
        return [
            'name' => $name,
            'email' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))) . '@gmail.com',
            'role' => 'nasabah',
            'email_verified_at' => now(),
            'password' => Hash::make("password"), // password
            'remember_token' => Str::random(10),
        ];
    }

    public function setRole($role): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => $role,
        ]);
    }

    public function setName($name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
            'email' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))) . '@gmail.com',
        ]);
    }
}
