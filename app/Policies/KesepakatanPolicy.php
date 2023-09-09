<?php

namespace App\Policies;

use App\Models\Complaint\Kesepakatan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KesepakatanPolicy
{
    public function confirm(User $user, Kesepakatan $kesepakatan): bool
    {
        return $user->role == User::IS_BAPPEBTI && !empty($kesepakatan);
    }
    public function destroy(User $user, Kesepakatan $kesepakatan): bool
    {
        return $user->role == User::IS_BAPPEBTI && !empty($kesepakatan);
    }
}
