<?php

namespace App\Policies;

use App\Models\ArmadaKendaraan;
use App\Models\User;

class ArmadaKendaraanPolicy
{
    /**
     * Boleh mengubah data kendaraan ini? (Admin & Petugas)
     */
    public function update(User $user, ArmadaKendaraan $kendaraan): bool
    {
        return $user->hasRole('admin', 'petugas');
    }

    /**
     * Boleh menghapus data kendaraan ini? (Hanya Admin)
     */
    public function delete(User $user, ArmadaKendaraan $kendaraan): bool
    {
        return $user->hasRole('admin');
    }
}

