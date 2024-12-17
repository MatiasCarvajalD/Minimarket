<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjusteTable extends Migration
{
    public function up()
    {
        Schema::create('ajuste', function (Blueprint $table) {
            $table->id('id_ajuste'); // Clave primaria
            $table->unsignedBigInteger('cod_producto'); // Clave foránea
            $table->unsignedTinyInteger('cantidad');
            $table->date('fecha');
            $table->string('tipo_ajuste', 50);
            $table->string('descripcion', 255)->nullable();
            $table->timestamps();
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->cascadeOnDelete();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('ajuste');
    }
}
