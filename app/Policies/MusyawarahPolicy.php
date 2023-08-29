<?php

namespace App\Policies;

use App\Models\Complaint\Musyawarah;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MusyawarahPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Musyawarah $musyawarah): bool
    {
        switch($user->role){
            case User::IS_BAPPEBTI:
                return true;
            case User::IS_BURSA:
                return $musyawarah->pengaduan->bursa_id == $user->bursa->id;
            case User::IS_PIALANG:
                return $musyawarah->pengaduan->pialang_id == $user->pialang->id;
            case User::IS_NASABAH:
                return $musyawarah->pengaduan->nasabah_id == $user->nasabah->id;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Musyawarah $musyawarah): bool
    {
        return $user->role == User::IS_PIALANG && $musyawarah->pengaduan->pialang_id == $user->pialang->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Musyawarah $musyawarah): bool
    {
        return $user->role == User::IS_PIALANG && $musyawarah->pengaduan->pialang_id == $user->pialang->id;
    }
}
