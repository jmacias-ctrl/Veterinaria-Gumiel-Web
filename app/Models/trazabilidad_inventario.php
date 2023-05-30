<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trazabilidad_inventario extends Model
{
    use HasFactory;
    public function productos_ventas(){
        return $this->belongsTo('App\Models\productos_ventas','id_producto','id');
    }
    public function insumos_medicos(){
        return $this->belongsTo('App\Models\insumos_medicos','id_insumo','id');
    }
    public function medicamentos_vacunas(){
        return $this->belongsTo('App\Models\medicamentos_vacunas','id_medicina','id');
    }
    public function proveedores(){
        return $this->belongsTo('App\Models\proveedores','id_proveedor','id');
    }
}
