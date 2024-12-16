<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesCheckout extends Model
{
    use HasFactory;

    protected $table = 'detalles_checkout';

    protected $fillable = [
        'id_venta',
        'direccion',
        'metodo_pago',
    ];
}
