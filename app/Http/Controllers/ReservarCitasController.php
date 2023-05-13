<?php

namespace App\Http\Controllers;

use App\Models\tiposervicios;
use Illuminate\Http\Request;

class ReservarCitasController extends Controller
{
    public function create()
{
    $servicios = tiposervicios::all();

    return view('ReservarCitas.create', compact('servicios'));
}
}
