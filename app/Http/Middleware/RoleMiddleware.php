<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Dipakai di route: ->middleware('role:admin') atau ->middleware('role:pelanggan')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Kalau belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Kalau role tidak sesuai, tampilkan halaman 403 (akses ditolak)
        if (Auth::user()->role != $role) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
