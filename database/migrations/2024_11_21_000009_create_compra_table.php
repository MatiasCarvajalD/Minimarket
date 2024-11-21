<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id('cod_compra');
            $table->bigInteger('rut_proveedor');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('rut_proveedor')->references('rut_proveedor')->on('proveedor')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('compra');
    }
};
