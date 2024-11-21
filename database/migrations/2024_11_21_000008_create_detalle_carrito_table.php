<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCarritoTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_carrito', function (Blueprint $table) {
            $table->unsignedBigInteger('id_carrito');
            $table->unsignedBigInteger('cod_producto');
            $table->unsignedTinyInteger('cantidad');
            $table->timestamps();

            $table->foreign('id_carrito')->references('id_carrito')->on('carrito')->onDelete('cascade');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_carrito');
    }
};
