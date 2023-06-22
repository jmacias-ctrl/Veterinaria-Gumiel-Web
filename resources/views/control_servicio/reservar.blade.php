@extends('layouts.panel_usuario')
<title>Agendar Hora - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <a href="{{ route('control_servicios.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Agendar Hora
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('control_servicios.index') }}">Punto de Pago /
                    Reserva de Servicios</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Agendar Hora</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="row">
        <div class="col">
            <div class="card shadow me-3">
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

                    <form action="{{ url('/control-servicios/reservar') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nombre Completo</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="helpId" value="{{ old('name') }}"
                                    placeholder="Ej. Juan Perez Alameda" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Rut</label>
                                <input type="text" class="form-control" name="rut" id="rut"
                                    aria-describedby="helpId" value="{{ old('rut') }}" maxlength="10"
                                    oninput="checkRut(this)" placeholder="Ej. 13412596-2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="helpId" value="{{ old('email') }}" placeholder="Ej. test@gmail.com" required>
                        </div>
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
                                        <h4 class="m-3" id="titleMorning"></h4>
                                        <div id="hoursMorning">
                                            @if ($intervals)
                                                <h4 class="m-3">En la mañana</h4>
                                                @foreach ($intervals['morning'] as $key => $interval)
                                                    <div class="custom-control custom-radio mb-3">
                                                        <input type="radio" id="intervalMorning{{ $key }}"
                                                            name="sheduled_time" value="{{ $interval['start'] }}"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="intervalMorning{{ $key }}">{{ $interval['start'] }}
                                                            - {{ $interval['end'] }}</label>
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
                                        <h4 class="m-3" id="titleAfternoon"></h4>
                                        <div id="hoursAfternoon">
                                            @if ($intervals)
                                                <h4 class="m-3">En la tarde</h4>
                                                @foreach ($intervals['afternoon'] as $key => $interval)
                                                    <div class="custom-control custom-radio mb-3">
                                                        <input type="radio" id="intervalAfternoon{{ $key }}"
                                                            name="sheduled_time" value="{{ $interval['start'] }}"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="intervalAfternoon{{ $key }}">{{ $interval['start'] }}
                                                            - {{ $interval['end'] }}</label>
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
                            @foreach ($tipoconsulta_tam as $tipoconsulta)
                                @if ($tipoconsulta->tiposervicios->nombre == 'Atención medica')
                                    <div class="custom-control custom-radio mt-3 mb-3">
                                        <input type="radio" id="{{ $tipoconsulta->id }}" name="type"
                                            class="custom-control-input" value="{{ $tipoconsulta->id }}">
                                        <label class="custom-control-label"
                                            for="{{ $tipoconsulta->id }}">{{ $tipoconsulta->nombre }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div id="tamMascota" class="form-group" style="display: none;">
                            <label>Tamaño mascota</label>
                            @foreach ($tipoconsulta_tam as $tipoconsulta)
                                @if ($tipoconsulta->tiposervicios->nombre == 'Peluquería')
                                    <div class="custom-control custom-radio mt-3 mb-3">
                                        <input type="radio" id="{{ $tipoconsulta->id }}" name="type"
                                            class="custom-control-input" value="{{ $tipoconsulta->id }}">
                                        <label class="custom-control-label"
                                            for="{{ $tipoconsulta->id }}">{{ $tipoconsulta->nombre }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción/Síntomas</label>
                            <textarea name="description" id="description" type="text" class="form-control campoRequerido" rows="5"
                                placeholder="Agregar una descripción breve..." required></textarea>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-sm btn-primary"
                            style="background-color:#19A448; border-color:#19A448;">Agendar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/ReservarCitas/create.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#btnprueba').click(function() {
                // Verificar si los campos del formulario están llenos
                if (verificarFormularioCompleto()) {
                    // Si el formulario está completo, mostrar el modal
                    $('#OpcionesInv').modal('show');
                } else {
                    // Si el formulario no está completo, mostrar un mensaje de error o realizar otra acción
                    mostrarAlertaError('Por favor, complete todos los campos del formulario.');
                }
            });

            function verificarFormularioCompleto() {
                // Aquí puedes personalizar la lógica para verificar si los campos del formulario están llenos
                // Por ejemplo, si tienes campos de entrada de texto con clases "campoRequerido", puedes verificarlos de la siguiente manera:
                var camposVacios = $('.campoRequerido').filter(function() {
                    return $(this).val() === '';
                });

                return camposVacios.length === 0;
            }

            function mostrarAlertaError(mensaje) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: mensaje,
                });
            }
        });

        function checkRut(rut) {
            var valor = rut.value.replace('.', '');
            valor = valor.replace('-', '');

            cuerpo = valor.slice(0, -1);
            dv = valor.slice(-1).toUpperCase();

            rut.value = cuerpo + '-' + dv

            if (cuerpo.length < 7) {
                rut.setCustomValidity("RUT Incompleto");
                return false;
            }

            suma = 0;
            multiplo = 2;

            for (i = 1; i <= cuerpo.length; i++) {

                index = multiplo * valor.charAt(cuerpo.length - i);

                suma = suma + index;

                if (multiplo < 7) {
                    multiplo = multiplo + 1;
                } else {
                    multiplo = 2;
                }

            }

            dvEsperado = 11 - (suma % 11);

            dv = (dv == 'K') ? 10 : dv;
            dv = (dv == 0) ? 11 : dv;

            if (dvEsperado != dv) {
                rut.setCustomValidity("RUT Inválido");
                return false;
            }

            rut.setCustomValidity('');
        }
    </script>
@endsection
