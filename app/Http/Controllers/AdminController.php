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

    // Dashboard
    public function dashboard()
    {
        $totalUsuarios = User::count();
        $totalProductos = Producto::count();
        $totalVentas = Venta::count();
    
        // Calcular ingresos totales desde detalle_venta
        $ingresosTotales = \DB::table('detalle_venta')
            ->sum(\DB::raw('cantidad * valor_unidad'));
    
        return view('admin.dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'totalProductos' => $totalProductos,
            'totalVentas' => $totalVentas,
            'ingresosTotales' => $ingresosTotales,
        ]);
    }
    
    

    // Gestión de Usuarios
    public function usuarios()
    {
        $usuarios = User::where('rol', '!=', 'admin')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function editarUsuario($rut_usuario)
    {
        $usuario = User::where('rut_usuario', $rut_usuario)->firstOrFail();
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function actualizarUsuario(Request $request, $rut_usuario)
    {
        $usuario = User::where('rut_usuario', $rut_usuario)->firstOrFail();

        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
        ]);

        $usuario->update($validated);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado.');
    }

    // Gestión de Productos
    public function productos()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    // Gestión de Ventas
    public function pedidos()
    {
        $ventas = Venta::with('detalles')->get();
        return view('admin.ventas.index', compact('ventas'));
    }
}
