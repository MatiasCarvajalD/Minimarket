<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla
    protected $primaryKey = 'cod_producto'; // Clave primaria

    protected $fillable = [
        'nom_producto', // Nombre del producto
        'marca',        // Marca del producto
        'descripcion',  // Descripción del producto
        'precio',       // Precio del producto
        'id_categoria', // Relación con tipo_producto
        'stock_actual', // Stock actual del producto
        'stock_critico' // Stock crítico del producto
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
