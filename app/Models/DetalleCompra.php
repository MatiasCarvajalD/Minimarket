<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_compra';

    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'precio',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'cod_producto');
    }
}
