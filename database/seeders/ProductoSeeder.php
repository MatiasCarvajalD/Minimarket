<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nom_producto' => 'Coca-Cola',
                'marca' => 'Coca-Cola',
                'descripcion' => 'Bebida gaseosa',
                'precio' => 1500,
                'id_categoria' => 1,
                'stock_actual' => 50,
                'stock_critico' => 10,
            ],
            [
                'nom_producto' => 'Leche Entera',
                'marca' => 'Colún',
                'descripcion' => 'Leche entera en caja',
                'precio' => 1200,
                'id_categoria' => 2,
                'stock_actual' => 30,
                'stock_critico' => 5,
            ],
        ]);
    }
}

