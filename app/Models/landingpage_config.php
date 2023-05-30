<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landingpage_config extends Model
{
    use HasFactory;

    protected $table = 'landingpage_configs';

    use HasFactory;
    protected $fillable = [
        'id',
        'aboutUs',
    ];

    public $rules = [
        'aboutUs' => 'required|string'
    ];

    public $attributes = [
        'aboutUs' => 'AboutUs'
    ];

    public $message = [
        'required' => ':attribute es obligatorio.',
        'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
        'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
        'max' => ':attribute invalido, debe ser máximo :max',
        'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
        'confirmed' => ':attribute no coinciden',
    ];
}
