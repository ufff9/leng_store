<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // Cek role admin (gunakan strtolower untuk keamanan)
        if (strtolower(Auth::user()->role) !== 'admin') {
            // Alihkan ke rute dashboard UTAMA user, bukan halaman transaksi
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
