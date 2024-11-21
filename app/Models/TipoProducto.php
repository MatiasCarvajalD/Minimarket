<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto'; // Nombre de la tabla
    protected $primaryKey = 'id_categoria'; // Clave primaria
    public $incrementing = true; // Auto-incremental
    protected $keyType = 'int'; // Tipo de la clave primaria
    protected $fillable = ['categoria']; // Permitir asignación masiva

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }
}

