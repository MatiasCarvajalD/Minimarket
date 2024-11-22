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
        'id_categoria',
        'precio',
        'stock_actual',
        'stock_critico',
    ];

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'id_categoria', 'id_categoria');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'cod_producto', 'cod_producto');
    }

    public function detalleCarritos()
    {
        return $this->hasMany(DetalleCarrito::class, 'cod_producto', 'cod_producto');
    }

    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class, 'cod_producto', 'cod_producto');
    }
}



