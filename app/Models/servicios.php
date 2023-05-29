<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre','precio','tipo','opciones'];
    protected $table = "servicios";
    public function tiposervicios(){
        return $this->belongsTo('App\Models\tiposervicios','tiposervicio_id','id');
    }
}
