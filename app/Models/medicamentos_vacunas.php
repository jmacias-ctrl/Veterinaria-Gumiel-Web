<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicamentos_vacunas extends Model
{
    use HasFactory;

    public function tipo_medicamentos_vacunas(){
        return $this->belongsTo('App\Models\TipoMedicamento','id_tipo','id');
    }
    public function marca_medicamentos_vacunas(){
        return $this->belongsTo('App\Models\marca_medicamentos_vacunas','id_marca','id');
    }
}
