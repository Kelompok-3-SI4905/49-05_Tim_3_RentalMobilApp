<?php

use App\Http\Controllers\ArmadaKendaraanController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();

        // Otomatis sinkronisasi role admin dan pastikan akun petugas tersedia
        DB::table('users')->where('role', 'adminkendaraan')->update(['role' => 'admin']);

        if (!DB::table('users')->where('username', 'petugas')->exists()) {
            DB::table('users')->insert([
                'username'   => 'petugas',
                'password'   => \Illuminate\Support\Facades\Hash::make('petugas123'),
                'role'       => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return "DB berhasil connect dan akun admin/petugas sudah aktif!";
    } catch (\Exception $e) {
        return 'DB gagal connect: ' . $e->getMessage();
    }
})->withoutMiddleware('web');



Route::get('/daftar-kendaraan', [ArmadaKendaraanController::class, 'daftar'])->name('kendaraan.daftar');



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});



Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/', [ArmadaKendaraanController::class, 'index'])
            ->name('home')
            ->can('tambah-kendaraan');
        Route::post('/kendaraan', [ArmadaKendaraanController::class, 'store'])
            ->name('kendaraan.store')
            ->can('tambah-kendaraan');
        Route::get('/kendaraan/{kendaraan}/edit', [ArmadaKendaraanController::class, 'edit'])
            ->name('kendaraan.edit')
            ->can('update', 'kendaraan');
        Route::put('/kendaraan/{kendaraan}', [ArmadaKendaraanController::class, 'update'])
            ->name('kendaraan.update')
            ->can('update', 'kendaraan');
    });

    Route::delete('/kendaraan/{kendaraan}', [ArmadaKendaraanController::class, 'destroy'])
        ->name('kendaraan.destroy')
        ->middleware('role:admin')
        ->can('delete', 'kendaraan');
});