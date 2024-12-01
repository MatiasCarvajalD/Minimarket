<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar los datos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirigir al usuario autenticado
            return redirect()->intended('/dashboard'); // Cambia '/dashboard' por la ruta deseada
        }

        // Si falla la autenticación, redirigir con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Procesar registro
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios,correo',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nombre_usuario' => $validated['nombre_usuario'], 
            'correo' => $validated['correo'], 
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('login')->with('success', '¡Cuenta creada con éxito!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function loginAsGuest()
    {
        // Buscar al usuario invitado predefinido
        $invitado = User::where('rut_usuario', '99999999')->first();

        // Autenticar al usuario invitado
        Auth::login($invitado);

        // Redirigir a la página de inicio o la ruta que elijas
        return redirect()->route('home')->with('success', 'Has iniciado sesión como invitado.');
}

    // Mostrar formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
