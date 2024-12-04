<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;

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
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->with('producto')->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        return view('carrito.checkout', compact('carrito')); // Reutiliza "carrito.checkout"
    }

    // Procesa la compra
    public function confirmCheckout(Request $request)
    {
        $validated = $request->validate([
            'direccion' => 'required|string|max:255',
            'metodo_pago' => 'required|string|in:efectivo,tarjeta',
        ]);

        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        // Procesar la compra (aquí iría la lógica de crear un pedido y limpiar el carrito)

        Carrito::where('rut_usuario', auth()->user()->rut_usuario)->delete();

        return redirect()->route('carrito.index')->with('success', 'Compra realizada con éxito.');
    }
}
