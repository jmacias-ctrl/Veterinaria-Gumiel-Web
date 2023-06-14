<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPageIniciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_inicios', function (Blueprint $table) {
            $table->id();
            $table->string('logo_1')->nullable();
            $table->string('logo_2')->nullable();
            $table->string('titulo_bienvenida');
            $table->string('agenda_hora_titulo');
            $table->text('agenda_hora_texto');
            $table->string('agenda_hora_imagen')->nullable();
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
        Schema::dropIfExists('landing_page_inicios');
    }
}
