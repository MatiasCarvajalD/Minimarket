<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class AdminProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_producto' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock_actual' => 'required|integer',
        ]);

        Producto::create($validated);

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($cod_producto)
    {
        $producto = Producto::findOrFail($cod_producto);
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, $cod_producto)
    {
        $producto = Producto::findOrFail($cod_producto);

        $validated = $request->validate([
            'nom_producto' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock_actual' => 'required|integer',
        ]);

        $producto->update($validated);

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($cod_producto)
    {
        $producto = Producto::findOrFail($cod_producto);
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
