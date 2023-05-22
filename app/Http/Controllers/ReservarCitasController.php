<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Models\ReservarCitas;
use App\Models\tiposervicios;
use App\Services\HorarioFuncionarioService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservarCitasController extends Controller
{
    public function index(){
        $confirmedCita = ReservarCitas::
            where('status','Confirmada')->
            where('paciente_id', auth()->id())->get();

        $pendingCita = ReservarCitas::all()
            ->where('status','Reservada')
            ->where('paciente_id', auth()->id());

        $oldCita = ReservarCitas::all()
            ->whereIn('status', ['Atendida', 'Cancelada'])
            ->where('paciente_id', auth()->id());
        
        return view('ReservarCitas.index',compact('confirmedCita','pendingCita','oldCita'));
    }

    public function create(HorarioFuncionarioServiceInterface $horarioFuncionarioServiceInterface)
    {
        $tiposervicios = tiposervicios::all();

        $tiposervicioId = old('tiposervicio_id');
        if($tiposervicioId){
            $tiposervicio = tiposervicios::find($tiposervicioId);
            $funcionarios = $tiposervicio->users;
        }else{
            $funcionarios = collect();
        }

        $date = old('scheduled_date');
        $funcionarioId = old('funcionario_id');

        if($date && $funcionarioId){
            $intervals = $horarioFuncionarioServiceInterface->getAvailableIntervals($date, $funcionarioId);
        }else{
            $intervals = null;
        }

        return view('ReservarCitas.create', compact('tiposervicios','funcionarios', 'intervals'));
    }

    public function store(Request $request, HorarioFuncionarioServiceInterface $horarioFuncionarioServiceInterface){
        $rules = [
            'sheduled_time'=> 'required',
            'type'=> 'required',
            'description' => 'required',
            'funcionario_id' =>'exists:users,id',
            'tiposervicio_id' => 'exists:tiposervicios,id'
        ];

        $messages=[
            'sheduled_time.required' => 'Debe seleccionar una hora valida para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required'=> 'Debe ingresar los síntomas de su mascota.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $horarioFuncionarioServiceInterface){

            $date = $request-> input('scheduled_date');
            $funcionarioId = $request->input('funcionario_id');
            $sheduled_time = $request->input('sheduled_time');
            if($date &&  $funcionarioId && $sheduled_time){
                $start = new Carbon($sheduled_time);
            }else{
                return;
            }

            if (!$horarioFuncionarioServiceInterface->isAvailableInterval($date, $funcionarioId, $start)) {
                $validator->errors()->add(
                    'available', 'La hora seleccionada ya se encuentra reservada por otro paciente'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

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
