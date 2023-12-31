<?php

namespace App\Policies;

use App\Models\Complaint\Mediasi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MediasiPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mediasi $mediasi): bool
    {
        switch($user->role){
            case User::IS_BAPPEBTI:
                return true;
            case User::IS_BURSA:
                return $mediasi->pengaduan->bursa_id == $user->bursa->id;
            case User::IS_PIALANG:
                return $mediasi->pengaduan->pialang_id == $user->pialang->id;
            case User::IS_NASABAH:
                return $mediasi->pengaduan->nasabah_id == $user->nasabah->id;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mediasi $mediasi): bool
    {
        return $user->role == User::IS_BURSA && $mediasi->pengaduan->bursa_id == $user->bursa->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mediasi $mediasi): bool
    {
        return $user->role == User::IS_BURSA && $mediasi->pengaduan->bursa_id == $user->bursa->id;
    }
}
