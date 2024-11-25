<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'rut_usuario' => 12345678,
                'nombre_usuario' => 'Admin',
                'contraseña_usuario' => bcrypt('password123'),
                'correo' => 'admin@example.com',
                'telefono' => '987654321',
                'direccion' => 'Calle Principal 123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rut_usuario' => 87654321,
                'nombre_usuario' => 'Usuario1',
                'contraseña_usuario' => bcrypt('password456'),
                'correo' => 'usuario1@example.com',
                'telefono' => '987654322',
                'direccion' => 'Calle Secundaria 456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

