<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            // Obtener el usuario autenticado
            $user = Auth::user();
    
            // Redirigir según el rol del usuario
            switch ($user->rol) {
                case 'admin':
                    return redirect()->route('admin.dashboard'); // Ruta para el dashboard del admin
                case 'usuario':
                    return redirect()->route('user.home'); // Ruta para el usuario regular
                case 'invitado':
                    return redirect()->route('guest.home'); // Ruta para el invitado
                default:
                    // En caso de un rol desconocido
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['email' => 'Rol de usuario no válido']);
            }
        }
    
        // Si las credenciales son incorrectas
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
 
    public function register(Request $request)
    {

        // Validar los datos de entrada
        $request->validate([
            'rut_usuario' => [
                'required',
                'string',
                'regex:/^\d{7,8}$/', // Solo 7-8 dígitos, sin guion ni dígito verificador
                'unique:usuarios,rut_usuario',
            ],
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|confirmed|min:8',
        ]);


        
    
        // Crear el nuevo usuario en la base de datos
        $usuario = User::create([
            'rut_usuario' => $request->rut_usuario,
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña
            'rol' => 'usuario', // Valor por defecto
        ]);
    
        // Redirigir al login con un mensaje de éxito
        return redirect()->route('login')->with('success', 'Usuario registrado exitosamente.');
    }
    
    protected function redirectTo()
    {
        return route('user.home');  // Asegúrate de que esta ruta esté definida
    }


}
