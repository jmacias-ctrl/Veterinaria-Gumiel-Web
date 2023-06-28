<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Especie;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_cliente',
        'nombre',
        'especie',
        'sexo',
        'fecha_nacimiento',
        'created_at',
        'updated_at'
    ];
    
    public function GetEspecie()
    {
        return $this->belongsTo(Especie::class, 'id_especie', 'id');
    }
}
