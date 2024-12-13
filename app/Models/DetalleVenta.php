<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta';

    protected $fillable = [
        'id_venta',
        'cod_producto',
        'cantidad',
        'valor_unidad',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'cod_producto', 'cod_producto');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }
    
    public function calculateSubtotal()
    {
        return $this->cantidad * $this->valor_unidad;
    }
    
}
