<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TipoProducto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


class AdminProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::withTrashed()->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = TipoProducto::all();
        return view('admin.productos.create', compact('categorias')); 
    }

    
    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $validated = $request->validate([
                'nom_producto' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'marca' => 'required|string',
                'precio' => 'required|numeric|min:0',
                'stock_actual' => 'required|integer|min:0',
                'stock_critico' => 'required|integer|min:0',
                'id_categoria' => 'required|exists:tipo_producto,id_categoria',
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Crear la instancia de Producto
            $producto = new Producto();
            $producto->nom_producto = $validated['nom_producto'];
            $producto->descripcion = $validated['descripcion'];
            $producto->marca = $validated['marca'];
            $producto->precio = $validated['precio'];
            $producto->stock_actual = $validated['stock_actual'];
            $producto->stock_critico = $validated['stock_critico'];
            $producto->id_categoria = $validated['id_categoria'];
    
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
            
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9.\-]/', '_', $file->getClientOriginalName());
            
                $destinationPath = storage_path('app/public/images');
            
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
            
                $file->move($destinationPath, $filename);
            
                $producto->imagen = 'storage/images/' . $filename;
            
                \Log::info('Imagen guardada manualmente en: ' . $destinationPath . '/' . $filename);
            }
            $producto->save();
    
            return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al guardar el producto: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al guardar el producto.');
        }
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
    public function restoreProducto($cod_producto)
    {
        $producto = Producto::withTrashed()->findOrFail($cod_producto);
        $producto->restore(); // Restaurar el producto eliminado

        return redirect()->route('admin.productos.index')->with('success', 'Producto restaurado correctamente.');
    }
    public function forceDeleteProducto($cod_producto)
    {
        $producto = Producto::withTrashed()->findOrFail($cod_producto);
        $producto->forceDelete(); // Eliminar físicamente el producto

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado permanentemente.');
    }


}
