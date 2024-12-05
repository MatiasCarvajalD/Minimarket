<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta'); // Clave primaria
            $table->unsignedBigInteger('rut_usuario'); // FK
            $table->string('tipo_entrega');
            $table->string('metodo_pago');
            $table->boolean('entrega_completada')->default(false);
            $table->date('fecha')->default(now());
            $table->timestamps(); // Incluye created_at y updated_at
            $table->foreign('rut_usuario')->references('rut_usuario')->on('usuarios')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
