@extends('layouts.panel_usuario')
<title>Modificar Marca Insumos Medicos - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('title')
    Modificar Marcas - Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('header-title')
    Modificacion de Marca {{ $marcaInsumo->nombre }}
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.marcaInsumos.index')}}" style="color:black;">Marcas Insumos</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Marcas</li>
    </nav>
@endsection
@section('back-arrow')
    <a href="{{ route('admin.marcaInsumos.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
            <form id="formMarca" action="{{ route('admin.marcaInsumos.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $marcaInsumo->id }}">
            <h5 class="my-4">Informacion del Rol</h5>
            <div class="row mt-3">
                <div class="col">
                    <label for="nombre" class="form-label">Nombre Marca</label>
                    <input type="text"  class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Braun" aria-label="nombre"
                        value="{{ $marcaInsumo->nombre }}" id="nombre" name="nombre" required>
                    @error('nombre')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>

            </div>
            <hr class="my-3">
            <input class="btn btn-primary" id="btn-submit" type="submit" style="background-color:#19A448; border-color:#19A448;" value="Modificar Marca">
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
                var form = $(this).parents(form);
                e.preventDefault();

                Swal.fire({
                    title: 'Modificar Marca de Insumo Medico',
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
