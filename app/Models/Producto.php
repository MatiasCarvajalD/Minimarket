<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'cod_producto'; // Clave primaria de la tabla
    protected $fillable = [
        'nom_producto',  // Nombre del producto
        'marca',         // Marca del producto
        'descripcion',   // Descripción del producto
        'precio',        // Precio del producto
        'id_categoria',  // ID de la categoría a la que pertenece
        'stock_actual',  // Cantidad de stock actual
        'stock_critico', // Nivel de stock crítico
    ];

    // Relación con el modelo TipoProducto
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'id_categoria', 'id_categoria');
    }

    // Relación con DetalleVenta
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'cod_producto', 'cod_producto');
    }

    // Relación con DetalleCarrito
    public function detalleCarritos()
    {
        return $this->hasMany(DetalleCarrito::class, 'cod_producto', 'cod_producto');
    }

    // Relación con DetalleCompra
    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class, 'cod_producto', 'cod_producto');
    }
}

