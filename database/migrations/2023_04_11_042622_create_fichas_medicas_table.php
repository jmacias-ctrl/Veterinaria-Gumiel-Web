<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_medicas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_mascota');
            $table->integer('id_hora_reservada');
            $table->integer('peso_mascota');
            $table->integer('edad');
            $table->text('observacion');
            $table->text('procedimiento');

            $table->foreign('id_hora_reservada')->references('id')->on('agenda_veterinarias');
            $table->foreign('id_mascota')->references('id')->on('mascotas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas_medicas');
    }
}
