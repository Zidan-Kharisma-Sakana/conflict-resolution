<?php

namespace App\Policies;

use App\Models\Complaint\Pengaduan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PengaduanPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pengaduan $pengaduan): bool
    {
        switch ($user->role) {
            case User::IS_BAPPEBTI:
                return true;
            case User::IS_BURSA:
                return $pengaduan->bursa_id == $user->bursa->id;
            case User::IS_PIALANG:
                return $pengaduan->pialang_id == $user->pialang->id;
            case User::IS_NASABAH:
                return $pengaduan->nasabah_id == $user->nasabah->id;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == User::IS_NASABAH;
    }

    public function addMusyawarah(User $user, Pengaduan $pengaduan): bool{
        return $user->role == User::IS_PIALANG && $pengaduan->status == Pengaduan::STATUS_DISPOSISI_PIALANG;
    }

    public function addMediasi(User $user, Pengaduan $pengaduan): bool{
        return $user->role == User::IS_BURSA && in_array($pengaduan->status, [Pengaduan::STATUS_DISPOSISI_BURSA, Pengaduan::STATUS_DISPOSISI_BURSA_EXPIRED]);
    }

    public function addKesepakatan(User $user, Pengaduan $pengaduan): bool{
        return in_array($user->role, [User::IS_BURSA, User::IS_PIALANG]) && empty($pengaduan->kesepakatan);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pengaduan $pengaduan): bool
    {
        if ($user->role == User::IS_BAPPEBTI) {
            return $pengaduan->status == Pengaduan::STATUS_CREATED;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pengaduan $pengaduan): bool
    {
        return !(in_array($pengaduan->status, [Pengaduan::STATUS_CLOSED, Pengaduan::STATUS_REJECTED]) || $user->role != User::IS_BAPPEBTI);
    }
}
