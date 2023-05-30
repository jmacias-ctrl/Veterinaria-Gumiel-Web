<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrazabilidadInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trazabilidad_inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->unsignedBigInteger('id_medicina')->nullable();
            $table->unsignedBigInteger('id_insumo')->nullable();
            $table->enum('accion', ['agregar', 'restar']);
            $table->enum('tipo_item', ['insumo', 'producto', 'medicina']);
            $table->integer('stock')->nullable();
            $table->integer('costo')->nullable();
            $table->unsignedBigInteger('id_proveedor')->nullable();
            $table->string('factura')->nullable();
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('productos_ventas');
            $table->foreign('id_insumo')->references('id')->on('insumos_medicos');
            $table->foreign('id_medicina')->references('id')->on('medicamentos_vacunas');
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trazabilidad_inventarios');
    }
}
