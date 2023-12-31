<?php

namespace Database\Seeders;

use App\Models\Profile\Bappebti;
use App\Models\Profile\Bursa;
use App\Models\Profile\Nasabah;
use App\Models\Profile\Pialang;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nasabah::factory()->for(User::factory()->setRole("nasabah"))->create();
        Nasabah::factory()->for(User::factory()->setRole("nasabah"))->create();

        Bappebti::factory()->for(User::factory()->setRole("bappebti"))->create();

        $bursaJFX = User::factory()->setRole("bursa")
            ->setName("Jakarta Futures Exchange (JFX)")->has(
                Bursa::factory()
            )->create();

        for ($i = 0; $i < 3; $i++) {
            Pialang::factory()->for(User::factory()->setRole("pialang")->setName(fake()->company()))
                ->for($bursaJFX->bursa)
                ->create();
        }

        $bursaICDX = User::factory()->setRole("bursa")
            ->setName('Indonesia Commodity & Derivatives Exchange (ICDX)')->has(
                Bursa::factory()
            )->create();

        for ($i = 0; $i < 3; $i++) {
            Pialang::factory()->for(User::factory()->setRole("pialang")->setName(fake()->company()))->for($bursaICDX->bursa)
                ->create();
        }
    }
}
