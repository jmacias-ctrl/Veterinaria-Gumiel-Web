<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhereYouCanFind extends Model
{
    protected $table = 'whereYouCanFind';

    use HasFactory;
    protected $fillable = [
        'id',
        'direccion', 
        'telefono', 
        'horarios', 
        'instagram', 
        'facebook', 
        'whatsapp'
    ];
}
