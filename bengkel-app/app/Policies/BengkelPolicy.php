<?php

namespace App\Policies;

use App\Models\Bengkel;
use App\Models\User;

class BengkelPolicy
{
    /**
     * Menentukan apakah user boleh mengubah data bengkel ini.
     */
    public function update(User $user, Bengkel $bengkel): bool
    {
        return $user->hasRole('admin', 'manager');
    }

    /**
     * Menentukan apakah user boleh menghapus data bengkel ini.
     */
    public function delete(User $user, Bengkel $bengkel): bool
    {
        return $user->hasRole('admin');
    }
}