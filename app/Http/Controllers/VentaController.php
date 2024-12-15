<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('detalles')->get(); // Ajusta según tu relación con 'detalles'
        return view('admin.ventas.index', compact('ventas'));
    }

    public function show($id_venta)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id_venta);
        $total = $venta->calculateTotal();
        return view('admin.ventas.show', compact('venta', 'total'));
    }
    public function cambiarEstado(Request $request, $id_venta)
    {
        // Validar el nuevo estado
        $request->validate([
            'entrega_completada' => 'required|boolean',
        ]);

        // Buscar la venta por su ID
        $venta = Venta::findOrFail($id_venta);

        // Actualizar el estado de la venta
        $venta->entrega_completada = $request->input('entrega_completada');
        $venta->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.ventas.index')->with('success', 'El estado de la venta se ha actualizado correctamente.');
    }

}
