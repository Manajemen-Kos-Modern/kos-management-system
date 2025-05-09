<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            // Cek apakah role yang dimiliki pengguna sesuai dengan yang diinginkan
            if (Auth::user()->role === $role) {
                return $next($request);
            }

            // Jika role tidak sesuai, log kesalahan dan arahkan ke halaman sesuai role pengguna
            Log::warning('Akses ditolak: Pengguna dengan role ' . Auth::user()->role . ' mencoba mengakses halaman ' . $role);

            return $this->redirectToRoleBasedPage(Auth::user()->role);
        }

        // Jika pengguna belum login, arahkan ke halaman login dengan pesan
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    private function redirectToRoleBasedPage($role)
    {
        // Arahkan pengguna sesuai dengan role mereka dengan memberikan pesan yang sesuai
        switch ($role) {
            case 'admin':
                return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            case 'pemilik':
                return redirect('/pemilik/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            case 'pengguna':
                return redirect('/pengguna/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            default:
                return redirect('/login')->with('error', 'Role tidak dikenali, silakan login kembali.');
        }
    }
}
