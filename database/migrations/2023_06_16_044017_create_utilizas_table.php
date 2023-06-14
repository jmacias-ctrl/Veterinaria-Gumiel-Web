<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilizas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ficha_medica');
            $table->unsignedBigInteger('id_medicamento_vacuna');
            $table->timestamps();

            $table->foreign('id_ficha_medica')->references('id')->on('fichas_medicas');
            $table->foreign('id_medicamento_vacuna')->references('id')->on('medicamentos_vacunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilizas');
    }
}
