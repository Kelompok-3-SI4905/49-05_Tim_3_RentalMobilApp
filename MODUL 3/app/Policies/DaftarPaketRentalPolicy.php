<?php

namespace App\Policies;

use App\Models\DaftarPaketRental;
use App\Models\User;

class DaftarPaketRentalPolicy
{
    // Boleh mengubah data INI?
    public function update(User $user, DaftarPaketRental $paket): bool
    {
        return $user->hasRole('admin')
            || ($user->hasRole('staff') && $paket->jenis_paket !== 'Luar Kota');
    }

    // Boleh menghapus data INI?
    public function delete(User $user, DaftarPaketRental $paket): bool
    {
        return $user->hasRole('admin');
    }

    // Boleh mengubah kolom jenis_paket? (dipakai di controller)
    public function ubahJenis(User $user, DaftarPaketRental $paket): bool
    {
        return $user->hasRole('admin');
    }
}