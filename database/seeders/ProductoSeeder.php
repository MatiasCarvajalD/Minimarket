<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        Producto::create([
            'nom_producto' => 'Leche Entera',
            'marca' => 'Colun',
            'descripcion' => 'Leche entera Colun en caja de 1 litro',
            'precio' => 1200,
            'id_categoria' => 1,
            'stock_actual' => 50,
            'stock_critico' => 10,
        ]);

        Producto::create([
            'nom_producto' => 'Coca Cola',
            'marca' => 'Coca Cola',
            'descripcion' => 'Botella de Coca Cola 1.5L',
            'precio' => 1500,
            'id_categoria' => 2,
            'stock_actual' => 30,
            'stock_critico' => 5,
        ]);
    }
}
