<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_producto')->insert([
            // Categorías Minimarket
            ['id_categoria' => 1, 'categoria' => 'Bebidas (Minimarket)'],
            ['id_categoria' => 2, 'categoria' => 'Lácteos'],
            ['id_categoria' => 3, 'categoria' => 'Cecinas'],
            ['id_categoria' => 4, 'categoria' => 'Panadería'],
            ['id_categoria' => 5, 'categoria' => 'Galletas'],
            ['id_categoria' => 6, 'categoria' => 'Snacks'],
            ['id_categoria' => 7, 'categoria' => 'Limpieza'],

            // Categorías Restaurante
            ['id_categoria' => 8, 'categoria' => 'Entradas'],
            ['id_categoria' => 9, 'categoria' => 'Platos Fuertes'],
            ['id_categoria' => 10, 'categoria' => 'Postres'],
            ['id_categoria' => 11, 'categoria' => 'Sandwiches'],
            ['id_categoria' => 12, 'categoria' => 'Papas Fritas y Guarniciones'],
            ['id_categoria' => 13, 'categoria' => 'Bebidas (Restaurante)'],
            ['id_categoria' => 14, 'categoria' => 'Coctelería'],
        ]);
    }
}
