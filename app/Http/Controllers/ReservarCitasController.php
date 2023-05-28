<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Mail\AproximacionHora;
use App\Mail\CancelarHora;
use App\Mail\CancelarHoraDespuesConfirm;
use App\Mail\ConfirmacionHora;
use App\Models\CancelledCitas;
use App\Models\ReservarCitas;
use App\Models\tipo_consulta_tamanio;
use App\Models\tiposervicios;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class ReservarCitasController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $confirmedCita = null;
        $pendingCita = null;
        $oldCita = null;
    
        if($user->hasRole('Admin')){
            // Admin
            $confirmedCita = ReservarCitas::where('status', 'Confirmada')
                ->get();
    
            $pendingCita = ReservarCitas::where('status', 'Reservada')
                ->get();
    
            $oldCita = ReservarCitas::whereIn('status', ['Atendida', 'Cancelada'])
                ->get();
    
        } elseif ($user->hasRole('Veterinario')) {
            // Veterinario
            $confirmedCita = ReservarCitas::where('status', 'Confirmada')
                ->where('funcionario_id', $user->id)
                ->get();
    
            $pendingCita = ReservarCitas::where('status', 'Reservada')
                ->where('funcionario_id', $user->id)
                ->get();
    
            $oldCita = ReservarCitas::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('funcionario_id', $user->id)
                ->get();
    
        } elseif ($user->hasRole('Peluquero')) {
            // Peluquero
            $confirmedCita = ReservarCitas::where('status', 'Confirmada')
                ->where('funcionario_id', $user->id)
                ->get();
    
            $pendingCita = ReservarCitas::where('status', 'Reservada')
                ->where('funcionario_id', $user->id)
                ->get();
    
            $oldCita = ReservarCitas::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('funcionario_id', $user->id)
                ->get();
    
        } elseif ($user->hasRole('Cliente')) {
            // Cliente
            $confirmedCita = ReservarCitas::where('status', 'Confirmada')
                ->where('paciente_id', $user->id)
                ->get();
    
            $pendingCita = ReservarCitas::where('status', 'Reservada')
                ->where('paciente_id', $user->id)
                ->get();
    
            $oldCita = ReservarCitas::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('paciente_id', $user->id)
                ->get();
        }
    
        return view('ReservarCitas.index', compact('confirmedCita', 'pendingCita', 'oldCita'));
    }
    
    

    public function create(HorarioFuncionarioServiceInterface $horarioFuncionarioServiceInterface)
    {
        $tiposervicios = tiposervicios::all();
        $tipoconsulta_tam = tipo_consulta_tamanio::all();

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

        return view('ReservarCitas.create', compact('tiposervicios','funcionarios', 'intervals', 'tipoconsulta_tam'));
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

    public function cancel(ReservarCitas $ReservarCita, Request $request){

        $user = auth()->user();
        if($request->has('justification')){
            
            $cancellation = new CancelledCitas();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();
            $ReservarCita->cancellation()->save($cancellation);
        }

        if($ReservarCita->status == 'Confirmada'){
            $correo = new CancelarHoraDespuesConfirm($ReservarCita);
            if($user->hasRole('Veterinario') || $user->hasRole('Peluquero')){
            Mail::to($ReservarCita->paciente->email)->send($correo); 
            } elseif($user->hasRole('Cliente')){
            Mail::to($ReservarCita->funcionario->email)->send($correo); 
            }
        }else{
            $correo = new CancelarHora($ReservarCita);
            if($user->hasRole('Veterinario') || $user->hasRole('Peluquero')){
                Mail::to($ReservarCita->paciente->email)->send($correo); 
                } elseif($user->hasRole('Cliente')){
                Mail::to($ReservarCita->funcionario->email)->send($correo); 
                }
        }  
        $ReservarCita->status = 'Cancelada';

        $ReservarCita->save();
        $notification = 'La cita se ha cancelado correctamente.';
        
        return redirect('/miscitas')->with(compact('notification'));
    }

    public function formCancel(ReservarCitas $ReservarCita){

        if($ReservarCita->status == 'Confirmada'){
            return view('ReservarCitas.cancel', compact('ReservarCita'));
        }
        return redirect('/miscitas');
    }

    public function show(ReservarCitas $ReservarCita){
        return view('ReservarCitas.show' , compact('ReservarCita'));
    }

    public function enviarRecordatorioDiaAntes()
    {
        $today = Carbon::today();
        $tomorrow = $today->copy()->addDay();

        $citas = ReservarCitas::whereDate('scheduled_date', $tomorrow)->get();

        foreach ($citas as $cita) {
            $user = $cita->paciente;
            $correo = new AproximacionHora($cita);
            Mail::to($user->email)->send($correo);
        }
        
    }

    public function confirm(ReservarCitas $ReservarCita){
        
        $ReservarCita->status = 'Confirmada';
        $correo = new ConfirmacionHora($ReservarCita);
        $ReservarCita->save();

        Mail::to($ReservarCita->paciente->email)->send($correo);

        
        $notification = 'La cita se ha confirmado correctamente.';
        
        return redirect('/miscitas')->with(compact('notification'));
    }
}