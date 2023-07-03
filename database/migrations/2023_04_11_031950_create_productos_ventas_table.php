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
            $table->unsignedBigInteger('id_marca')->nullable();
            $table->text('descripcion');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('id_tipo')->nullable();
            $table->integer('stock');
            $table->integer('min_stock')->nullable();
            $table->unsignedBigInteger('producto_enfocado')->nullable();
            $table->integer('precio');
            $table->string('imagen_path');
            $table->timestamps();

            $table->foreign('id_marca')->references('id')->on('marcaproductos')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('producto_enfocado')->references('id')->on('especies')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('id_tipo')->references('id')->on('tipoproductos_ventas')->onDelete('SET NULL')->onUpdate('CASCADE');
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
