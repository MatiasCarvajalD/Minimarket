<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('rut_usuario'); // Clave primaria
            $table->string('password', 255); // Columna de contraseña
            $table->string('nombre_usuario', 30);
            $table->bigInteger('telefono')->nullable();;
            $table->string('email', 30)->unique();
            $table->enum('rol', ['admin', 'usuario', 'invitado']);
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
