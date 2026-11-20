<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Memastikan akun admin dan petugas selalu ada dan siap digunakan di database
     */
    private function ensureDefaultUsersExist(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'petugas'],
            [
                'password' => Hash::make('petugas123'),
                'role'     => 'petugas',
            ]
        );
    }

    public function showLogin()
    {
        $this->ensureDefaultUsersExist();

        if (Auth::check()) {
            return redirect()->route('kendaraan.daftar');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->ensureDefaultUsersExist();

        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('kendaraan.daftar')
                ->with('success', 'Selamat datang, ' . Auth::user()->username . '!');
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}

