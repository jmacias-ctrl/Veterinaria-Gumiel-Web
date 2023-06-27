<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Mail\AproximacionHora;
use App\Mail\CancelarHora;
use App\Mail\CancelarHoraDespuesConfirm;
use App\Mail\ConfirmacionHora;
use App\Models\CancelledCitas;
use App\Models\ReservarCitas;
use App\Models\servicios;
use App\Models\tiposervicios;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;

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
        } elseif ($user->hasRole('Invitado')) {
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
    
        if($user->hasRole('Veterinario') || $user->hasRole('Peluquero') || $user->hasRole('admin')){
            return view('ReservarCitas.index', compact('confirmedCita', 'pendingCita', 'oldCita'));
        }else{
            return view('ReservarCitas.index_cliente', compact('confirmedCita', 'pendingCita', 'oldCita'));
        }
        
    }
    
    

    public function create(HorarioFuncionarioServiceInterface $horarioFuncionarioServiceInterface)
    {
        $tiposervicios = tiposervicios::all();
        $tipoconsulta_tam = servicios::all();

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
                return view('ReservarCitas.index_cliente');
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
        $servicio = servicios::find($data['type']);
        $data['type'] = $servicio->nombre;
        $data['id_servicio'] = $servicio->id;
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
        $user = auth()->user();
        if($user->hasRole('Cliente')){
           if($ReservarCita->status == 'Confirmada'){
            return view('ReservarCitas.cancel_cliente', compact('ReservarCita'));
            } 
        }else if($user->hasRole('Veterinario')|| $user->hasRole('Peluquero')|| $user->hasRole('admin')){
            if($ReservarCita->status == 'Confirmada'){
                return view('ReservarCitas.cancel_funcionarios', compact('ReservarCita'));
            }
        }

        return redirect('/miscitas');
        
    }


    public function show(ReservarCitas $ReservarCita){
        $user = auth()->user();
        if($user->hasRole('Cliente')){
            return view('ReservarCitas.showcliente' , compact('ReservarCita'));
        } else if($user->hasRole('Veterinario') || $user->hasRole('Peluquero') || $user->hasRole('admin')){
            return view('ReservarCitas.show_funcionarios' , compact('ReservarCita'));
        }
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

    public function login(){
        return view('ReservarCitas.login');
    }

    public function registro_invitado(){
        return view('ReservarCitas.registro_invitado');
    }

    public function login_citas(Request $request){
        $credentials = $request->only('email', 'password');

        
        $rules = [
            'email'  => 'required|email',
            'password' => 'required|min:7' //cambiar a 8 (para probar cliente demo)
        ];
        $attributes = [
            'email' => 'Correo',
            'password' => 'Contraseña',
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'min' => ':attribute invalida, debe ser minimo :min.',
            'email' => ':attribute invalida, ingrese :attribute nuevamente.'
        ];

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            if(!auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                return back()->withErrors(['message' => 'Email o Contraseña incorrectos, vuelva a intentarlo.']); 
            }
            return redirect('/guardar-cita');
       
        }if (Auth::attempt($credentials)) {
            // La autenticación fue exitosa
            return redirect('/guardar-cita');
        } else {
            // La autenticación falló
            return redirect()->back()->withErrors(['message' => 'Credenciales inválidas']);
        }
    }

    public function registro_invitado_citas(Request $request)
    {   
        $rules = [
            'nombre' => 'required|string',
            'rut'  => 'required|string|max:10',
            'email_register'  => 'required|email',
            'telefono' => 'required|digits:9'
        ];
        $attributes = [
            'nombre' => 'Nombre',
            'rut' => 'Rut',
            'email_register' => 'Correo',
            'telefono' => 'Teléfono',
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
            'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
            'max' => ':attribute invalido, debe ser máximo :max',
            'email' => ':attribute invalido, ingrese :attribute nuevamente'
        ];

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            try {
                db::beginTransaction();
                $role=Role::where('name', '=', 'Invitado')->get();
                $rol = array(
                    $role[0]->id => $role[0]->name
                );
                $user = new User;
                $user->name = $request->nombre;
                $user->rut =  $request->rut;
                $user->email = $request->email_register;
                $user->phone = $request->telefono;
                $user->save();
                db::commit();
                $user->assignRole($rol);
                auth()->login($user);
                return redirect('/guardar-cita');
            } catch (QueryException $exception) {
                DB::rollBack();
                return back()->withInput();
            }

        }return back()->withErrors($validator)->withInput();
        
    }

//     public function guardarCita(Request $request)
// {
//     // Obtener los datos de la cita desde el formulario de solicitud
//     $tiposervicioId = $request->input('tiposervicio_id');
//     $funcionarioId = $request->input('funcionario_id');
//     $scheduledDate = $request->input('scheduled_date');
//     $scheduledTime = $request->input('sheduled_time');
//     $description = $request->input('description');
//     // ... Obtener el resto de los datos de la cita ...

//     // Crear la nueva cita y guardarla en la base de datos
//     $cita = new ReservarCitas();
//     $cita->tiposervicio_id = $tiposervicioId;
//     $cita->funcionario_id = $funcionarioId;
//     $cita->scheduled_date = $scheduledDate;
//     $cita->sheduled_time = $scheduledTime;
//     $cita->description = $description;
//     // ... Establecer el resto de los atributos de la cita ...
//     $cita->save();

//     // Puedes redirigir al usuario a una página de éxito o mostrar un mensaje de confirmación
//     $notification = 'La cita se ha confirmado correctamente.';
//     return redirect('/miscitas')->with(compact('notification'));
// }

public function guardarCita(Request $request, HorarioFuncionarioServiceInterface $horarioFuncionarioServiceInterface){
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
            return view('ReservarCitas.index_cliente');
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
    $servicio = servicios::find($data['type']);
    $data['type'] = $servicio->nombre;
    $data['id_servicio'] = $servicio->id;
    $carbonTime = Carbon::createFromFormat('H:i', $data['sheduled_time']);
    $data['sheduled_time'] = $carbonTime->format('H:i:s');

    ReservarCitas::create($data);

    $notification = 'La cita se ha realizado correctamente.';
    return back()->with(compact('notification'));
} 
}