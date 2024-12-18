<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'productos';
    protected $primaryKey = 'cod_producto';
    protected $dates = ['deleted_at']; 


    protected $fillable = [
        'nom_producto',
        'descripcion',
        'marca',
        'precio',
        'stock_actual',
        'stock_critico',
        'id_categoria',
        'imagen',
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
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'id_categoria', 'id_categoria');
    }
}

