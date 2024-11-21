<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TipoProducto; // Importa el modelo TipoProducto
use App\Models\Producto; // Importar el modelo Producto


class TipoProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_tipo_producto_relations()
    {
        // Crear una categoría
        $tipo = TipoProducto::create(['categoria' => 'Lácteos']);

        // Asegurarte de que id_categoria no es null
        $this->assertNotNull($tipo->id_categoria, 'id_categoria no debería ser null');

        // Crear un producto asociado a la categoría
        $producto = Producto::create([
            'nom_producto' => 'Leche',
            'id_categoria' => $tipo->id_categoria,
            'precio' => 1000,
            'stock_actual' => 50,
            'stock_critico' => 5,
        ]);

        // Validar que el producto esté relacionado con la categoría
        $this->assertTrue($tipo->productos->contains($producto));
    }
}


