@extends('layouts.panel_usuario')
<title>Agendar Hora - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dataTables_filter,
        .dataTables_info {
            display: none;
        }

        .swal2-container {
            z-index: 10000;
        }
    </style>
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('control_servicios.index') }}">Punto de Pago / Reserva de Servicios</a> </li>
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

                    <form action="{{ url('/agendar-horas') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tiposervicio">Tipo de servicio</label>
                                <select name="tiposervicio_id" id="tiposervicio" style="color: gray;" class="form-select">
                                    <option selected disabled>Selecciona un tipo de servicio</option>
                                    @foreach ($tiposervicios as $tiposervicio)
                                        <option value="{{ $tiposervicio->id }}"
                                            data-consulta="{{ $tiposervicio->tipoConsulta }}"
                                            @if (old('tiposervicio_id') == $tiposervicio->id) selected @endif>{{ $tiposervicio->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="funcionario">Funcionario</label>
                                <select name="funcionario_id" style="color: gray;" id="funcionario" class="form-select"
                                    required>
                                    <option selected disabled>Selecciona un funcionario</option>
                                    @foreach ($funcionarios as $funcionario)
                                        <option value="{{ $funcionario->id }}"
                                            @if (old('funcionario_id') == $funcionario->id) selected @endif>{{ $funcionario->nombre }}
                                        </option>
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
                                <input class="form-control datepicker" id="date" name="scheduled_date"
                                    placeholder="Seleccionar fecha" value="{{ old('scheduled_date'), date('Y-m-d') }}"
                                    data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}"
                                    data-date-end-date="+30d">
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
@section('js-after')
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>
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
    </script>
@endsection
