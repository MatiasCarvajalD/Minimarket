<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Compra;
use App\Models\DetalleCompra;
use Carbon\Carbon;

class VentaCompraSeeder extends Seeder
{
    public function run()
    {
        // Fecha del mes anterior
        $mesAnterior = Carbon::now()->subMonth();

        // Crear una Venta
        $venta = Venta::create([
            'rut_usuario' => '87654321',
            'tipo_entrega' => 'delivery',
            'metodo_pago' => 'efectivo',
            'entrega_completada' => false,
            'fecha' => $mesAnterior->format('Y-m-d'),
        ]);

        DetalleVenta::create([
            'id_venta' => $venta->id_venta,
            'cod_producto' => 1,
            'cantidad' => 2,
            'valor_unidad' => 1500,
        ]);

        // Crear una Compra
        $compra = Compra::create([
            'rut_proveedor' => '123456789',
            'fecha' => $mesAnterior->format('Y-m-d'),
        ]);

        DetalleCompra::create([
            'cod_compra' => $compra->cod_compra,
            'cod_producto' => 2,
            'cantidad' => 10,
            'valor_unitario' => 1000,
            'subtotal' => 10 * 1000,
        ]);
    }
}
