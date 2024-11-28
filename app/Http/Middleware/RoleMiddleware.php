<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Mengecek apakah pengguna memiliki role yang sesuai
        if (auth()->check() && auth()->user()->level !== $role) {
            // Jika tidak sesuai, alihkan ke halaman error atau halaman lain
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
