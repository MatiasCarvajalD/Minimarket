<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'rut_usuario',
        'tipo_entrega',
        'metodo_pago',
        'entrega_completada',
        'fecha',
        'total',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'rut_usuario', 'rut_usuario');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id_venta');
    }
    
    public function detallesCheckout()
    {
        return $this->hasOne(DetallesCheckout::class, 'id_venta');
    }

        // Método para calcular el total de la venta
    public function calculateTotal()
    {
        return $this->detalles->sum(function ($detalle) {
            return $detalle->cantidad * $detalle->valor_unidad;
        });
    }
}
