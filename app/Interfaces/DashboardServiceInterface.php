<?php

namespace App\Interfaces;

use App\Models\User;

interface DashboardServiceInterface
{
    public function getDashboardData(User $user);
}
