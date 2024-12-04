<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class GuestController extends Controller
{
    // Muestra el catálogo de productos
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

    // Muestra el carrito del invitado (almacenado en la sesión)
    public function carrito()
    {
        $carrito = session('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    // Agrega un producto al carrito
    public function addToCart($cod_producto)
    {
        $producto = Producto::findOrFail($cod_producto);
        $carrito = session('carrito', []);

        if (isset($carrito[$cod_producto])) {
            $carrito[$cod_producto]['cantidad'] += 1;
        } else {
            $carrito[$cod_producto] = [
                'producto' => $producto,
                'cantidad' => 1,
            ];
        }

        session(['carrito' => $carrito]);

        return redirect()->route('guest.carrito')->with('success', 'Producto agregado al carrito.');
    }

    // Elimina un producto del carrito
    public function removeFromCart($cod_producto)
    {
        $carrito = session('carrito', []);
        unset($carrito[$cod_producto]);
        session(['carrito' => $carrito]);

        return redirect()->route('guest.carrito')->with('success', 'Producto eliminado del carrito.');
    }

    // Muestra el formulario de checkout
    public function checkout()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('guest.carrito')->with('error', 'El carrito está vacío.');
        }

        return view('carrito.checkout_guest', compact('carrito'));
    }

    // Procesa la compra del invitado
    public function confirmCheckout(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'direccion' => 'required|string|max:255',
            'metodo_pago' => 'required|string|in:efectivo,tarjeta',
        ]);

        // Procesar la compra como invitado (puedes guardar estos datos en una tabla de pedidos)

        session()->forget('carrito'); // Vaciar el carrito tras finalizar la compra

        return redirect()->route('guest.catalogo')->with('success', 'Compra realizada con éxito.');
    }
}
