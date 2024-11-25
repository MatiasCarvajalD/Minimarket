<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function index()
    {
        if (session()->has('guest')) {
            $carrito = session()->get('carrito', []);
        } elseif (Auth::check()) {
            $carrito = Auth::user()->carrito; // Relación con carrito si existe en el modelo Usuario
        } else {
            return redirect('/login')->with('message', 'Debes iniciar sesión o entrar como invitado.');
        }

        $total = collect($carrito)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });

        return view('carrito.index', compact('carrito', 'total'));
    }

    public function add(Request $request)
    {
        $producto = Producto::findOrFail($request->input('producto_id'));
        $cantidad = $request->input('cantidad', 1);

        if (session()->has('guest')) {
            $carrito = session()->get('carrito', []);
            if (isset($carrito[$producto->cod_producto])) {
                $carrito[$producto->cod_producto]['cantidad'] += $cantidad;
            } else {
                $carrito[$producto->cod_producto] = [
                    'nombre' => $producto->nom_producto,
                    'precio' => $producto->precio,
                    'cantidad' => $cantidad,
                ];
            }
            session()->put('carrito', $carrito);
        } elseif (Auth::check()) {
            // Lógica para usuarios logueados
        }

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    public function remove($id)
    {
        if (session()->has('guest')) {
            // Manejo del carrito en sesión (para invitados)
            $carrito = session()->get('carrito', []);
            if (isset($carrito[$id])) {
                unset($carrito[$id]); // Eliminar el producto del carrito
                session()->put('carrito', $carrito);
            }
        } elseif (Auth::check()) {
            // Manejo del carrito en base de datos (para usuarios logueados)
            $usuario = Auth::user();
            $producto = $usuario->carrito()->where('cod_producto', $id)->first();
            if ($producto) {
                $producto->pivot->delete(); // Eliminar producto de la relación en DB
            }
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        if (session()->has('guest')) {
            // Manejo del carrito en sesión (para invitados)
            session()->forget('carrito'); // Eliminar todo el carrito de la sesión
        } elseif (Auth::check()) {
            // Manejo del carrito en base de datos (para usuarios logueados)
            $usuario = Auth::user();
            $usuario->carrito()->detach(); // Eliminar todos los productos de la relación
        }

        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }

}


