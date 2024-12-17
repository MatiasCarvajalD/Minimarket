<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    use HasFactory;

    protected $table = 'ajuste';

    protected $fillable = [
        'cod_producto',
        'cantidad',
        'fecha',
        'tipo_ajuste',
        'descripcion',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'cod_producto', 'cod_producto');
    }
}
