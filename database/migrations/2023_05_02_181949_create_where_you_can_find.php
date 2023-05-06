<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhereYouCanFind extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whereYouCanFind', function (Blueprint $table) {
            $table->id();

            $table->string('direccion');
            $table->string('telefono');
            $table->string('horarios');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('whatsapp');
            
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
        Schema::dropIfExists('whereYouCanFind');
    }
}
