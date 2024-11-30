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
                'id_carrito' => 1, // Este campo depende de tu migración; verifica si existe
                'rut_usuario' => 12345678,
                'cod_producto' => 1,
                'cantidad' => 3,
                'created_at' => now(), // Solo si la tabla incluye timestamps
                'updated_at' => now(),
            ],
            [
                'id_carrito' => 2, // Este campo depende de tu migración; verifica si existe
                'rut_usuario' => 87654321,
                'cod_producto' => 2,
                'cantidad' => 2,
                'created_at' => now(), // Solo si la tabla incluye timestamps
                'updated_at' => now(),
            ],
        ]);
    }
}
