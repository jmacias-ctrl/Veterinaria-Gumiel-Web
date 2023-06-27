<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservarCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservar_citas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('scheduled_date');
            $table->time('sheduled_time');
            $table->string('type');
            $table->string('description');
            $table->boolean('pagado')->default(0);
            //funcionario
            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('funcionario_id')->references('id')->on('users')->onDelete('cascade');

            //paciente
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('users')->onDelete('cascade');
            
            //tiposervicio
            $table->unsignedBigInteger('tiposervicio_id');
            $table->foreign('tiposervicio_id')->references('id')->on('tiposervicios')->onDelete('cascade');

            //tiposervicio
            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_servicio')->references('id')->on('servicios')->onDelete('cascade');

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
        Schema::dropIfExists('reservar_citas');
    }
}
