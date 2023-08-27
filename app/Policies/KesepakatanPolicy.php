<?php

namespace App\Policies;

use App\Models\Complaint\Kesepakatan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KesepakatanPolicy
{
    public function update(User $user, Kesepakatan $kesepakatan): bool
    {
        return $user->role == User::IS_BAPPEBTI && !empty($kesepakatan);
    }
}
