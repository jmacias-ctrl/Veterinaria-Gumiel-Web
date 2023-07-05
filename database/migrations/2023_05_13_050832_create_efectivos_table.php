<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEfectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efectivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_operacion');
            $table->integer('efectivo');
            $table->integer('vuelto');
            $table->timestamps();

            $table->foreign('id_operacion')->references('id')->on('trazabilidad_venta_presencials')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('efectivos');
    }
}
