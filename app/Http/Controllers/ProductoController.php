<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TipoProducto;

class ProductoController extends Controller
{
    // Muestra todos los productos
    public function index()
    {
        $productos = Producto::with('tipoProducto')->get();
        return view('productos.index', compact('productos'));
    }

    // Muestra un formulario para crear un nuevo producto
    public function create()
    {
        $categorias = TipoProducto::all();
        return view('productos.create', compact('categorias'));
    }

    // Guarda un nuevo producto en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_producto' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'marca' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_critico' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:tipo_producto,id_categoria',
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Muestra un formulario para editar un producto existente
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = TipoProducto::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualiza un producto existente
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nom_producto' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'marca' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_critico' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:tipo_producto,id_categoria',
        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Elimina un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    // Filtra productos por Minimarket
    public function minimarket()
    {
        $productos = Producto::whereHas('tipoProducto', function ($query) {
            $query->where('categoria', 'Minimarket');
        })->get();

        return view('Usuario.minimarket', compact('productos')); 
    }

    // Filtra productos por Restaurant
    public function restaurant()
    {
        $productos = Producto::whereHas('tipoProducto', function ($query) {
            $query->where('categoria', 'Restaurant');
        })->get();

        return view('Usuario.restaurant', compact('productos'));
    }

    public function show($id)
    {
        $producto = Producto::with('tipoProducto')->findOrFail($id);
        return view('productos.detalle', compact('producto'));
    }
}
