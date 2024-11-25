<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('rut_usuario')->primary();
            $table->string('nombre_usuario', 30);
            $table->string('password', 60);
            $table->string('correo', 30)->unique();
            $table->string('telefono', 12)->nullable();
            $table->string('direccion', 30)->nullable();
            $table->string('rol')->default('user');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
