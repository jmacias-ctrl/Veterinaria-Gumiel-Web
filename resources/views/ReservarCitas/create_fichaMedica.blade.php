@extends('layouts.panel_usuario')
<title>Generar ficha medica - Veterinaria Gumiel</title>
@section('css-before')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('back-arrow')
<a href="{{ url('/miscitas') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
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
        <li class="breadcrumb-item active" aria-current="page" style="color:white;">Generar Ficha Medica</li>
</nav>
@endsection
@section('content')
{{-- Breadcrumb  --}}
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Generar Ficha Medica</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('notification'))
        <div class="alert alert-success" role="alert">
            {{ session('notification') }}
        </div>
        @endif

        <div class="FormContainer">
            @csrf

            @php
            $hasPet = rand(0, 1);
            @endphp

            @if ($hasPet)
            <p>Tiene <strong>mascota</strong></p>
            @else
            <p>Usted no tiene <strong>mascota</strong></p>
            @endif

            <div class="tableContainer">
                <div class="contenedorTabla">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Especie</th>
                                    <th scope="col">Sexo</th>
                                    <th scope="col">Fecha de Nacimiento</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $indice = 1;
                                @endphp

                                @if (count($mascotas) > 0)
                                @foreach ($mascotas as $mascota)
                                <tr>
                                    <th scope="row">
                                        {{ $indice }}
                                    </th>
                                    @php
                                    $indice++;
                                    @endphp
                                    <td>{{ $mascota->nombre }}</td>
                                    <td>{{ $mascota->GetEspecie->nombre }}</td>
                                    <td>{{ $mascota->sexo }}</td>
                                    <td>{{ $mascota->fecha_nacimiento }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Generar ficha medica" data-toggle="modal" data-target="#modalAgregarFichaMedica">Generar ficha medica</button>
                                        <button class="btn btn-sm btn-outline-warning" title="Ver resumen" data-toggle="modal" data-target="#myModal">Ver resumen</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAgregarMascota" tabindex="-1" role="dialog" aria-labelledby="modalAgregarMascotaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarMascotaLabel">Agregar nueva mascota</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('guardar-datos-mascota') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_cliente" value="{{ $cliente->id }}">

                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <div class="form-group">
                                    <label for="especie">Especie</label>
                                    <select class="form-control" id="especie" name="especie" required>
                                        @foreach ($especies as $especie)
                                        <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" id="sexo" name="sexo" required>
                                        <option value="Macho">Macho</option>
                                        <option value="Hembra">Hembra</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Agregar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- <p>C</p> -->
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalAgregarMascota">+ Agregar nueva mascota</button>

            <div class="modal fade" id="modalAgregarFichaMedica" tabindex="-1" role="dialog" aria-labelledby="modalAgregarFichaMedicaLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarFichaMedicaLabel">Agregar nueva ficha médica</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="row" action="{{ url('miscitas/generar-ficha-medica') }}" method="POST">
                                @csrf
                                <div class="col-md-12 col-lg-6">
                                    <input type="hidden" name="id_mascota" value="{{ isset($mascota->id) ? $mascota->id : '' }}">

                                    <div class="form-group">
                                        <label for="peso_mascota">Peso de la mascota</label>
                                        <input type="text" class="form-control" id="peso_mascota" name="peso_mascota" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="edad">Edad</label>
                                        <input type="text" class="form-control" id="edad" name="edad" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="observacion">Observación</label>
                                        <textarea class="form-control" id="observacion" name="observacion" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="procedimiento">Procedimiento</label>
                                        <textarea class="form-control" id="procedimiento" name="procedimiento" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="medicamentos">Medicamentos</label>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Stock</th>
                                                        <th>Código</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medicamentos as $medicamento)
                                                    <tr>
                                                        <td>{{$medicamento->nombre}}</td>
                                                        <td>{{$medicamento->stock}}</td>
                                                        <td>{{$medicamento->codigo}}</td>
                                                        <td>
                                                            <input type="number" name="medicamentos[{{ $medicamento->id }}]" min="0" max="{{ $medicamento->stock }}" value="0">
                                                            <input type="hidden" name="medicamento_ids[]" value="{{ $medicamento->id }}">
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                    @foreach ($insumos as $insumo)
                                                    <tr>
                                                        <td>{{$insumo->nombre}}</td>
                                                        <td>{{$insumo->stock}}</td>
                                                        <td>{{$insumo->codigo}}</td>
                                                        <td>
                                                            <input type="number" name="insumos[{{ $insumo->id }}]" min="0" max="{{ $insumo->stock }}" value="0">
                                                            <input type="hidden" name="insumo_ids[]" value="{{ $insumo->id }}">
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <input type="hidden" name="id_hora_reservada" value="{{ $ReservarCita->id }}">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Agregar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- <p>C</p> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Datos de la mascota</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Peso de la mascota</th>
                                        <th>Edad</th>
                                        <th>Observación</th>
                                        <th>Procedimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                    <tr>
                                        <td>{{ $registro->peso_mascota }}</td>
                                        <td>{{ $registro->edad }}</td>
                                        <td>{{ $registro->observacion }}</td>
                                        <td>{{ $registro->procedimiento }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
    const tx = document.getElementsByTagName("textarea");

    for (let i = 0; i < tx.length; i++) {
        tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
        tx[i].addEventListener("input", OnInput, false);
    }

    function OnInput(event) {
        this.style.height = 0;
        this.style.height = (this.scrollHeight) + "px";
    }
</script>

@endsection