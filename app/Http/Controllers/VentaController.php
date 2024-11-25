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

    // Procesar compra desde el carrito
    public function store(Request $request)
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        $request->validate([
            'direccion' => 'required|string|max:255',
            'tipo_entrega' => 'required|in:1,2',
        ]);

        // Crear la venta
        $venta = Venta::create([
            'rut_usuario' => auth()->user()->rut_usuario ?? 'invitado', // Si es invitado, asignamos un rut genérico
            'tipo_entrega' => $request->input('tipo_entrega'),
            'direccion' => $request->input('direccion'),
            'entrega_completada' => false,
        ]);

        $total = 0;

        foreach ($carrito as $cod_producto => $item) {
            $producto = Producto::findOrFail($cod_producto);

            // Registrar detalle de la venta
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'cod_producto' => $producto->cod_producto,
                'cantidad' => $item['cantidad'],
                'precio' => $producto->precio,
            ]);

            // Actualizar stock del producto
            $producto->stock_actual -= $item['cantidad'];
            $producto->save();

            $total += $producto->precio * $item['cantidad'];
        }

        // Actualizar total de la venta
        $venta->update(['total' => $total]);

        // Vaciar el carrito
        session()->forget('carrito');

        return redirect()->route('home')->with('success', 'Compra realizada con éxito.');
    }

    // Eliminar una venta (opcional, solo para administradores)
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
