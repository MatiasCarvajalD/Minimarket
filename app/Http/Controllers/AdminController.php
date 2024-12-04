<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producto;
use App\Models\Venta;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->rol !== 'admin') {
                abort(403, 'Acceso denegado.');
            }
            return $next($request);
        });
    }

    public function usuarios()
    {
        $usuarios = User::where('rol', '!=', 'admin')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function editarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
        ]);

        $usuario->update($validated);

        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado.');
    }

    public function productos()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function pedidos()
    {
        $ventas = Venta::with('detalles')->get();
        return view('admin.pedidos.index', compact('ventas'));
    }
}
