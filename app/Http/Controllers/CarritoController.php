<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;

class CarritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Muestra el carrito del usuario
    public function index()
    {
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->with('producto')->get();
        return view('carrito.index', compact('carrito'));
    }

    // Agrega un producto al carrito
    public function add($cod_producto)
    {
        $producto = Producto::findOrFail($cod_producto);

        Carrito::updateOrCreate(
            [
                'rut_usuario' => auth()->user()->rut_usuario,
                'cod_producto' => $producto->cod_producto,
            ],
            [
                'cantidad' => \DB::raw('cantidad + 1'),
            ]
        );

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    // Elimina un producto del carrito
    public function remove($id_carrito)
    {
        $carrito = Carrito::findOrFail($id_carrito);
        $carrito->delete();

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }

    // Muestra el formulario de checkout
    public function checkout()
    {
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->get();
    
        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }
    
        // La dirección del usuario ya está almacenada en auth()->user()->direccion
        return view('carrito.checkout', compact('carrito'));
    }
    
    public function confirm(Request $request)
    {
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->get();
    
        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }
    
        return view('carrito.confirm', compact('carrito'));
    }
    


    public function confirmCheckout(Request $request)
    {
        $validated = $request->validate([
            'tipo_entrega' => 'required|string|in:delivery,retiro',
        ]);
    
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->get();
    
        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }
    
        // Crear la venta
        $venta = Venta::create([
            'rut_usuario' => auth()->user()->rut_usuario,
            'tipo_entrega' => $validated['tipo_entrega'],
            'entrega_completada' => false,
        ]);
    
        // Registrar los detalles de la venta
        foreach ($carrito as $item) {
            DetalleVenta::create([
                'id_venta' => $venta->id_venta,
                'cod_producto' => $item->cod_producto,
                'cantidad' => $item->cantidad,
                'valor_unidad' => $item->producto->precio,
            ]);
        }
    
        // Vaciar el carrito
        Carrito::where('rut_usuario', auth()->user()->rut_usuario)->delete();
    
        return redirect()->route('carrito.index')->with('success', 'Compra realizada con éxito.');
    }
    



    public function showConfirm()
    {
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        return view('carrito.confirm', compact('carrito'));
    }


}
