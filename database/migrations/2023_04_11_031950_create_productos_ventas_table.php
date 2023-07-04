<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique()->nullable();
            $table->BigInteger('id_marca')->unsigned();
            $table->text('descripcion');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('id_tipo');
            $table->integer('stock');
            $table->integer('min_stock')->nullable();
            $table->unsignedBigInteger('producto_enfocado');
            $table->integer('precio');
            $table->string('imagen_path');
            $table->string('subcategoria')->nullable();
            $table->timestamps();

            $table->foreign('id_marca')->references('id')->on('marcaproductos');
            $table->foreign('producto_enfocado')->references('id')->on('especies');
            $table->foreign('id_tipo')->references('id')->on('tipoproductos_ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_ventas');
    }
}
