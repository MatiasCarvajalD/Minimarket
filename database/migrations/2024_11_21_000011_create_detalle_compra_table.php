<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCompraTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->unsignedBigInteger('cod_compra'); // FK
            $table->unsignedBigInteger('cod_producto'); // FK
            $table->unsignedSmallInteger('cantidad');
            $table->integer('valor_unitario');
            $table->primary(['cod_compra', 'cod_producto']); // Clave primaria compuesta
            $table->foreign('cod_compra')->references('cod_compra')->on('compra')->cascadeOnDelete();
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_compra');
    }
}
