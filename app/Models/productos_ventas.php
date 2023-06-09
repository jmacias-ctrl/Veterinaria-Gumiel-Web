<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos_ventas extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre','marca','descripcion',	'tipo','stock','producto_enfocado','precio','subcategoria','imagen_path'];
    public function MarcaProductos(){
        return $this->belongsTo('App\Models\Marcaproducto','id_marca','id');
    }
    public function tipoproductos_ventas(){
        return $this->belongsTo('App\Models\tipoproductos_ventas','id_tipo','id');
    }
    public function especies(){
        return $this->belongsTo('App\Models\Especie','producto_enfocado','id');
    }
}
