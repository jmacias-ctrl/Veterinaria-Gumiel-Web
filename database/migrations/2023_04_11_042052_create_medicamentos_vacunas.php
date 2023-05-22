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
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_tipo');
            $table->enum('medicamentos_enfocados', ['perros','gatos']);
            $table->integer('mililitros')->nullable();
            $table->integer('gramos')->nullable();
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('id_marca')->references('id')->on('marca_medicamentos_vacunas');
            $table->foreign('id_tipo')->references('id')->on('tipo_medicamentos_vacunas');
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
