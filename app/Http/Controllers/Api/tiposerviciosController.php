<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tiposervicios;
use App\Models\servicios;
use App\Models\User;
use Illuminate\Http\Request;

class tiposerviciosController extends Controller
{
    public function obtenerUsuarios(Request $request)
{
    $users = User::where('tiposervicio_id', $request->tiposervicio_id)->get();
    return $users;
}
}
