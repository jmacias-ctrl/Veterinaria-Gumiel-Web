<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\fichas_medicas;
use App\Models\medicamentos_vacunas;

class utiliza extends Model
{
    use HasFactory;

    protected $table = 'utilizas';
    protected $fillable = ['id_ficha_medica', 'id_medicamento_vacuna'];

    // Relación con el modelo FichaMedica
    public function fichaMedica()
    {
        return $this->belongsTo(fichas_medicas::class, 'id_ficha_medica');
    }

    // Relación con el modelo MedicamentoVacuna
    public function medicamentoVacuna()
    {
        return $this->belongsTo(medicamentos_vacunas::class, 'id_medicamento_vacuna');
    }
}
