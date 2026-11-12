<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BengkelController;

// Route Guest (Hanya bisa diakses kalau BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route Auth (Hanya bisa diakses kalau SUDAH login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return redirect()->route('bengkel.index');
    });

    // Rute yang bisa diakses semua role (Admin, Manager, Karyawan, User)
    Route::get('/bengkel', [BengkelController::class, 'index'])->name('bengkel.index');

    // Rute Pengelolaan (Dilindungi Middleware role:admin,manager + Gate + Policy)
    Route::middleware('role:admin,manager')->group(function () {
        // Dilindungi Gate 'manage-bengkel' (Admin & Manager boleh)
        Route::get('/bengkel/create', [BengkelController::class, 'create'])
            ->can('manage-bengkel')
            ->name('bengkel.create');
        Route::post('/bengkel', [BengkelController::class, 'store'])
            ->can('manage-bengkel')
            ->name('bengkel.store');

        // Dilindungi Policy 'update' (Admin & Manager boleh)
        Route::get('/bengkel/{bengkel}/edit', [BengkelController::class, 'edit'])
            ->can('update', 'bengkel')
            ->name('bengkel.edit');
        Route::put('/bengkel/{bengkel}', [BengkelController::class, 'update'])
            ->can('update', 'bengkel')
            ->name('bengkel.update');

        // Dilindungi Policy 'delete' (Hanya Admin yang boleh, Manager -> 403)
        Route::delete('/bengkel/{bengkel}', [BengkelController::class, 'destroy'])
            ->can('delete', 'bengkel')
            ->name('bengkel.destroy');
    });
});