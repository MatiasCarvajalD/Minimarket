<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCompraTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->unsignedBigInteger('cod_compra');
            $table->unsignedBigInteger('cod_producto');
            $table->unsignedSmallInteger('cantidad');
            $table->integer('valor_unitario');
            $table->timestamps();

            $table->foreign('cod_compra')->references('cod_compra')->on('compra')->onDelete('cascade');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_compra');
    }
};
