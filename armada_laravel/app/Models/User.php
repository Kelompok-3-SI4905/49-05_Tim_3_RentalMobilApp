<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function hasRole(string ...$roles): bool
    {
        $currentRole = strtolower(trim((string) $this->role));

        // Toleransi jika role di database tertulis 'adminkendaraan'
        if ($currentRole === 'adminkendaraan') {
            $currentRole = 'admin';
        }

        $flatRoles = [];
        foreach ($roles as $role) {
            foreach (explode(',', $role) as $r) {
                $trimmed = strtolower(trim($r));
                if ($trimmed !== '') {
                    $flatRoles[] = $trimmed;
                }
            }
        }

        return in_array($currentRole, $flatRoles, true);
    }
}