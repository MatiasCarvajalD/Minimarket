<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorTable extends Migration
{
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->bigInteger('rut_proveedor')->primary();
            $table->string('nom_proveedor', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
};
