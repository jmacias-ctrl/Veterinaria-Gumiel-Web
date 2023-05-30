<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos_medicos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique()->nullable();
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_tipo');
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('id_tipo')->references('id')->on('tipoinsumos');
            $table->foreign('id_marca')->references('id')->on('marca_insumos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos_medicos');
    }
}
