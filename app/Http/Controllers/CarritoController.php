<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\DetalleCheckout;

class CarritoController extends Controller
{
    // Mostrar los productos en el carrito
    public function index()
    {
        $carrito = Carrito::with('productos')->where('rut_usuario', auth()->id())->first();
        return view('carrito.index', compact('carrito'));
    }

    // Añadir un producto al carrito
    public function add(Request $request)
    {
        $request->validate([
            'cod_producto' => 'required|exists:productos,cod_producto',
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito = Carrito::firstOrCreate(['rut_usuario' => auth()->id()]);

        // Verificar si ya existe el producto en el carrito
        $detalle = DetalleCarrito::where('id_carrito', $carrito->id_carrito)
            ->where('cod_producto', $request->cod_producto)
            ->first();

        if ($detalle) {
            // Incrementar cantidad si ya existe
            $detalle->cantidad += $request->cantidad;
            $detalle->save();
        } else {
            // Agregar nuevo producto
            DetalleCarrito::create([
                'id_carrito' => $carrito->id_carrito,
                'cod_producto' => $request->cod_producto,
                'cantidad' => $request->cantidad,
            ]);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto añadido al carrito.');
    }

    // Eliminar un producto del carrito
    public function remove($id)
    {
        $detalle = DetalleCarrito::findOrFail($id);
        $detalle->delete();

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }

    // Vaciar el carrito
    public function clear()
    {
        $carrito = Carrito::where('rut_usuario', auth()->id())->first();
        if ($carrito) {
            $carrito->productos()->detach(); // Eliminar todos los productos del carrito
        }

        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }

    // Mostrar la página de checkout
    public function checkout()
    {
        $carrito = Carrito::with('productos')->where('rut_usuario', auth()->id())->first();

        if (!$carrito || $carrito->productos->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        return view('carrito.checkout', compact('carrito'));
    }

    // Procesar el checkout
    public function procesarCheckout(Request $request)
    {
        $request->validate([
            'direccion' => 'required|string|max:255',
            'metodo_pago' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            // Crear la venta
            $venta = Venta::create([
                'rut_usuario' => auth()->id(),
                'tipo_entrega' => 1, // Ejemplo: 1 para delivery
                'entrega_completada' => 0, // Inicialmente no completada
                'fecha' => now(),
            ]);

            // Guardar los detalles del checkout
            DetalleCheckout::create([
                'id_venta' => $venta->id_venta,
                'direccion' => $request->direccion,
                'metodo_pago' => $request->metodo_pago,
            ]);

            // Guardar los detalles de la venta y reducir el stock
            $carrito = Carrito::with('productos')->where('rut_usuario', auth()->id())->first();

            foreach ($carrito->productos as $producto) {
                DetalleVenta::create([
                    'id_venta' => $venta->id_venta,
                    'cod_producto' => $producto->cod_producto,
                    'cantidad' => $producto->pivot->cantidad,
                    'valor_unidad' => $producto->precio,
                ]);

                // Reducir el stock del producto
                $producto->decrement('stock_actual', $producto->pivot->cantidad);
            }

            // Vaciar el carrito después de procesar la venta
            $carrito->productos()->detach();
        });

        return redirect()->route('home')->with('success', 'Compra realizada con éxito.');
    }
}
