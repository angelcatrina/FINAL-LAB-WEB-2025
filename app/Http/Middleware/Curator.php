<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Curator
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

       
        if (!$user || $user->role !== 'curator') {
            abort(403, 'Akses ditolak. Hanya curator yang boleh mengakses.');
        }

        if ($user->status !== 'approved') {

            if (!$request->routeIs('curator.pending')) {
                return redirect()->route('curator.pending');
            }
        }
        return $next($request);
    }
}
