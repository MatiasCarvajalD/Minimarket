<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCompraTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->id('id_detalle'); // Clave primaria autoincremental
            $table->unsignedBigInteger('cod_compra'); // Clave foránea a compra
            $table->unsignedBigInteger('cod_producto'); // Clave foránea a productos
            $table->integer('cantidad'); // Cantidad de productos comprados
            $table->decimal('valor_unitario', 10, 2); // Precio unitario del producto
            $table->decimal('subtotal', 10, 2); // Subtotal calculado (cantidad * valor_unitario)
            $table->text('descripcion')->nullable(); // Detalle adicional del producto
            $table->timestamps();

            // Claves foráneas
            $table->foreign('cod_compra')->references('cod_compra')->on('compra')->onDelete('cascade');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_compra');
    }
}
