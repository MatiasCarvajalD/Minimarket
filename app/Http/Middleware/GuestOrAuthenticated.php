<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestOrAuthenticated
{
    public function handle($request, Closure $next)
    {
        // Permitir acceso a invitados o usuarios logueados
        if (Auth::check() || $request->session()->has('guest')) {
            return $next($request);
        }

        // Redirigir a la página de inicio de sesión
        return redirect()->route('login')->with('message', 'Debes iniciar sesión o entrar como invitado.');
    }
}
