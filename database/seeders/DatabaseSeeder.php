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
            VentaSeeder::class,
            DetalleVentaSeeder::class,
            CarritoSeeder::class,
            ProveedorSeeder::class,
        ]);
    }
}
