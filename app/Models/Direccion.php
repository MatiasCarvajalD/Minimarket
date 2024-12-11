<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $table = 'direcciones';

    protected $fillable = [
        'rut_usuario', 'direccion'
    ];

    // Relación inversa con usuarios
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'rut_usuario', 'rut_usuario');
    }
}
