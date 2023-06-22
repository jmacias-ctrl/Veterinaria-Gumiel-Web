@extends('layouts.panel_usuario')
<title>Modificar Tipo de consulta / Tamaño - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('title')
    Modificar Tipo de consulta / Tamaño - Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('header-title')
    Modificacion de Tipo de consulta / Tamaño : {{ $tipoconsulta_tam->nombre }}
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.tipoconsulta_tamanio.index')}}" style="color:black;">Tipo de consulta / Tamaño</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Tipo de consulta / Tamaño</li>
    </nav>
@endsection
@section('back-arrow')
    <a href="{{ route('admin.tipoconsulta_tamanio.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{route('admin.tipoconsulta_tamanio.update')}}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col">
                            <input type="hidden" name="id" value="{{ $tipoconsulta_tam->id }}">
                            <label for="nombre"class="form-label">Nombre Tipo de consulta / Tamaño</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                value="{{ $tipoconsulta_tam->nombre }}" id="nombre" checked>
                            @error('nombre')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                    <div class="col">
                            <label for="duracion" class="form-label">Duración</label>
                            <input type="integer" id="duracion" name="duracion" class="form-control @error('duracion') is-invalid @enderror"
                            value="{{ $tipoconsulta_tam->duracion }}" checked>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="nombre" class="form-label">Tipo se servicio</label>
                            <select class="form-select @error('tiposervicio_id') is-invalid @enderror" aria-label="Default select example"
                            name="tiposervicio_id" id="tiposervicio_id">
                            @foreach ($tiposervicios as $tipo)
                                @if ($tipo->id == $tipoconsulta_tam->tiposervicio_id)
                                    <option selected type="unsignedBigInteger" id="tiposervicio_id" name="tiposervicio_id"
                                        value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @else
                                    <option type="unsignedBigInteger" id="id_tipo" name="tiposervicio_id" value="{{ $tipo->id }}">
                                        {{ $tipo->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('tiposervicio_id')
                            <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                        </div>
                    </div>
                    <div class="container">
                    <br>
                    <input name="" id="btn-submit" class="btn btn-primary"
                                style="background-color:#19A448; border-color:#19A448;" type="submit" value="Modificar">
                    </div>
                </form>
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
                e.preventDefault();
                var form = $(this).parents(form);
                Swal.fire({
                    title: 'Modificar Tipo de consulta / Tamaño',
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
            });
        })
    </script>
@endsection