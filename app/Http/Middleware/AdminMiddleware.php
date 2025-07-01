<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login DAN memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Izinkan akses jika admin
        }

        // Jika bukan admin, arahkan ke halaman login dengan pesan error
        return redirect('/login')->with('error', 'Anda tidak memiliki akses sebagai Admin.');
    }
}