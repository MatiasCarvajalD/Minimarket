<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProductoTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_producto', function (Blueprint $table) {
            $table->id('id_categoria'); // Clave primaria
            $table->string('categoria', 15); // Nombre de la categoría
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_producto');
    }
}
