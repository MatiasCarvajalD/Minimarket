<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TipoProductoSeeder::class,
            ProductoSeeder::class,
            UsuarioSeeder::class,
            ProveedorSeeder::class,
        ]);
    }
}
