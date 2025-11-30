<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Member
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Hanya member yang boleh mengakses.');
    }
}
