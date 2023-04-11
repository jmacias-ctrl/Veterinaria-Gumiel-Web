<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadVpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidad_vps', function (Blueprint $table) {
            $table->id();
            $table->integer('trabajador_rut');
            $table->time('horario_desde');
            $table->time('horario_hasta');
            $table->timestamps();

            $table->foreign('trabajador_rut')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disponibilidad_vps');
    }
}
