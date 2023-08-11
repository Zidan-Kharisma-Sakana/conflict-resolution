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
        Bappebti::factory()->for(User::factory()->setRole("bappebti"))->create();

        $bursaJFX = User::factory()->setRole("bursa")->has(
            Bursa::factory()->state(['nama_bursa' => 'Jakarta Futures Exchange (JFX)'])
        )->create();

        for ($i = 0; $i < 3; $i++) {
            Pialang::factory()->for(User::factory()->setRole("pialang"))->for($bursaJFX->bursa)->create();
        }

        $bursaICDX = User::factory()->setRole("bursa")->has(
            Bursa::factory()->state(['nama_bursa' => 'Indonesia Commodity & Derivatives Exchange (ICDX)'])
        )->create();

        for ($i = 0; $i < 3; $i++) {
            Pialang::factory()->for(User::factory()->setRole("pialang"))->for($bursaICDX->bursa)->create();
        }
    }
}
