<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Listar todas las ventas
    public function index()
    {
        $ventas = Venta::with('detalles.producto')->get();
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar detalles de una venta específica
    public function show($id)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    // Registrar una nueva venta
    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,cod_producto',
            'productos.*.cantidad' => 'required|numeric|min:1',
        ]);

        // Crear una nueva venta
        $venta = Venta::create([
            'usuario_id' => auth()->id(),
            'total' => 0, // Este se calculará más adelante
        ]);

        $total = 0;

        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['id']);
            
            // Registrar detalle de la venta
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'cod_producto' => $producto->cod_producto,
                'cantidad' => $item['cantidad'],
                'precio' => $producto->precio,
            ]);

            // Actualizar el stock del producto
            $producto->stock_actual -= $item['cantidad'];
            $producto->save();

            // Calcular el total de la venta
            $total += $producto->precio * $item['cantidad'];
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
    }

    // Eliminar una venta (opcional, solo para administradores)
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
