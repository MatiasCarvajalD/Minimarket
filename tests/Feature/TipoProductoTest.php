<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TipoProducto;
use App\Models\Producto;

class TipoProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_tipo_producto_relations()
    {
        // Crear una categoría en tipo_producto
        $tipo = TipoProducto::create(['categoria' => 'Lácteos']);
    
        // Recuperar su id_categoria
        $idCategoria = $tipo->id_categoria;
    
        // Validar que id_categoria no sea null
        $this->assertNotNull($idCategoria, 'id_categoria debería tener un valor válido');
    
        // Crear un producto relacionado con la categoría
        $producto = Producto::create([
            'nom_producto' => 'Leche',
            'id_categoria' => $idCategoria, // Asociar correctamente la categoría
            'precio' => 1000,
            'stock_actual' => 50,
            'stock_critico' => 5,
        ]);
    
        // Verificar que el producto esté relacionado con la categoría
        $this->assertTrue($tipo->productos->contains($producto));
    }
    
}


