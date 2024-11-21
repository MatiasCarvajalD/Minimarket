<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compra';
    protected $primaryKey = 'cod_compra';

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'rut_proveedor', 'rut_proveedor');
    }

    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class, 'cod_compra', 'cod_compra');
    }
}
