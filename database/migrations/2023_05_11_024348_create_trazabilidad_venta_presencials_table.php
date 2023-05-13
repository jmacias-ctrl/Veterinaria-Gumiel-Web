<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrazabilidadVentaPresencialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trazabilidad_venta_presencials', function (Blueprint $table) {
            $table->id();
            $table->string('id_venta');
            $table->string('nombre_cliente');
            $table->unsignedBigInteger('id_operador');
            $table->timestamps();
            
            $table->foreign('id_operador')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trazabilidad_venta_presencials');
    }
}
