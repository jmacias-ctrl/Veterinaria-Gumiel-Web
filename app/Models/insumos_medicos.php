<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insumos_medicos extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'id_marca',
        'id_tipo',
        'stock',
        'created_at',
        'updated_at'
    ];

    use HasFactory;
    public function Tipoinsumos(){
        return $this->belongsTo('App\Models\Tipoinsumos','id_tipo','id');
    }
    public function marcaInsumos(){
        return $this->belongsTo('App\Models\MarcaInsumo','id_marca','id');
    }
}
