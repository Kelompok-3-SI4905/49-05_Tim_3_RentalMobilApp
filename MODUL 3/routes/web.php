<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaketRentalController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PaketRentalController::class, 'index'])->name('paket.index');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/tambah', [PaketRentalController::class, 'create'])
        ->can('tambah-paket')
        ->name('paket.create');
    Route::post('/paket', [PaketRentalController::class, 'store'])
        ->can('tambah-paket')
        ->name('paket.store');


    Route::middleware('peran:admin,staff')->group(function () {
        Route::get('/paket/{paket}/edit', [PaketRentalController::class, 'edit'])
            ->name('paket.edit')
            ->can('update', 'paket');
        Route::put('/paket/{paket}', [PaketRentalController::class, 'update'])
            ->name('paket.update')
            ->can('update', 'paket');
    });

    // Hapus: hanya admin
    Route::delete('/paket/{paket}', [PaketRentalController::class, 'destroy'])
        ->name('paket.destroy')
        ->middleware('peran:admin')
        ->can('delete', 'paket');
});