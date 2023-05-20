<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HorarioFuncionarios;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function hours(Request $request){
        $rules=[
            'date' => 'required|date_format:"Y-m-d"',
            'funcionario_id'=>'required|exists:users,id'
        ];
        $this->validate($request, $rules);

        $date = $request->input('date');
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 :$i-1);
        $funcionarioId = $request->input('funcionario_id');

        $horario = HorarioFuncionarios::where('active',true)
         ->where('day', $day)
         ->where('user_id',$funcionarioId)
         ->first([
            'morning_start','morning_end',
            'afternoon_start','afternoon_end'
         ]);
        if(!$horario){
            return [];
        }

        $morningIntervalos = $this->getIntervalos(
            $horario->morning_start,$horario->morning_end
        );

        $afternoonIntervalos = $this->getIntervalos(
            $horario->afternoon_start,$horario->afternoon_end
        );

        $data = [];
        $data['morning'] = $morningIntervalos;
        $data['afternoon'] = $afternoonIntervalos;
        return $data;
    }
    
    private function getIntervalos($start,$end){
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervalos =[];
        while($start < $end){
            $intervalo = [];
            $intervalo['start'] = $start->format('H:i') ;
            $start->addMinutes(30);
            $intervalo['end'] = $start->format('H:i') ;
            $intervalos[]=$intervalo;
        }
        return $intervalos;
    }
}
