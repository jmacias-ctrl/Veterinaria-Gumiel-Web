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
        'instagram', 
        'facebook', 
        'horario_header',
        'correo',
        'whatsapp',
        'twitter',
        'nombre',

        // 'aboutUs'
    ];

    public $rules = [
        'direccion' => 'required|string',
        'telefono' => 'required|digits:9',
        'instagram' => 'string',
        'correo' => 'required|email',
        'horario_header' => 'required|string',
        'facebook' => 'string',
        'whatsapp' => 'string',
        'twitter' => 'string',
        'nombre'=> 'required|string',

        // 'aboutUs' => 'required|string'
    ];

    public $attributes = [
        'direccion' => 'Direccion',
        'telefono' => 'Telefono',
        'instagram' => 'Instagram',
        'horario_header' => 'Horario de Encabezado',
        'facebook' => 'Facebook',
        'correo' => 'Correo',
        'whatsapp' => 'Whatsapp',
        'twitter' => 'Twitter',
        'nombre' => 'nombre',

        // 'aboutUs' => 'AboutUs'
    ];

    public $message = [
        'required' => ':attribute es obligatorio.',
        'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
        'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
        'max' => ':attribute invalido, debe ser máximo :max',
        'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
        'confirmed' => ':attribute no coinciden',

        // 'aboutUs' => 'AboutUs'
    ];
}
