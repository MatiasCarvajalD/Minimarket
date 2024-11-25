<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarritoSeeder extends Seeder
{
    public function run()
    {
        DB::table('carrito')->insert([
            [
                'id_carrito'
                'rut_usuario' => 12345678, // Relación válida con la tabla usuarios
                'cod_producto' => 1,       // Relación válida con la tabla productos
                'cantidad' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rut_usuario' => 87654321, // Otro usuario
                'cod_producto' => 2,       // Otro producto
                'cantidad' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
