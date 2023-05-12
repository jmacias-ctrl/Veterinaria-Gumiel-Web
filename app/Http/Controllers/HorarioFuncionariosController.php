<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HorarioFuncionarios;
use Carbon\Carbon;

class HorarioFuncionariosController extends Controller
{
    private $days = [
        'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'
    ];
    
    public function edit(){
        

        $horarios = HorarioFuncionarios::where('user_id', auth()->id())->get();

        if(count($horarios) > 0){
                $horarios->map(function($horarios){
                $horarios->morning_start = (new Carbon($horarios->morning_start))->format('H:i');
                $horarios->morning_end = (new Carbon($horarios->morning_end))->format('H:i');
                $horarios->afternoon_start = (new Carbon($horarios->afternoon_start))->format('H:i');
                $horarios->afternoon_end = (new Carbon($horarios->afternoon_end))->format('H:i');
            });
        }else {
            $horarios = collect();
            for ($i=0; $i<7; ++$i)
                $horarios->push(new HorarioFuncionarios());
        }

        

        $days = $this->days;

        //dd($horarios);
        //dd($horarios->toArray());

        return view('admin.HorarioFuncionarios' ,compact('days', 'horarios'));
    }

    public function store(Request $request){

        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];

        for($i=0; $i<7;++$i){
            if($morning_start[$i] > $morning_end[$i]){
                $errors [] ='Inconsistencia en el intervalo de las horas del turno de la mañana del día : '. $this->days[$i] .'.';
            }
            if($afternoon_start[$i] > $afternoon_end[$i]){
                $errors [] ='Inconsistencia en el intervalo de las horas del turno de la tarde del día : '. $this->days[$i] .'.';
            }

            
            HorarioFuncionarios::updateOrCreate(
                [
                    'day'=>$i,
                    'user_id' => auth()->id()
                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start'=> $morning_start[$i],
                    'morning_end'=> $morning_end[$i],
                    'afternoon_start'=> $afternoon_start[$i],
                    'afternoon_end'=> $afternoon_end[$i],
                ],
            );
        }
        if(count($errors) > 0)
            return back()->with(compact('errors'));
        
        $notification = 'Los cambiosse han guardado correctamente.';
        return back()->with(compact('notification'));
    }   
}
   
