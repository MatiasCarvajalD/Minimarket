<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Mostrar el panel de administración
    public function index()
    {
        return view('admin.index'); // Asegúrate de tener esta vista
    }

    // Mostrar la lista de usuarios
    public function users()
    {
        $users = User::all(); // Obtenemos todos los usuarios
        return view('admin.users', compact('users')); // Asegúrate de tener esta vista
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user')); // Asegúrate de tener esta vista
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente.');
    }

    public function listarPedidos()
    {
        $pedidos = Venta::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

}
