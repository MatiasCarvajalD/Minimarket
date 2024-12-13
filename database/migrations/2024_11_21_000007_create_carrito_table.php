<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('id_carrito');
            $table->string('rut_usuario'); // Clave foránea hacia usuarios
            $table->unsignedBigInteger('cod_producto'); // Clave foránea hacia productos
            $table->integer('cantidad');
            $table->timestamps();
        
            $table->foreign('rut_usuario')->references('rut_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('carrito');
    }
};
