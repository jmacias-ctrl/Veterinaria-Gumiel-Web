<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoproductos_ventas extends Model
{
    use HasFactory;
    protected $table = "tipoproductos_ventas";
    protected $fillable = ['nombre'];
}
