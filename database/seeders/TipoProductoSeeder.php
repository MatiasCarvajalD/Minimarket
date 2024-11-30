<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_producto')->insert([
            ['categoria' => 'Bebidas'],
            ['categoria' => 'Lácteos'],
            ['categoria' => 'Cecinas'],
            ['categoria' => 'Panadería'],
            ['categoria' => 'Galletas'],
        ]);
    }
}
