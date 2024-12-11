<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';
    protected $primaryKey = 'id_carrito';

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
    public function calculateSubtotal()
    {
        return $this->producto->precio * $this->cantidad;
    }
}
