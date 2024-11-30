<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $table = 'detalle_carrito';

    protected $fillable = [
        'rut_usuario',
        'cod_producto',
        'cantidad',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'rut_usuario', 'rut_usuario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'cod_producto', 'cod_producto');
    }
}
