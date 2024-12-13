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
}
