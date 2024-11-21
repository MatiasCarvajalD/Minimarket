<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjusteTable extends Migration
{
    public function up()
    {
        Schema::create('ajuste', function (Blueprint $table) {
            $table->id('id_ajuste');
            $table->unsignedBigInteger('cod_producto');
            $table->unsignedTinyInteger('cantidad');
            $table->timestamps();

            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ajuste');
    }
};
