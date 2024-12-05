<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venta;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->rol !== 'usuario') {
                abort(403, 'Acceso denegado.');
            }
            return $next($request);
        });
    }

    public function home()
    {
        return view('Usuario.home');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('Usuario.configuracion', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

    
        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $user->rut_usuario . ',rut_usuario',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);
        
    
        $user->forceFill($validated)->save();

    
        return redirect()->route('user.profile')->with('success', 'Perfil actualizado correctamente.');
    }

    public function historialCompras()
    {
        $ventas = Venta::where('rut_usuario', auth()->user()->rut_usuario)->get();
        return view('Usuario.historial_compras', compact('ventas'));
    }

    public function detalleCompra($id)
{
    // Obtener la venta y sus detalles
    $venta = \App\Models\Venta::where('id_venta', $id)
        ->where('rut_usuario', auth()->user()->rut_usuario)
        ->with('detalles.producto') // Cargar productos relacionados
        ->firstOrFail();

    return view('Usuario.detalle_compra', compact('venta'));
}
}
