<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ajuste;
use App\Models\Producto;

class AjusteController extends Controller
{
    // Mostrar la lista de ajustes
    public function index()
    {
        $ajustes = Ajuste::with('producto')->get(); // Trae ajustes con el producto asociado
        return view('admin.ajustes.index', compact('ajustes'));
    }

    // Mostrar formulario para crear un ajuste
    public function create()
    {
        $productos = Producto::all(); // Obtener todos los productos
        return view('admin.ajustes.create', compact('productos'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cod_producto' => 'required|exists:productos,cod_producto',
            'cantidad' => 'required|integer',
            'tipo_ajuste' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);
    
        // Crear el ajuste
        $ajuste = Ajuste::create([
            'cod_producto' => $request->cod_producto,
            'cantidad' => $request->cantidad,
            'fecha' => now(),
            'tipo_ajuste' => $request->tipo_ajuste,
            'descripcion' => $request->descripcion,
        ]);
    
        // Actualizar el stock del producto
        $producto = Producto::where('cod_producto', $request->cod_producto)->first();
    
        if ($request->tipo_ajuste === 'regalo' || $request->tipo_ajuste === 'fiado') {
            // Resta stock si el producto es un regalo o fiado
            $producto->stock_actual -= $request->cantidad;
        } elseif ($request->tipo_ajuste === 'mercaderia_recibida') {
            // Suma stock si se recibe mercadería
            $producto->stock_actual += $request->cantidad;
        }
    
        $producto->save();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('admin.ajustes.index')->with('success', 'Ajuste guardado y stock actualizado correctamente.');
    }
    
}
