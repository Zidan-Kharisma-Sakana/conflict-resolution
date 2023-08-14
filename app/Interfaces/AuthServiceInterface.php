<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthServiceInterface
{
    public function createEmptyProfile(User $user);
}
