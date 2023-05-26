<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsCompradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_comprados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->unsignedBigInteger('id_reserva')->nullable();
            $table->unsignedBigInteger('id_venta');
            $table->enum('tipo_item', ['producto', 'servicio']);
            $table->integer('monto');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('productos_ventas');
            $table->foreign('id_reserva')->references('id')->on('reservar_citas');
            $table->foreign('id_venta')->references('id')->on('trazabilidad_venta_presencials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_comprados');
    }
}
