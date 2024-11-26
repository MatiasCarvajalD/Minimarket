<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCheckout extends Model
{
    use HasFactory;

    protected $table = 'detalles_checkout';

    protected $fillable = [
        'id_venta',
        'direccion',
        'metodo_pago',
    ];

    // Relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}
