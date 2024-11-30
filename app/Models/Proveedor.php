<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'rut_proveedor',
        'nom_proveedor',
        'telefono_proveedor',
        'direccion_proveedor',
        'correo_proveedor',
    ];

    public function compras()
    {
        return $this->hasMany(DetalleCompra::class, 'id_proveedor', 'id_proveedor');
    }
}
