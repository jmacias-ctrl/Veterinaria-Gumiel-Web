<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    static $rules=[
        'id_usuario'=>'required',
        'dia'=>'required',
        'start'=>'required',
        'end'=>'required',
    ];

    protected $table = "horarios";
    protected $fillable = ['id_usuario','dia','start','end'];
}
