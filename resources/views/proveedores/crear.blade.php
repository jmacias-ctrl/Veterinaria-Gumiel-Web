@extends('layouts.panel_usuario')
<title>Crear Proveedor - Veterinaria Gumiel</title>
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
    <a href="{{ route('proveedores.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Crear Proveedor
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('proveedores.index') }}"
                    style="color:black;">Proveedores</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Crear Proveedor</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('proveedores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                            name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Chile Compra" required>
                        @error('nombre')
                            <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nombre">Rut:</label>
                        <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut"
                            name="rut" value="{{ old('rut') }}" placeholder="Ej. 11111111-1" maxlength="10"
                            oninput="checkRut(this)" required>
                        @error('rut')
                            <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="correo"
                                name="correo" placeholder="Ej. email@gmail.com" value="{{ old('correo') }}">
                            @error('correo')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <div class="input-group-text">+56</div>
                                <input type="number" class="form-control @error('telefono') is-invalid @enderror"
                                    id="telefono" name="telefono" placeholder="954231232" maxlength="9" minlength="9"
                                    value="{{ old('telefono') }}">
                            </div>
                            @error('telefono')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <hr class="my-3">
                    <button type="submit" id="btn-submit" class="btn btn-primary"
                        style="background-color:#19A448; border-color:#19A448;">Agregar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-after')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/verificacionRut.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#btn-submit').on('click', function(e) {
                e.preventDefault();
                var rut = document.getElementById('rut').value;
                var form = $(this).parents(form);
                if (!Fn.validaRut(rut)) {
                    Swal.fire(
                        'Error',
                        'Rut ingresado es invalido',
                        'error'
                    )
                    return;
                } else {
                    Swal.fire({
                        title: 'Agregar Nuevo Proveedor',
                        text: "¿Estás seguro de que todos los datos están correctos?",
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
                }

            });
        })
    </script>
@endsection
