<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaVeterinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_veterinarias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_veterinario');
            $table->unsignedBigInteger('id_mascota');
            $table->unsignedBigInteger('id_cliente');
            $table->date('fecha_cita_inicio');
            $table->date('fecha_cita_termino');
            $table->unsignedBigInteger('id_tipo_consulta');
            $table->timestamps();

            $table->foreign('id_veterinario')->references('id')->on('users');
            $table->foreign('id_cliente')->references('id')->on('users');
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
        Schema::dropIfExists('agenda_veterinarias');
    }
}