<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaPeluqueriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_peluquerias', function (Blueprint $table) {
            $table->id();
            $table->integer('rut_peluquero');
            $table->integer('id_mascota');
            $table->integer('rut_cliente');
            $table->date('fecha_cita_inicio');
            $table->date('fecha_cita_termino');
            $table->timestamps();

            $table->foreign('rut_veterinario')->references('id')->on('users');
            $table->foreign('rut_cliente')->references('id')->on('users');
            $table->foreign('id_mascota')->references('id')->on('mascotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda_peluquerias');
    }
}
