@extends('layouts.panel_usuario')
<title>Cancelar cita - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('back-arrow')
    <a href="{{ url('/miscitas') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Gestion Pacientes
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Cancelar cita</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cancelar cita</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
            
            @if (auth()->user()->hasRole('Veterinario') || auth()->user()->hasRole('Peluquero')  )
                <p>Se cancelara la cita reservada para el paciente <b>{{$ReservarCita->paciente->name}}</b>
                (tipo de servicio <b>{{$ReservarCita->tiposervicio->nombre}}</b> ) 
                para el día <b>{{$ReservarCita->scheduled_date}}</b>
                y la hora <b>{{$ReservarCita->sheduled_time}}</b>.</p>
            @elseif (auth()->user()->hasRole('Admin') )
                <p>Se cancelara la cita reservada del paciente <b>{{$ReservarCita->paciente->name}}</b>
                que será atendido por el funcionario<b>{{$ReservarCita->funcionario->name}}</b>
                (tipo de servicio <b>{{$ReservarCita->tiposervicio->nombre}}</b> ) 
                para el día <b>{{$ReservarCita->scheduled_date}}</b>
                y la hora <b>{{$ReservarCita->sheduled_time}}</b>.</p>
            @endif

            <form action="{{ url('/miscitas/'.$ReservarCita->id.'/cancel') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="justification">Escriba los motivos de la cancelación:</label>
                    <textarea name="justification" id="justification" rows="3" class="form-control" required></textarea>
                </div>

                <button class="btn btn-danger" type="submit">Cancelar cita</button>

            </form>

        </div>
                
        

        
    </div>

@endsection