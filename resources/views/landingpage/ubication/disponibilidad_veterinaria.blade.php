@extends('layouts.panel_usuario')
<title>Modificación Landing Page - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .imageProfile {
            width: 150px;

        }
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('back-arrow')
    <a href="{{ route('user.profile.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Modificación Landing Page
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Landing Page</li>
    </nav>
@endsection
@php
    $days = [
        0 => 'Lunes',
        1 => 'Martes',
        2 => 'Miercoles',
        3 => 'Jueves',
        4 => 'Viernes',
        5 => 'Sabado',
        6 => 'Domingo',
    ];
@endphp
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">

                <form action="{{ route('landing.horario.update') }}" method="POST">
                    @csrf
                    <!-- <input type="hidden" name="id" value="{{ Auth::user()->id }}"> -->
                    <div class="d-flex justify-content-center">
                        <div class="btn-group btn-group-lg" role="group">
                            <a class="btn btn-outline-success" href="{{ route('landing.ubication.edit') }}"
                                role="button">Información</a>
                            <a class="btn btn-outline-success" href="{{ route('landing.nosotros.edit') }}"
                                role="button">Sección Nosotros</a>
                            <a class="btn btn-outline-success" href="{{ route('landing.website.edit') }}"
                                role="button">Landing Page</a>
                            <a class="btn btn-outline-success active" href="{{ route('landing.horario.edit') }}"
                                role="button">Horario</a>
                        </div>
                    </div>
                    <h2>Horario Disponibilidad de la Veterinaria</h2>
                    <div class="card-body">
                        @if (session('notification'))
                            <div class="alert alert-success" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif

                        @if (session('errors'))
                            <div class="alert alert-danger" role="alert">
                                los cambios se han guardado, pero encontramos los siguientes errores:
                                <ul>
                                    @foreach (session('errors') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                    </div>
                    <div class="table-responsive ">
                        <table
                            class="datatable display responsive nowrap table table-sm table-hover table-striped table-bordered w-100 shadow-sm"
                            id="table">
                            <thead>
                                <tr>
                                    <th scope="col">Día</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Disponibilidad Mañana</th>
                                    <th scope="col">Disponibilidad tarde</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($horario as $key => $Disponibilidad)
                                    <tr>
                                        <th>{{ $days[$key] }}</th>
                                        <td>
                                            <label class="custom-toggle">
                                                <input type="checkbox" name="active[]" value="{{ $key }}"
                                                    @if ($Disponibilidad->active) checked @endif>
                                                <span class="custom-toggle-slider rounded-circle"
                                                    style="border:1px solid #19A448"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <select class="form-select" style="color:gray" name="morning_start[]">
                                                        @for ($i = 9; $i <= 14; $i++)
                                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                                                @if ($i < 10) {{ '0' . $i . ':00' == $Disponibilidad->morning_start ? 'selected' : null }}>
                                                            @else
                                                            {{ $i . ':00' == $Disponibilidad->morning_start ? 'selected' : null }}> @endif
                                                                {{ $i }}:00</option>
                                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                                                @if ($i < 10) {{ '0' . $i . ':30' == $Disponibilidad->morning_start ? 'selected' : null }}>
                                                            @else
                                                            {{ $i . ':30' == $Disponibilidad->morning_start ? 'selected' : null }}> @endif
                                                                {{ $i }}:30</option>
                                                        @endfor

                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-select" style="color:gray" name="morning_end[]">
                                                        @for ($i = 9; $i <= 14; $i++)
                                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                                                @if ($i < 10) {{ '0' . $i . ':00' == $Disponibilidad->morning_end ? 'selected' : null }}>
                                                            @else
                                                            {{ $i . ':00' == $Disponibilidad->morning_end ? 'selected' : null }}> @endif
                                                                {{ $i }}:00</option>
                                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                                                @if ($i < 10) {{ '0' . $i . ':30' == $Disponibilidad->morning_end ? 'selected' : null }}>
                                                            @else
                                                            {{ $i . ':30' == $Disponibilidad->morning_end ? 'selected' : null }}> @endif
                                                                {{ $i }}:30</option>
                                                        @endfor

                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <select class="form-select" style="color:gray" name="afternoon_start[]">
                                                        @for ($i = 15; $i <= 19; $i++)
                                                            <option value="{{ $i }}:00"
                                                                @if ($i . ':00' == $Disponibilidad->afternoon_start || '0' . $i . ':00' == $Disponibilidad->afternoon_start) selected @endif>
                                                                {{ $i }}:00</option>
                                                            <option value="{{ $i }}:30"
                                                                @if ($i . ':30' == $Disponibilidad->afternoon_start || '0' . $i . ':30' == $Disponibilidad->afternoon_start) selected @endif>
                                                                {{ $i }}:30</option>
                                                        @endfor

                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-select" style="color:gray" name="afternoon_end[]">
                                                        @for ($i = 15; $i <= 19; $i++)
                                                            <option
                                                                value="{{ $i }}:00"@if ($i . ':00' == $Disponibilidad->afternoon_end || '0' . $i . ':00' == $Disponibilidad->afternoon_end) selected @endif>
                                                                {{ $i }}:00</option>
                                                            <option
                                                                value="{{ $i }}:30"@if ($i . ':30' == $Disponibilidad->afternoon_end || '0' . $i . ':30' == $Disponibilidad->afternoon_end) selected @endif>
                                                                {{ $i }}:30</option>
                                                        @endfor

                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Modificar"
                            style="background-color:#19A448; border-color:#19A448;">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js-after')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#btn-submit').on('click', function(e) {
                var rut = document.getElementById('rut').value;
                e.preventDefault();
                if (!Fn.validaRut(rut)) {
                    Swal.fire(
                        'Error',
                        'Rut ingresado no sigue el formato, debe ser xxxxxxxx-x',
                        'error'
                    )
                    return;
                } else {
                    var form = $(this).parents(form);
                    Swal.fire({
                        title: 'Modificar tu Perfil de Usuario',
                        text: "¿Estás seguro de que todos los datos estan correctos?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, modificar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }

            });
        })
    </script>
@endsection
