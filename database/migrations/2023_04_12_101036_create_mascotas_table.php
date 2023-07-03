<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_especie');

            $table->string('nombre');
            // $table->string('especie'); // debe ser un id a la tabla especies
            $table->enum('sexo',['macho','hembra']);
            $table->date('fecha_nacimiento');
            $table->timestamps();

            $table->foreign('id_especie')->references('id')->on('especies')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
