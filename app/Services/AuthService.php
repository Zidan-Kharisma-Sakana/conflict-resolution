<?php

namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use App\Models\Profile\Bappebti;
use App\Models\Profile\Bursa;
use App\Models\Profile\Nasabah;
use App\Models\Profile\Pialang;
use App\Models\User;

class AuthService implements AuthServiceInterface
{
    public function createEmptyProfile(User $user)
    {
        switch ($user->role) {
            case 'nasabah':
                Nasabah::create([
                    'user_id' => $user->id,
                ]);
                break;
            case 'pialang':
                Pialang::create([
                    'user_id' => $user->id,
                ]);
                break;
            case 'bursa':
                Bursa::create([
                    'user_id' => $user->id,
                ]);
                break;
            case 'bappebti':
                Bappebti::create([
                    'user_id' => $user->id,
                ]);
                break;
        }
        error_log($user->role);
    }
}
