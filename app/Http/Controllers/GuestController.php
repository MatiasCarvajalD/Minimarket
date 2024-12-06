<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta; // Importa el modelo Venta
use App\Models\DetalleVenta; // Si usas DetalleVenta en el controlador
use App\Models\Producto; // Si usas Producto en el controlador
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function home()
    {
        return view('guest.home');
    }

    public function catalogo()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // Muestra los detalles de un producto
    public function detalleProducto($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.detalle', compact('producto'));
    }

    // Maneja el checkout
    public function checkout(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'delivery_option' => 'required|in:pickup,delivery',
            'nombre' => 'required_if:delivery_option,delivery|max:255',
            'direccion' => 'required_if:delivery_option,delivery|max:255',
            'telefono' => 'required_if:delivery_option,delivery|numeric',
            'correo' => 'required_if:delivery_option,delivery|email',
        ]);
    
        // Crear datos del pedido
        $pedido = [
            'carrito' => session('carrito', []), // Supongo que tienes el carrito en la sesión
            'delivery_option' => $validated['delivery_option'],
            'datos_entrega' => $validated['delivery_option'] === 'delivery' ? [
                'nombre' => $validated['nombre'],
                'direccion' => $validated['direccion'],
                'telefono' => $validated['telefono'],
                'correo' => $validated['correo'],
            ] : null,
        ];
    
        // Guardar en sesión (simulación para invitados)
        session(['pedido' => $pedido]);
    
        // Redirigir a la confirmación
        return redirect()->route('guest.checkout.confirm')->with('success', 'Pedido procesado exitosamente.');
    }
    

    public function confirmacion()
    {
        // Obtener la última venta del usuario autenticado
        $venta = Venta::where('rut_usuario', auth()->user()->rut_usuario)
            ->with('detalles.producto') // Cargar detalles y productos relacionados
            ->latest('created_at') // Ordenar por la venta más reciente
            ->first();
    
        // Validar que se haya encontrado una venta
        if (!$venta) {
            return redirect()->route('guest.home')->with('error', 'No se encontró una venta reciente.');
        }
    
        // Datos del comprador
        $comprador = auth()->user()->rol === 'invitado'
            ? (object) session('guest_data') // Obtener datos de la sesión para invitados
            : auth()->user(); // Obtener datos del modelo de usuario para usuarios registrados
    
        // Pasar datos a la vista
        return view('guest.confirmacion', compact('venta', 'comprador'));
    }
    

    
    
    
}
