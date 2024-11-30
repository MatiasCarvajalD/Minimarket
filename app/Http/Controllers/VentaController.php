<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function show($id_venta)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id_venta);
        return view('admin.ventas.show', compact('venta'));
    }
}
