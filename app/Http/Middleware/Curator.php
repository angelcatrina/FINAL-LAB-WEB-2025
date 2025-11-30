<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Curator
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Pastikan login & role adalah curator
        if (!$user || $user->role !== 'curator') {
            abort(403, 'Akses ditolak. Hanya curator yang boleh mengakses.');
        }

        // Jika masih pending, hanya boleh mengakses halaman pending
        if ($user->status !== 'approved') {

            // Jika mencoba akses halaman dashboard atau lainnya → redirect ke pending
            if (!$request->routeIs('curator.pending')) {
                return redirect()->route('curator.pending');
            }
        }

        // Jika curator sudah approved → bebas akses dashboard
        return $next($request);
    }
}
