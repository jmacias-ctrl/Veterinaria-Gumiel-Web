<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposervicioUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiposervicio_user', function (Blueprint $table) {
            $table->id();
            
            //funcionario
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
 
            //tiposervicio
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
        Schema::dropIfExists('tiposervicio_user');
    }
}
