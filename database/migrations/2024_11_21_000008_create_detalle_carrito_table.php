<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCarritoTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_carrito', function (Blueprint $table) {
            $table->unsignedBigInteger('id_carrito'); // FK
            $table->unsignedBigInteger('cod_producto'); // FK
            $table->unsignedTinyInteger('cantidad');
            $table->primary(['id_carrito', 'cod_producto']); // Clave primaria compuesta
            $table->foreign('id_carrito')->references('id_carrito')->on('carrito')->cascadeOnDelete();
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_carrito');
    }
}
