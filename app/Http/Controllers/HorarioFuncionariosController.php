<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HorarioFuncionariosController extends Controller
{
    public function edit(){
        $days = [
            'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'
        ];
        return view('admin.HorarioFuncionarios' ,compact('days'));
    }
}
