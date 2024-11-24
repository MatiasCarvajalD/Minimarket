<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Tests\TestCase;
use App\Models\Producto;
use App\Models\TipoProducto;

class ProductoTest extends TestCase
{
    public function testProductoRelacionConTipoProducto()
    {
        $tipo = TipoProducto::factory()->create();
        $producto = Producto::factory()->create(['id_categoria' => $tipo->id_categoria]);

        $this->assertEquals($tipo->id_categoria, $producto->tipoProducto->id_categoria);
    }
}
