<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // Permitir el acceso a las rutas con el prefijo 'guest' sin autenticación
        if ($request->is('guest/*')) {
            return $next($request);
        }

        // Redirigir al login si no está autenticado
        if (! auth()->check()) {
            abort(403, 'Acceso denegado. Usuario no autenticado.');
        }

        return $next($request);
    }
}
