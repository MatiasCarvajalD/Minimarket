<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('cod_producto');
            $table->string('nom_producto', 15);
            $table->string('marca', 15)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->integer('precio');
            $table->unsignedTinyInteger('id_categoria');
            $table->unsignedInteger('stock_actual');
            $table->unsignedTinyInteger('stock_critico');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id_categoria')->on('tipo_producto')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
