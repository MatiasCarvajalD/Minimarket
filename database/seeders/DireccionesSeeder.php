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
                'rut_usuario' => '87654321',
                'calle' => 'Avenida Siempre Viva 123',
                'ciudad' => 'Coquimbo',
                'region' => 'IV Coquimbo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rut_usuario' => '87654321',
                'calle' => 'Calle Falsa 456',
                'ciudad' => 'Rancagua',
                'region' => 'VI Rancagua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
