<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    protected $table = "horarios";
    protected $fillable = ['title', 'id_usuario','start','end'];
}
