<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'rut_usuario'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'rut_usuario', 'nombre', 'email', 'password', 'rol',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_usuario', 'id');
    }


    public function carrito()
    {
        return $this->belongsToMany(Producto::class, 'detalle_carrito', 'rut_usuario', 'cod_producto')
                    ->withPivot('cantidad');
    }

}
