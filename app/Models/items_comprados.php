<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items_comprados extends Model
{
    use HasFactory;
    protected $table = "items_comprados";
    public function servicios(){
        return $this->belongsTo('App\Models\servicios','id_servicio','id');
    }
    public function productos_ventas(){
        return $this->belongsTo('App\Models\productos_ventas','id_producto','id');
    }
}
