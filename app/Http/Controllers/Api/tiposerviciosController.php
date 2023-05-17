<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tiposervicios;
use App\Models\servicios;
use Illuminate\Http\Request;

class tiposerviciosController extends Controller
{
    public function funcionarios(tiposervicios $tiposervicio){
        return $tiposervicio->users;

    }
}
