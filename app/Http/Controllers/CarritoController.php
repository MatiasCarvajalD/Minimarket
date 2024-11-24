<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function add(Request $request)
    {
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad', 1);

        $carrito = session()->get('carrito', []);
        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] += $cantidad;
        } else {
            $producto = Producto::findOrFail($productoId);
            $carrito[$productoId] = [
                'nombre' => $producto->nom_producto,
                'precio' => $producto->precio,
                'cantidad' => $cantidad,
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    public function remove($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}
