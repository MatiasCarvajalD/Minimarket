<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TipoProducto;


class AdminProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = TipoProducto::all(); // Obtén todas las categorías
        return view('admin.productos.create', compact('categorias')); // Pásalas a la vista
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'nom_producto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'marca' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock_actual' => 'required|integer',
            'stock_critico' => 'required|integer',
            'id_categoria' => 'required|integer|exists:tipo_producto,id_categoria',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Procesar la imagen si se subió
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
        
            // Limpiar el nombre del archivo: quitar caracteres especiales y espacios
            $filename = preg_replace('/[^A-Za-z0-9.\-]/', '_', $file->getClientOriginalName());
            $filename = str_replace(' ', '_', $filename);
        
            // Opcional: agregar timestamp para garantizar un nombre único
            $filename = time() . '_' . $filename;
        
            // Guardar el archivo en storage
            $path = $file->storeAs('public/images', $filename);
        
            // Ajustar la ruta para acceder desde el navegador
            $validated['imagen'] = str_replace('public/', 'storage/', $path);
        }
        
        
    
        // Crear el producto
        Producto::create($validated);
    
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado con éxito');
    }
    
    
    

    public function edit($cod_producto)
    {
        $producto = Producto::findOrFail($cod_producto);
        $categorias = TipoProducto::all(); // Obtiene todas las categorías

        return view('admin.productos.edit', compact('producto','categorias'));
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
