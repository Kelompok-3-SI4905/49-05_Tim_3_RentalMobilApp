<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // 1. Belum login? Arahkan ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // 2. Sudah login, tapi perannya tidak ada di daftar? Tolak dengan 403
        if (! $user->hasRole(...$roles)) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk Administrator.');
        }

        // 3. Lolos: lanjut ke controller
        return $next($request);
    }
}