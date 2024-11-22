<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoProducto;

class TipoProductoSeeder extends Seeder
{
    public function run()
    {
        TipoProducto::create(['categoria' => 'Lácteos']);
        TipoProducto::create(['categoria' => 'Bebidas']);
        TipoProducto::create(['categoria' => 'Snacks']);
    }
}
