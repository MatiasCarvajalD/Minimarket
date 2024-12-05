<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('cod_producto'); // Clave primaria
            $table->string('nom_producto', 50);
            $table->string('marca', 30);
            $table->string('descripcion', 255);
            $table->integer('precio')->unsigned();
            $table->unsignedBigInteger('id_categoria'); // FK
            $table->unsignedSmallInteger('stock_actual');
            $table->unsignedTinyInteger('stock_critico');
            $table->string('imagen')->nullable(); 
            $table->foreign('id_categoria')->references('id_categoria')->on('tipo_producto')->cascadeOnDelete();
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
