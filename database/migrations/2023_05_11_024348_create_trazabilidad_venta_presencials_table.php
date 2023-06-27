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
            $table->string('id_venta');
            $table->string('nombre_cliente');
            $table->dateTime('fecha_compra')->nullable();
            $table->enum('metodo_pago', ['transferencia', 'efectivo', 'tarjeta', 'online']);
            $table->enum('estado',['pagado', 'listo para retirar', 'entregado'])->nullable();
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->unsignedBigInteger('id_operador')->nullable();    
            $table->timestamps();
            
            $table->foreign('id_operador')->references('id')->on('users');
            $table->foreign('id_cliente')->references('id')->on('users');
            
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
