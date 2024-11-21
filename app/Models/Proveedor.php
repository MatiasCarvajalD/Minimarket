<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';
    protected $primaryKey = 'rut_proveedor';
    public $incrementing = false;
    protected $keyType = 'bigInteger';

    public function compras()
    {
        return $this->hasMany(Compra::class, 'rut_proveedor', 'rut_proveedor');
    }
}
