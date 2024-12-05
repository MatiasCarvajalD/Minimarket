<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->rol === $role) {
            return $next($request);
        }

        abort(403, 'Acceso denegado.');
    }
}
