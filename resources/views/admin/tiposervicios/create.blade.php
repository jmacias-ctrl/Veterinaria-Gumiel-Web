@extends('layouts.panel_usuario')
<title>Ingresar Tipo de Servicios - Veterinaria Gumiel</title>
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
        </style>
@endsection
@section('back-arrow')
    <a href="{{ route('admin.tiposervicios.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Crear Tipo de Servicio
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.tiposervicios.index')}}" style="color:black;">Tipo Servicios</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Crear Tipo de Servicio</li>
    </nav>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('admin.tiposervicios.store') }}" method="POST">
                @csrf
                <div class="container">
                    <h5 class="mt-4">Informacion del Tipo</h5>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input minlength="4" type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Peluquería"
                                aria-label="Nombre" required>
                            @error('nombre')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <h5 class="mt-4">Funcionario asociado</h5>
                                <div class="row justify-content-center align-items-center g-2">
                                <div class="col">
                                    <select class="form-select @error('user_id') is-invalid @enderror"
                                        aria-label="Default select example" name="user_id" id="user_id">
                                        <option selected disabled>Seleccione una opcion</option>
                                        @foreach ($users as $user)
                                            @if ($user->hasRole('Veterinario') || $user->hasRole('Peluquero'))
                                            <option type="unsignedBigInteger" value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif                       
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                    @enderror
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="row row-cols-auto">
                            <div class="col"><input class="btn btn-primary" id="btn-submit" type="submit" style="background-color:#19A448; border-color:#19A448;" value="Agregar"></div>
                        </div>
                    </div>
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
                e.preventDefault();
                var form = $(this).parents(form);
                Swal.fire({
                    title: 'Agregar Nuevo Tipo de Servicio',
                    text: "¿Estás seguro de que todos los datos estan correctos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, agregar',
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
