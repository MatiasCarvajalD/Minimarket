<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Proveedor extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $dates = ['deleted_at']; // Campo necesario para SoftDeletes


    protected $fillable = [
        'rut_proveedor',
        'nom_proveedor',
        'telefono_proveedor',
        'direccion_proveedor',
        'correo_proveedor',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'rut_proveedor', 'rut_proveedor')->withTrashed();
    }
    
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'rut_proveedor', 'rut_proveedor')->withTrashed();
    }

}
