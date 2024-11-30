<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id('cod_compra'); // Clave primaria
            $table->unsignedBigInteger('rut_proveedor'); // FK
            $table->date('fecha');
            $table->timestamps(); // Incluye created_at y updated_at
            $table->foreign('rut_proveedor')->references('rut_proveedor')->on('proveedor')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
