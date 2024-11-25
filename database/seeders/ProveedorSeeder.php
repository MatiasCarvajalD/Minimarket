<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('proveedor')->insert([
            [
                'rut_proveedor' => 123456789,
                'nom_proveedor' => 'Distribuidora Central',
                'telefono_proveedor' => '987654321',
                'direccion_proveedor' => 'Calle Principal 123',
                'correo_proveedor' => 'contacto@central.cl',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rut_proveedor' => 987654321,
                'nom_proveedor' => 'Proveedora Norte',
                'telefono_proveedor' => '123456789',
                'direccion_proveedor' => 'Avenida Norte 456',
                'correo_proveedor' => 'ventas@norte.cl',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

