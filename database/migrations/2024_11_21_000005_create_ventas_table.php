<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            $table->bigInteger('rut_usuario');
            $table->unsignedTinyInteger('tipo_entrega');
            $table->boolean('entrega_completada');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('rut_usuario')->references('rut_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
