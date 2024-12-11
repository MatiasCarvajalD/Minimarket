<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Método para mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }


    // Método para manejar el login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Redirigir según el rol del usuario
            $user = Auth::user();
            if ($user->rol === 'invitado') {
                return redirect()->route('guest.home');
            } else {
                return redirect()->route('user.home');
            }
        }
    
        return redirect()->route('login')->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function loginAsGuest()
    {
        // Fetch the existing 'invitado' user from the database
        $guestUser = User::where('rol', 'invitado')->first();

        if (!$guestUser) {
            return redirect()->route('login')->withErrors(['guest' => 'Usuario invitado no configurado.']);
        }

        // Log in as the "invitado" user
        Auth::login($guestUser);

        return redirect()->route('guest.home')->with('success', 'Has iniciado sesión como invitado.');
    }

    // Método para hacer logout
    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión del usuario
        $request->session()->invalidate(); // Invalida la sesión actual
        $request->session()->regenerateToken(); // Regenera el token CSRF por seguridad

        return redirect('login'); // Redirige al usuario a la página principal
    }
    // Muestra el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesa el registro de un nuevo usuario
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nombre_usuario' => $validated['nombre_usuario'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'rol' => 'usuario',
        ]);

        return redirect()->route('login')->with('success', 'Registro exitoso.');
    }
    
    protected function redirectTo()
    {
        return route('user.home');  // Asegúrate de que esta ruta esté definida
    }


}
