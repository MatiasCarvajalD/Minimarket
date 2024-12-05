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
        $categorias = TipoProducto::with('productos')->get(); // Cargar las categorías con sus productos
        return view('productos.index', compact('categorias'));
    }
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.detalle', compact('producto'));
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
        // Obtén las categorías y productos solo del Minimarket
        $categorias = TipoProducto::with(['productos' => function ($query) {
            $query->whereIn('id_categoria', [1, 2, 3, 4, 5, 6, 7]); // Filtra las categorías del Minimarket
        }])->whereIn('id_categoria', [1, 2, 3, 4, 5, 6, 7])->get();

        return view('productos.index', compact('categorias'));
    }

    

    public function restaurant()
    {
        // Obtén solo las categorías del Restaurante (id_categoria >= 8 en este caso)
        $categorias = TipoProducto::with(['productos' => function ($query) {
            $query->whereIn('id_categoria', [8, 9, 10, 11, 12, 13, 14]); // Categorías del Restaurante
        }])->whereIn('id_categoria', [8, 9, 10, 11, 12, 13, 14])->get();

        return view('restaurant.index', compact('categorias'));
    }



}
