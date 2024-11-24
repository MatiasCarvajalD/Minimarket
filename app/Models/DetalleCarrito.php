<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $table = 'detalle_carrito';

    protected $fillable = [
        'carrito_id',
        'producto_id',
        'cantidad',
        'precio',
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'cod_producto');
    }
}
