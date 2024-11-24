<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    // Mostrar los productos en el carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = collect($carrito)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });

        return view('carrito.index', compact('carrito', 'total'));
    }

    // Agregar un producto al carrito
    public function add(Request $request)
    {
        $producto = Producto::findOrFail($request->input('producto_id'));
        $cantidad = $request->input('cantidad', 1);

        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, aumenta la cantidad
        if (isset($carrito[$producto->cod_producto])) {
            $carrito[$producto->cod_producto]['cantidad'] += $cantidad;
        } else {
            // Si no, agrega el producto al carrito
            $carrito[$producto->cod_producto] = [
                'nombre' => $producto->nom_producto,
                'precio' => $producto->precio,
                'cantidad' => $cantidad,
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    // Eliminar un producto del carrito
    public function remove($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }

    // Vaciar el carrito
    public function clear()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }
}

