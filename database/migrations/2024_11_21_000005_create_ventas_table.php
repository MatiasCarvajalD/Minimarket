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
            $table->unsignedTinyInteger('tipo_entrega');
            $table->boolean('entrega_completada');
            $table->date('fecha');
            $table->timestamps(); // Incluye created_at y updated_at
            $table->foreign('rut_usuario')->references('rut_usuario')->on('usuarios')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
