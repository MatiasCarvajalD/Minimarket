<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'rut_usuario' => '99999999',
            'nombre_usuario' => 'Invitado',
            'correo' => 'invitado@example.com',
            'password' => bcrypt('password'),
            'rol' => 'invitado',
        ]);
        
    }
}
