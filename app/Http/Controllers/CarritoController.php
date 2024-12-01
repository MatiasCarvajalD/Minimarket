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
    public function add($id)
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
}
