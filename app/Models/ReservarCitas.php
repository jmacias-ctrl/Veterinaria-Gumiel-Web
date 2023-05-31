<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservarCitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'scheduled_date',
        'sheduled_time',
        'type',
        'description',
        'funcionario_id',
        'paciente_id',
        'tiposervicio_id',
        'id_servicio'
    ];

    public function tiposervicio(){
        return $this->belongsTo(tiposervicios::class);
    }

    public function funcionario(){
        return $this->belongsTo(User::class);
    }

    public function paciente(){
        return $this->belongsTo(User::class);
    }

    public function cancellation(){
        return $this->hasOne(CancelledCitas::class);
    }
}
