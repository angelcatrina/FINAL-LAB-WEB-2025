<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        
        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, "Akses ditolak. Hanya $role yang boleh mengakses.");
        }

        return $next($request);
    }
}
