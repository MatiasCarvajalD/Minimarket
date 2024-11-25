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
            $table->bigInteger('rut_proveedor')->unique(); // Nuevo campo agregado
            $table->string('nom_proveedor', 50); // Nombre del proveedor
            $table->string('telefono_proveedor', 20)->nullable(); // Teléfono opcional
            $table->string('direccion_proveedor', 100)->nullable(); // Dirección opcional
            $table->string('correo_proveedor', 50)->nullable(); // Correo opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
};
