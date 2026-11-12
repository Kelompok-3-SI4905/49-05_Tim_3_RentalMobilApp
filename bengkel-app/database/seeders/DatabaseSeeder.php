<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin (Full CRUD)
        User::updateOrCreate(
            ['email' => 'admin@bengkel.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // Akun Manager (Create & Update saja, tanpa Delete)
        User::updateOrCreate(
            ['email' => 'manager@bengkel.com'],
            [
                'name'     => 'Manager Bengkel',
                'password' => Hash::make('manager123'),
                'role'     => 'manager',
            ]
        );

        // Akun Karyawan (Read-Only)
        User::updateOrCreate(
            ['email' => 'karyawan@bengkel.com'],
            [
                'name'     => 'Karyawan Bengkel',
                'password' => Hash::make('karyawan123'),
                'role'     => 'karyawan',
            ]
        );

        // Akun User Biasa (Read-Only)
        User::updateOrCreate(
            ['email' => 'user@bengkel.com'],
            [
                'name'     => 'User Pelanggan',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ]
        );
    }
}