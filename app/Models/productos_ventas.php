<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos_ventas extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre','marca','descripcion',	'tipo','stock','producto_enfocado','precio','imagen_path'];
    public function MarcaProductos(){
        return $this->belongsTo('App\Models\Marcaproducto','id_marca','id');
    }
}
