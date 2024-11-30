<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsuarios = Usuario::count();
        $totalVentas = Venta::sum('total');
        $productosCriticos = Producto::whereColumn('stock_actual', '<=', 'stock_critico')->count();

        return view('admin.dashboard', compact('totalUsuarios', 'totalVentas', 'productosCriticos'));
    }
        public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function edit($rut_usuario)
    {
        $usuario = User::findOrFail($rut_usuario);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $rut_usuario)
    {
        $usuario = User::findOrFail($rut_usuario);
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'rol' => 'required|in:admin,usuario,invitado',
        ]);
        $usuario->update($request->all());
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

}
