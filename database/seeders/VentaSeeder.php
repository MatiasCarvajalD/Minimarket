<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    public function run()
    {
        DB::table('ventas')->insert([
            [
                'rut_usuario' => 12345678, // Valor existente en la tabla usuarios
                'tipo_entrega' => 1,
                'entrega_completada' => 0,
                'fecha' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rut_usuario' => 87654321, // Otro usuario existente
                'tipo_entrega' => 2,
                'entrega_completada' => 1,
                'fecha' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
