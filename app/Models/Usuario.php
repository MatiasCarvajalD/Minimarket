<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; // Tabla asociada
    protected $primaryKey = 'id'; // Clave primaria

    protected $fillable = [
        'nombre',       // Campo de nombre
        'email',        // Campo de correo
        'password',     // Contraseña encriptada
        'rol',          // Campo adicional para roles 
    ];

    protected $hidden = [
        'password',
        'remember_token',
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
