@extends('layouts.panel_usuario')
<title>Agendar Hora - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
@endsection
@section('back-arrow')
    <a href="{{ route('inicio') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Crear Paciente
@endsection
@section('breadcrumbs')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                @if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('admin') }}" style="color:black;">
                    @elseif(auth()->user()->hasRole('Veterinario'))
                        <a href="{{ route('veterinario') }}">
                        @elseif (auth()->user()->hasRole('Peluquero'))
                            <a href="{{ route('peluquero') }}">
                            @elseif (auth()->user()->hasRole('Inventario'))
                                <a href="{{ route('inventario') }}">
                @endif
                Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Agendar Hora</li>
    </nav>
@endsection
@section('js-before')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
<div>
    {{-- Breadcrumb  --}}
</div>

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Agendar nueva hora</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor!</strong>{{ $error }}
                    </div>
                @endforeach
            @endif

            <form action="{{ url('/agendar-horas') }}" method="POST" id="myForm" name="myForm">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tiposervicio">Tipo de servicio</label>
                        <select name="tiposervicio_id" id="tiposervicio" style="color: gray;" class="form-select">
                            <option selected disabled>Selecciona un tipo de servicio</option>
                            @foreach ($tiposervicios as $tiposervicio )
                                <option value="{{$tiposervicio->id}}">{{$tiposervicio->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="funcionario">Funcionario</label>
                        <select name="funcionario_id" style="color: gray;" id="funcionario" class="form-select" required>
                            <option selected disabled >Selecciona un funcionario</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="date">Fecha</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" id="date" name="scheduled_date" placeholder="Seleccionar fecha" type="text" value="{{date('Y-m-d')}}" data-date-format="yyyy-mm-dd"
                        data-date-start-date="{{date('Y-m-d')}}" data-date-end-date="+30d">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hours">Hora de atención</label>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h4 class="m-3" id="titleMorning" ></h4>
                                <div id="hoursMorning">
                                    <mark>
                                        <small class="text-warning">
                                            Selecciona un funcionario y una fecha para ver las horas.
                                        </small>
                                    </mark>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="m-3" id="titleAfternoon" ></h4>
                                <div id="hoursAfternoon"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tipo de consulta</label>
                    <div class="custom-control custom-radio mt-3 mb-3">
                        <input type="radio" id="type1" name="type" class="custom-control-input" value="consulta">
                        <label class="custom-control-label" for="type1" >Consulta</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type2" name="type" class="custom-control-input" value="consulta_vacuna">
                        <label class="custom-control-label" for="type2">Consulta + vacunas</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="type3" name="type" class="custom-control-input" value="cirugia">
                        <label class="custom-control-label" for="type3">Cirugía</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Síntomas</label>
                    <textarea name="description" id="description" type="text" class="form-control" rows="5" placeholder="Descripción breve de los síntomas de su mascota..." required></textarea>
                </div>
              
                <br>
                <button type="submit" class="btn btn-sm btn-primary" style="background-color:#19A448; border-color:#19A448;">Guardar</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>


<script src="{{asset('/js/ReservarCitas/create.js')}}">
</script>
@endsection