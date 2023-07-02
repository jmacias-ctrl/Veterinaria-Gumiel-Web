<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\fichas_medicas;
use App\Models\insumos_medicos;

class usa extends Model
{
    use HasFactory;

    protected $table = 'usas';
    protected $fillable = ['id_ficha_medica', 'id_insumo_medico'];

    public function fichaMedica()
    {
        return $this->belongsTo(fichas_medicas::class, 'id_ficha_medica');
    }

    public function medicamentoVacuna()
    {
        return $this->belongsTo(insumos_medicos::class, 'id_insumo_medico');
    }
}
