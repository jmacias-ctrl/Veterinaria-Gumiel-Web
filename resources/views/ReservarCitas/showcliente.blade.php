@extends('layouts.app')
<title>Cita cancelada - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

@section('content')

    <div class="form-row">
        <div class="col-md-3">
            <div class="card m-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agendar-horas.create') }}">
                        <span class="material-icons"style="position:relative; top:6px">schedule</span> Agendar hora</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('/miscitas')) active @endif" href="{{route('Agendar')}}">
                        <span class="material-icons" style="position:relative; top:6px">calendar_month</span> Mis citas</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow me-3">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                    <h3 class="mb-0"><a href="{{ url('/miscitas') }}"> <span class="material-symbols-outlined"
                    style="font-size:40px; color:green;position:relative; top:12px">
                    arrow_back
                    </span> </a>Cita #{{ $ReservarCita->id }}</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul>
                    <dd>
                        <strong>Fecha:</strong> {{ $ReservarCita->scheduled_date }}
                    </dd>
                    <dd>
                        <strong>Hora de atención:</strong> {{ $ReservarCita->sheduled_time }}
                    </dd>
                    @if (auth()->user()->hasRole('Cliente') || auth()->user()->hasRole('Admin'))
                    <dd>
                        <strong>Funcionario:</strong> {{ $ReservarCita->funcionario->name }}
                    </dd>
                    @endif
                    @if (auth()->user()->hasRole('Veterinario')|| auth()->user()->hasRole('Peluquero') || auth()->user()->hasRole('Admin'))
                    <dd>
                        <strong>Paciente:</strong> {{ $ReservarCita->paciente->name }}
                    </dd>
                    @endif
                    <dd>
                        <strong>Tipo de servicio:</strong> {{ $ReservarCita->tiposervicio->nombre }}
                    </dd>
                    <dd>
                        <strong>Tipo de consulta:</strong> {{ $ReservarCita->type }}
                    </dd>
                    <dd>
                        <strong>Estado:</strong>
                        @if($ReservarCita->status == 'Cancelada')
                            <span class="badge badge-danger">Cancelada</span>
                        @else
                            <span class="badge badge-primary">{{ $ReservarCita->status }}</span>
                        @endif
                    </dd>
                    <dd>
                        <strong>Síntomas:</strong> {{ $ReservarCita->description }}
                    </dd>
                </ul>

                @if($ReservarCita->status == 'Cancelada')
                    <div class="alert bg-light text-primery">
                        <h3>Detalles de la cancelación</h3>
                        @if ($ReservarCita->cancellation)
                        <ul>
                            <li>
                                <strong>Fecha de la cancelación:</strong>
                                {{ $ReservarCita->cancellation->created_at }}
                            </li>
                            <li>
                                <strong>La cita fue cancelada por:</strong>
                                {{ $ReservarCita->cancellation->cancelled_by->name }}
                            </li>
                            <li>
                                <strong>Motivo de la cancelación:</strong>
                                {{ $ReservarCita->cancellation->justification }}
                            </li>
                        </ul>
                        @else
                        <ul>
                            <li>La cita fue cancelada antes de su confirmación.</li>
                        </ul>
                        @endif
                    </div>
                @endif
            </div>
                    
            

            
        </div>
        </div>
    </div>
    

@endsection