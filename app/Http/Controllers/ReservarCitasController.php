<?php

namespace App\Http\Controllers;

use App\Models\ReservarCitas;
use App\Models\tiposervicios;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservarCitasController extends Controller
{
    public function create()
    {
        $tiposervicios = tiposervicios::all();

        return view('ReservarCitas.create', compact('tiposervicios'));
    }

    public function store(Request $request){
        $rules = [
            'scheduled_date'=> 'required',
            'type'=> 'required',
            'description' => 'required',
            'funcionario_id' =>'exists:users,id',
            'tiposervicio_id' => 'exists:tiposervicios,id'
        ];

        $messages=[
            'scheduled_date.required' => 'Debe seleccionar una hora valida para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required'=> 'Debe ingresar los síntomas de su mascota.'
        ];
        $this->validate($request, $rules, $messages);

        $data = $request->only([
            'scheduled_date',
            'sheduled_time',
            'type',
            'description',
            'funcionario_id',
            'tiposervicio_id'
        ]);
        $data['paciente_id']  = auth()->id();

        $carbonTime = Carbon::createFromFormat('H:i', $data['sheduled_time']);
        $data['sheduled_time'] = $carbonTime->format('H:i:s');

        ReservarCitas::create($data);

        $notification = 'La cita se ha realizado correctamente.';
        return back()->with(compact('notification'));
    } 
}
