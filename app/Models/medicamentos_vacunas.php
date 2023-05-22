<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicamentos_vacunas extends Model
{
    use HasFactory;

    public function Tipomedicamentos_vacunas(){
        return $this->belongsTo('App\Models\Tipomedicamentos_vacunas','id_tipo','id');
    }
    public function marcamedicamentos_vacunas(){
        return $this->belongsTo('App\Models\Marcamedicamentos_vacunas','id_marca','id');
    }
}
