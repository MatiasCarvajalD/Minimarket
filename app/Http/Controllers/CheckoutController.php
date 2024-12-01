<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Mostrar página de checkout
    public function index()
    {
        $rutUsuario = Auth::user()->rut_usuario;
        $carrito = Carrito::with('producto')->where('rut_usuario', $rutUsuario)->get();
        $total = $carrito->sum(fn($detalle) => $detalle->producto->precio * $detalle->cantidad);

        return view('Usuario.checkout', compact('carrito', 'total'));
    }

    // Procesar compra
    public function store(Request $request)
    {
        $rutUsuario = Auth::user()->rut_usuario;
        $carrito = Carrito::with('producto')->where('rut_usuario', $rutUsuario)->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        // Guardar la venta
        $venta = Venta::create([
            'rut_usuario' => $rutUsuario,
            'direccion' => $request->direccion,
            'metodo_pago' => $request->metodo_pago,
            'total' => $carrito->sum(fn($detalle) => $detalle->producto->precio * $detalle->cantidad),
        ]);

        // Limpiar el carrito
        Carrito::where('rut_usuario', $rutUsuario)->delete();

        return redirect()->route('home')->with('success', 'Compra realizada con éxito.');
    }

    // Checkout para invitados
    public function invitadoIndex()
    {
        return view('Usuario.checkout_invitado');
    }

    public function invitadoStore(Request $request)
    {
        // Procesar compra para invitados
        // Similar a store(), pero sin autenticación

        return redirect()->route('home')->with('success', 'Compra realizada con éxito como invitado.');
    }
}
