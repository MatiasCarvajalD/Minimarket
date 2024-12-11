<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DireccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('direcciones')->insert([
            [
                'rut_usuario' => 87654321,
                'direccion' => 'Avenida Siempre Viva 123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rut_usuario' => 87654321,
                'direccion' => 'Calle Falsa 456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
