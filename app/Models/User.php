<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'rut_usuario';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'rut_usuario',
        'nombre_usuario',
        'email',
        'password',
        'telefono',
        'rol',
    ];

    public function carrito()
    {
        return $this->hasMany(Carrito::class, 'rut_usuario', 'rut_usuario');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'rut_usuario', 'rut_usuario');
    }
    public function currentCarrito()
    {
        return $this->carrito()->get();
    }

    // Método para obtener ventas recientes
    public function recentVentas()
    {
        return $this->ventas()->orderBy('fecha', 'desc')->limit(5)->get();
    }
    public function direcciones()
    {
        return $this->hasMany(Direccion::class, 'rut_usuario', 'rut_usuario');
    }

}
