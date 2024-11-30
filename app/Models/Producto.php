<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'cod_producto';

    protected $fillable = [
        'nom_producto',
        'descripcion',
        'marca',
        'precio',
        'stock_actual',
        'stock_critico',
        'id_categoria',
    ];

    public function categoria()
    {
        return $this->belongsTo(TipoProducto::class, 'id_categoria');
    }

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'cod_producto', 'cod_producto');
    }

    public function ventas()
    {
        return $this->hasMany(DetalleVenta::class, 'cod_producto', 'cod_producto');
    }

    public function compras()
    {
        return $this->hasMany(DetalleCompra::class, 'cod_producto', 'cod_producto');
    }
}

