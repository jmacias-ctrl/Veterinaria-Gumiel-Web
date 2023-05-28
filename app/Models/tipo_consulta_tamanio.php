<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_consulta_tamanio extends Model
{
    use HasFactory;
    protected $table = "tipo_consulta_tamanios";
    protected $fillable = ['nombre','duracion'];

    public function tiposervicios(){
        return $this->belongsTo('App\Models\tiposervicios','tiposervicio_id','id');
    }

    public function ReservarCitas()
    {
        return $this->hasMany(ReservarCitas::class);
    }

    public function tiposervicio()
    {
        return $this->belongsTo(tiposervicios::class, 'tiposervicio_id');
    }
}
