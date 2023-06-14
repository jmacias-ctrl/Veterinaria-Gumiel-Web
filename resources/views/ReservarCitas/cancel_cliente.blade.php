@extends('layouts.app')
<title>Cancelar cita - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                                style="font-size:40px; color:green; position:relative; top:12px">
                                arrow_back
                            </span> </a>Cancelar cita</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif
                    @if (auth()->user()->hasRole('Cliente'))
                        <p>Se cancelara tu cita reservada con el funcionario <b>{{$ReservarCita->funcionario->name}}</b>
                        (tipo de servicio <b>{{$ReservarCita->tiposervicio->nombre}}</b> ) 
                        para el día <b>{{$ReservarCita->scheduled_date}}</b>.</p>
                    @elseif (auth()->user()->hasRole('Veterinario') || auth()->user()->hasRole('Peluquero')  )
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
            </div>
    </div>

    
@endsection