<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosVacunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos_vacunas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique()->nullable();
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_tipo');
            $table->unsignedBigInteger('medicamentos_enfocados');
            $table->integer('mililitros')->nullable();
            $table->integer('gramos')->nullable();
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('id_marca')->references('id')->on('marca_medicamentos_vacunas')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('id_tipo')->references('id')->on('tipo_medicamentos_vacunas')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('medicamentos_enfocados')->references('id')->on('especies')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos_vacunas');
    }
}
