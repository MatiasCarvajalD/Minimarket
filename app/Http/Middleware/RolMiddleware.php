<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check() || auth()->user()->rol !== $role) {
            abort(403, 'Acceso denegado');
        }

        return $next($request);
    }
}
