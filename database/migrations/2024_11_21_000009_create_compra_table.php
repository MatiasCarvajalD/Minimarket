<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id('cod_compra'); // Clave primaria autoincremental
            $table->unsignedBigInteger('rut_proveedor'); // Clave foránea a proveedor
            $table->date('fecha'); // Fecha de la compra
            $table->text('descripcion')->nullable(); // Descripción adicional
            $table->text('detalle_general')->nullable(); // Detalle global de la compra
            $table->timestamps();

            // Clave foránea a proveedor
            $table->foreign('rut_proveedor')->references('rut_proveedor')->on('proveedor')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
