<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorTable extends Migration
{
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('id_proveedor'); // Clave primaria
            $table->unsignedBigInteger('rut_proveedor')->unique(); // Rut único
            $table->string('nom_proveedor', 50);
            $table->string('telefono_proveedor', 20)->nullable();
            $table->string('direccion_proveedor', 100)->nullable();
            $table->string('correo_proveedor', 50)->nullable();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
};
