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

    public function index()
    {
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->with('producto')->get();

        $subtotal = $carrito->sum(fn($item) => $item->calculateSubtotal());

        return view('carrito.index', compact('carrito', 'subtotal'));
    }

    public function add($cod_producto)
    {
        $producto = Producto::findOrFail($cod_producto);

        Carrito::updateOrCreate(
            ['rut_usuario' => auth()->user()->rut_usuario, 'cod_producto' => $producto->cod_producto],
            ['cantidad' => \DB::raw('cantidad + 1')]
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

    public function updateQuantity(Request $request, $id_carrito)
    {
        $validated = $request->validate(['cantidad' => 'required|integer|min:1']);

        $carritoItem = Carrito::findOrFail($id_carrito);
        $carritoItem->update(['cantidad' => $validated['cantidad']]);

        return redirect()->route('carrito.index')->with('success', 'Cantidad actualizada.');
    }

    // Muestra el formulario de checkout
    public function checkout()
    {
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->with('producto')->get();
    
        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }
    
        return view('carrito.checkout', compact('carrito'));
    }
    
    
    public function confirm()
    {
        $venta = Venta::where('rut_usuario', auth()->user()->rut_usuario)
            ->with('detalles.producto')
            ->latest('created_at')
            ->first();
    
        if (!$venta) {
            return redirect()->route('guest.home')->with('error', 'No se encontró una venta reciente.');
        }
    
        $comprador = auth()->user(); // Datos del usuario autenticado
    
        return view('carrito.confirm', compact('venta', 'comprador'));
    }
    
    
    
    public function confirmCheckout(Request $request)
    {
        $carrito = Carrito::where('rut_usuario', auth()->user()->rut_usuario)->get();
    
        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }
    
        // Validar los datos enviados por el formulario
        $validated = $request->validate([
            'tipo_entrega' => 'required|string|in:delivery,retiro',
            'direccion' => $request->tipo_entrega === 'delivery' ? 'required|string|max:255' : 'nullable',
            'metodo_pago' => 'required|string|in:efectivo,tarjeta',
            'nombre' => auth()->user()->rol === 'invitado' ? 'required|string|max:255' : 'nullable',
            'telefono' => auth()->user()->rol === 'invitado' ? 'required|numeric' : 'nullable',
            'correo' => auth()->user()->rol === 'invitado' ? 'required|email' : 'nullable',
        ]);
    
        // Guardar datos del invitado en la sesión
        if (auth()->user()->rol === 'invitado') {
            session([
                'guest_data' => [
                    'direccion' => $validated['direccion'],
                    'nombre' => $validated['nombre'],
                    'telefono' => $validated['telefono'],
                    'correo' => $validated['correo'],
                ],
            ]);
        }
    
        // Crear la venta
        $venta = Venta::create([
            'rut_usuario' => auth()->user()->rut_usuario,
            'tipo_entrega' => $validated['tipo_entrega'],
            'metodo_pago' => $validated['metodo_pago'],
            'entrega_completada' => false,
        ]);
    
        // Guardar detalles de la venta
        foreach ($carrito as $item) {
            DetalleVenta::create([
                'id_venta' => $venta->id_venta,
                'cod_producto' => $item->cod_producto,
                'cantidad' => $item->cantidad,
                'valor_unidad' => $item->producto->precio,
            ]);
        }
    
        // Vaciar el carrito después de la compra
        Carrito::where('rut_usuario', auth()->user()->rut_usuario)->delete();
    
        // Redirigir según el tipo de usuario
        if (auth()->user()->rol === 'invitado') {
            return redirect()->route('guest.confirmacion')->with('venta_id', $venta->id_venta);
        } else {
            return redirect()->route('carrito.confirm')->with('venta_id', $venta->id_venta);
        }
    }

    public function showConfirm()
    {
        // Obtener la última venta del usuario autenticado
        $venta = Venta::where('rut_usuario', auth()->user()->rut_usuario)
            ->latest('created_at')
            ->with('detalles.producto') // Relación con los detalles y productos comprados
            ->first();

        if (!$venta) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró ninguna venta reciente.');
        }

        return view('carrito.confirm', compact('venta'));
    }


}
