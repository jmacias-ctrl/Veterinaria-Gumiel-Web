<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMedicamento extends Model
{
    use HasFactory;
    protected $table = "tipo_medicamentos_vacunas";
    protected $fillable = ['nombre'];
  }