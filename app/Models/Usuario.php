<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'rut_usuario'; // Clave primaria
    public $incrementing = false; // Porque no es autoincremental
    protected $keyType = 'bigInteger';

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'rut_usuario', 'rut_usuario');
    }

    public function carrito()
    {
        return $this->hasOne(Carrito::class, 'rut_usuario', 'rut_usuario');
    }
}
