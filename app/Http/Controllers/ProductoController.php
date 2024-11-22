<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('tipoProducto')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = TipoProducto::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_producto' => 'required|max:100',
            'id_categoria' => 'required|exists:tipo_producto,id_categoria',
            'precio' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_critico' => 'required|integer|min:0',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }
}

