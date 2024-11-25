<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
{
    $credentials = $request->validate([
        'correo' => 'required|email', // Valida el campo 'correo'
        'password' => 'required',    // Valida el campo 'password'
    ]);

    // Intenta autenticar al usuario
    if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['password']])) {
        $request->session()->regenerate(); // Regenera la sesión si el login es exitoso
        return redirect()->intended('home'); // Redirige al home
    }

    // Si fallan las credenciales, regresa con un error
    return back()->withErrors([
        'correo' => 'Las credenciales no coinciden con nuestros registros.',
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Has cerrado sesión.');
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
