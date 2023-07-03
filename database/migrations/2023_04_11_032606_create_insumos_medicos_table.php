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
            $table->unsignedBigInteger('id_marca')->nullable();
            $table->unsignedBigInteger('id_tipo')->nullable();
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('id_tipo')->references('id')->on('tipoinsumos')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('id_marca')->references('id')->on('marca_insumos')->onDelete('SET NULL')->onUpdate('CASCADE');
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
