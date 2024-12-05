<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentaTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->unsignedBigInteger('id_venta'); // FK
            $table->unsignedBigInteger('cod_producto'); // FK
            $table->unsignedTinyInteger('cantidad');
            $table->integer('valor_unidad');
            $table->timestamps();
            $table->primary(['id_venta', 'cod_producto']); // Clave primaria compuesta
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->cascadeOnDelete();
            $table->foreign('cod_producto')->references('cod_producto')->on('productos')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_venta');
    }
}
