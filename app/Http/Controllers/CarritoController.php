<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $rutUsuario = Auth::user()->rut_usuario;

        $carrito = Carrito::with('producto')->where('rut_usuario', $rutUsuario)->get();

        return view('carrito.index', compact('carrito'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'cod_producto' => 'required|exists:productos,cod_producto',
            'cantidad' => 'required|integer|min:1',
        ]);

        Carrito::create([
            'rut_usuario' => Auth::user()->rut_usuario,
            'cod_producto' => $request->cod_producto,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    public function remove($id_carrito)
    {
        $detalle = Carrito::findOrFail($id_carrito); // Busca el registro por ID
        $detalle->delete(); // Elimina el registro
        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}
