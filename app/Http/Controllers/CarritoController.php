<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        $rutUsuario = Auth::user()->rut_usuario;
        $carrito = Carrito::with('producto')->where('rut_usuario', $rutUsuario)->get();

        return view('Usuario.carrito', compact('carrito'));
    }

    // Agregar producto al carrito
    public function add($id_carrito)
    {
        $rutUsuario = Auth::user()->rut_usuario;

        Carrito::create([
            'rut_usuario' => $rutUsuario,
            'cod_producto' => $id,
            'cantidad' => 1,
        ]);

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    // Eliminar producto del carrito
    public function remove($id_carrito)
    {
        $detalle = Carrito::findOrFail($id_carrito);
        $detalle->delete();

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
    public function checkout()
    {
        // Aquí puedes obtener los productos del carrito y mostrarlos en la vista de checkout
        $usuario = auth()->user();
        $carrito = Carrito::where('rut_usuario', $usuario->rut_usuario)->get();
        $productos = Producto::whereIn('cod_producto', $carrito->pluck('cod_producto'))->get();

        return view('carrito.checkout', compact('carrito', 'productos'));
    }

}
