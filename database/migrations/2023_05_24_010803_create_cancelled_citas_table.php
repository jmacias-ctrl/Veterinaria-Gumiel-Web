<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelledCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelled_citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('justification')->nullable();

            $table->unsignedBigInteger('cancelled_by_id');
            $table->foreign('cancelled_by_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('reservar_citas_id');
            $table->foreign('reservar_citas_id')->references('id')->on('reservar_citas')->onDelete('cascade');

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
        Schema::dropIfExists('cancelled_citas');
    }
}
