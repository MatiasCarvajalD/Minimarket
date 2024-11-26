<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesCheckoutTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_checkout', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->unsignedBigInteger('id_venta'); 
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            $table->string('direccion')->nullable(); // Dirección de entrega
            $table->string('metodo_pago')->nullable(); // Método de pago (tarjeta, efectivo, etc.)
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_checkout');
    }
}
