<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{
    public function index()
    {
        $horario = Horario::all();
        return view('calendario.verCalendario',compact('horario'));
    }
}
