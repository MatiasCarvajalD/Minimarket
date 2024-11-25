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
                'password' => bcrypt('password'),
                'correo' => 'admin@example.com',
                'telefono' => '987654321',
                'direccion' => 'Calle Principal 123',
                'rol' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rut_usuario' => 87654321,
                'nombre_usuario' => 'Usuario1',
                'password' => bcrypt('password'),
                'correo' => 'usuario1@example.com',
                'telefono' => '987654322',
                'direccion' => 'Calle Secundaria 456',
                'rol' => 'guest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

