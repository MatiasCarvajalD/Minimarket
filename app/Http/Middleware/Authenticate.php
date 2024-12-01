<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Obtén la ruta a la que el usuario debería ser redirigido si no está autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (! auth()->check()) {
            \Log::info('Usuario no autenticado. Redirigiendo al login.');
            return redirect()->route('login');
        }

        \Log::info('Usuario autenticado.');
        return $next($request);
    }

}
