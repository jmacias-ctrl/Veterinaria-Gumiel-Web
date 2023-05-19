<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HorarioFuncionarios;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function hours(Request $request){

        $this->validate($request, $rules);

        $date = $request->input('date');
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 :$i-1);
        $funcionarioId = $request->input('funcionario_id');

        $horario = HorarioFuncionarios::where('active',true)
         ->where('day', $day)
         ->where('user_id',$funcionarioId)
    }
}
