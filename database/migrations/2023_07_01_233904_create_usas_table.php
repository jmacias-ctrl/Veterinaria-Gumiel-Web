<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ficha_medica');
            $table->unsignedBigInteger('id_insumo_medico');
            $table->timestamps();

            $table->foreign('id_ficha_medica')->references('id')->on('fichas_medicas');
            $table->foreign('id_insumo_medico')->references('id')->on('insumos_medicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usas');
    }
}
