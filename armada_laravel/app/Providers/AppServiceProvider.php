<?php

namespace App\Providers;

use App\Models\ArmadaKendaraan;
use App\Models\User;
use App\Policies\ArmadaKendaraanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(ArmadaKendaraan::class, ArmadaKendaraanPolicy::class);
        Gate::define('tambah-kendaraan', fn(User $user) => $user->hasRole('admin', 'petugas'));
    }
}