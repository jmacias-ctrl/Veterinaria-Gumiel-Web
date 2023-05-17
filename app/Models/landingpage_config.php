<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageConfig extends Model
{
    protected $table = 'landingpage_config';

    use HasFactory;
    protected $fillable = [
        'id',
        'direccion', 
        'telefono', 
        'horarios', 
        'instagram', 
        'facebook', 
        'whatsapp',

        //another info
    ];
}
