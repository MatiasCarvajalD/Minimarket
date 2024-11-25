<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TipoProducto;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Producto::paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }
    

    // Mostrar formulario para crear un producto
    public function create()
    {
        $categorias = TipoProducto::all();
        return view('productos.create', compact('categorias'));
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nom_producto' => 'required|string|max:255',
            'marca' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:tipo_producto,id_categoria',
            'stock_actual' => 'required|integer|min:0',
            'stock_critico' => 'required|integer|min:0',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar formulario para editar un producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = TipoProducto::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_producto' => 'required|string|max:255',
            'marca' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:tipo_producto,id_categoria',
            'stock_actual' => 'required|integer|min:0',
            'stock_critico' => 'required|integer|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
