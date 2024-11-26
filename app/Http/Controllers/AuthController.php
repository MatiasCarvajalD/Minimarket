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
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('correo', 'password'))) {
            return redirect()->route('home'); // Redirige al home si las credenciales son correctas
        }

        // Si las credenciales no coinciden
        return back()->withErrors([
            'login' => 'Las credenciales no coinciden. Por favor, inténtalo de nuevo.',
        ])->withInput(); // Retorna los datos ingresados para que se mantengan en el formulario
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
