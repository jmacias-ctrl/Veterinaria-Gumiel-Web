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

    public $rules = [
        'direccion' => 'required|string',
        'telefono' => 'required|digits:9',
        'horarios' => 'required|string',
        'instagram' => 'required|string',
        'facebook' => 'required|string',
        'whatsapp' => 'required|string'
    ];

    public $attributes = [
        'direccion' => 'Direccion',
        'telefono' => 'Telefono',
        'horarios' => 'Horarios',
        'instagram' => 'Instagram',
        'facebook' => 'Facebook',
        'whatsapp' => 'Whatsapp'
    ];

    public $message = [
        'required' => ':attribute es obligatorio.',
        'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
        'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
        'max' => ':attribute invalido, debe ser máximo :max',
        'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
        'confirmed' => ':attribute no coinciden'
    ];
}
