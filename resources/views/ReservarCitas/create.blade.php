@extends('layouts.app')
<title>Agendar Hora - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    Agendar Hora
@endsection

@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')

<div class="form-row px-5 py-2">
    @include('layouts.panel_cliente')
    <div class="col-md-9">
        <div class="card shadow me-3 mt-3">
            <div class="card-header border-2">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Agendar nueva hora</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">

            
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @endif
            
                
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Por favor!</strong>{{ $error }}
                        </div>
                    @endforeach
                @endif

                <form id="hola" action="{{ url('/agendar-horas') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tiposervicio">Tipo de servicio</label>
                            <select name="tiposervicio_id" id="tiposervicio" style="color: gray;" class="form-select">
                                <option selected disabled>Selecciona un tipo de servicio</option>
                                @foreach ($tiposervicios as $tiposervicio )
                                    <option value="{{$tiposervicio->id}}" data-consulta="{{$tiposervicio->tipoConsulta}}"
                                    @if(old('tiposervicio_id') == $tiposervicio->id) selected @endif
                                    >{{$tiposervicio->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="funcionario">Funcionario</label>
                            <select name="funcionario_id" style="color: gray;" id="funcionario" class="form-select" required>
                                <option selected disabled >Selecciona un funcionario</option>
                                @foreach ($funcionarios as $funcionario )
                                    <option value="{{$funcionario->id}}"
                                    @if(old('funcionario_id') == $funcionario->id) selected @endif
                                    >{{$funcionario->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" id="date" name="scheduled_date" placeholder="Seleccionar fecha"  value="{{old ('scheduled_date'), date('Y-m-d')}}" data-date-format="yyyy-mm-dd"
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
                                        @if ($intervals)
                                        <h4 class="m-3">En la mañana</h4>
                                            @foreach ($intervals['morning'] as $key=>$interval)
                                                <div class="custom-control custom-radio mb-3">
                                                    <input type="radio" id="intervalMorning{{ $key }}" name="sheduled_time" value="{{$interval['start']}}" class="custom-control-input" >
                                                    <label class="custom-control-label" for="intervalMorning{{ $key }}">{{ $interval['start'] }} - {{$interval['end']}}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            <mark>
                                                <small class="text-warning">
                                                    Selecciona un funcionario y una fecha para ver las horas.
                                                </small>
                                            </mark>
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <h4 class="m-3" id="titleAfternoon" ></h4>
                                    <div id="hoursAfternoon">
                                        @if ($intervals)
                                        <h4 class="m-3">En la tarde</h4>
                                            @foreach ($intervals['afternoon'] as $key=>$interval)
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="intervalAfternoon{{ $key }}" name="sheduled_time" value="{{$interval['start']}}" class="custom-control-input" >
                                                <label class="custom-control-label" for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} - {{$interval['end']}}</label>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tipoConsulta" class="form-group" style="display: none;">
                    
                        <label>Tipo de consulta</label>
                        @foreach ( $tipoconsulta_tam as $tipoconsulta )
                            @if ($tipoconsulta->tiposervicios->nombre == 'Atención medica')
                                <div class="custom-control custom-radio mt-3 mb-3">
                                    <input type="radio" id="{{ $tipoconsulta -> id}}" name="type" class="custom-control-input" value="{{ $tipoconsulta->id }}">                    
                                    <label class="custom-control-label" for="{{ $tipoconsulta -> id}}" >{{ $tipoconsulta->nombre }}</label> 
                                </div> 
                            @endif
                            
                        @endforeach
                    </div>

                    <div id="tamMascota" class="form-group" style="display: none;">
                        <label>Tamaño mascota</label>
                        @foreach ( $tipoconsulta_tam as $tipoconsulta )
                            @if ($tipoconsulta->tiposervicios->nombre == 'Peluquería')
                            <div class="custom-control custom-radio mt-3 mb-3">
                            <input type="radio" id="{{ $tipoconsulta -> id}}" name="type" class="custom-control-input" value="{{ $tipoconsulta->id }}">                    
                                    <label class="custom-control-label" for="{{ $tipoconsulta -> id}}" >{{ $tipoconsulta->nombre }}</label> 
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="description">Síntomas</label>
                        <textarea name="description" id="description" type="text" class="form-control campoRequerido" rows="5" placeholder="Agregar una descripción breve..." required></textarea>
                    </div>
                
                    <br>
                    <p class="a-dec font-weight-bold ">Debes iniciar sesión o ingresar como invitado para guardar la hora médica.</p>
                    <br>
                    
                    <div class="pb-3 pr-3 pl-3">
                        @guest <!-- Verifica si el usuario no ha iniciado sesión -->
                            <a href="{{ route('ReservarCitas.login') }}" onclick="GuardarInputs()" class="btn btn-primary" style="background-color: #19A448; border-color: #19A448;">Iniciar sesión</a>
                        @else
                            <form id="guardar" action="" method="POST">
                            {{csrf_field()}}
                            <input type="submit" onclick="deleteStorage()" id="submitButton" value="Guardar" class="btn btn-primary" style="background-color:#19A448; border-color:#19A448;"/>
                            </form>                        
                        @endguest
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>

    
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>


<script src="{{asset('/js/ReservarCitas/create.js')}}"></script>



@endsection