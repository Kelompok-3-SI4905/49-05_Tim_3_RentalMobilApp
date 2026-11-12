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

    // 1. Rute khusus Admin (Didaftarkan LEBIH DULU agar /bengkel/create tidak bentrok)
    Route::middleware('role:admin')->group(function () {
        Route::resource('bengkel', BengkelController::class)->except(['index', 'show']);
    });

    // 2. Rute yang bisa diakses semua user yang login (user & admin)
    Route::resource('bengkel', BengkelController::class)->only(['index']);
});