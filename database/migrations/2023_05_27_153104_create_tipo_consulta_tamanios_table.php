<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoConsultaTamaniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_consulta_tamanios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('duracion');
            $table->integer('precio');
            $table->unsignedBigInteger('tiposervicio_id');
            $table->foreign('tiposervicio_id')->references('id')->on('tiposervicios')->onDelete('cascade');


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
        Schema::dropIfExists('tipo_consulta_tamanios');
    }
}
