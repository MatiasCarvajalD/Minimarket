<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre_categoria',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }

    // Validación para asegurar unicidad de categorías
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
             if (self::where('nombre_categoria', $model->nombre_categoria)->exists()) {
                throw new \Exception('El nombre de la categoría debe ser único.');
             }
        });
    }
}
