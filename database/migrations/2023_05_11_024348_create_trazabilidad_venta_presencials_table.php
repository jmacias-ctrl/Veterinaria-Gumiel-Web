<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrazabilidadVentaPresencialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trazabilidad_venta_presencials', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->enum('metodo_pago', ['efectivo', 'transferencia', 'tarjeta']);
            $table->integer('monto');
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('productos_ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trazabilidad_venta_presencials');
    }
}
