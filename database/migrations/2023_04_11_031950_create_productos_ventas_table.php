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
            $table->unsignedBigInteger('id_marca');
            $table->text('descripcion');
            $table->string('slug')->nullable();
            $table->enum('tipo', ['alimento', 'accesorio']);
            $table->integer('stock');
            $table->integer('min_stock')->nullable();
            $table->enum('producto_enfocado', ['gato', 'perro', 'ambos']);
            $table->integer('precio');
            $table->string('imagen_path');
            $table->timestamps();

            $table->foreign('id_marca')->references('id')->on('marcaproductos');
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
