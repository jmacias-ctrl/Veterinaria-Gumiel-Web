@extends('layouts.panel_usuario')
<title>Crear Usuario - Veterinaria Gumiel</title>
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
    <a href="{{ route('admin.usuarios.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Crear Usuario
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.usuarios.index')}}" style="color:black;">Usuarios</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Crear Usuario</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('admin.usuarios.store') }}" method="POST">
                    @csrf
                    <div id="RoleWindow">
                        <h2 class="mt-4">Información Personal</h2>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre"
                                    class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Pedro"
                                    aria-label="Nombre" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" id="apellido" name="apellido"
                                    class="form-control @error('apellido') is-invalid @enderror" placeholder="Ej. Ignacio"
                                    aria-label="Apellido" value="{{ old('apellido') }}" required>
                                @error('apellido')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="rut" class="form-label">Rut</label>
                                <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut"
                                    name="rut" placeholder="Ej. 12345678-9" value="{{ old('rut') }}" required>
                                @error('rut')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Ej. email@gmail.com"
                                    value="{{ old('email') }}" required>
                                @error('email')
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
                        <h5 class='my-4'>La contraseña será por defecto el rut sin el digito verificador</h5>
                        <hr class="mt-4">
                        <h5 class="mt-4">Roles</h5>
                        <div class="row justify-content-center align-items-center g-2">
                            @error('roles')
                                <div class="text-danger">
                                    <span><small>{{ _('Debes seleccionar al menos un rol') }}</small></span></div>
                            @enderror

                            @foreach ($roles as $rol)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role"
                                            value="{{ $rol->name }}" @if (old('roles[' . $rol->id . ']') == $rol->name) checked @endif>
                                        <label class="form-check-label" for="">
                                            {{ $rol->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="align-self-center">
                            <input class="btn btn-primary " id="btn-submit" type="submit" value="Agregar"
                                style="background-color:#19A448; border-color:#19A448;">
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
        var Fn = {
            validaRut: function(rutCompleto) {
                if (!/^[0-9]+-[0-9kK]{1}$/.test(rutCompleto))
                    return false;
                var tmp = rutCompleto.split('-');
                var digv = tmp[1];
                var rut = tmp[0];
                if (digv == 'K') digv = 'k';
                return (Fn.dv(rut) == digv);
            },
            dv: function(T) {
                var M = 0,
                    S = 1;
                for (; T; T = Math.floor(T / 10))
                    S = (S + T % 10 * (9 - M++ % 6)) % 11;
                return S ? S - 1 : 'k';
            }
        }
        $(document).ready(function() {
            $('#btn-submit').on('click', function(e) {
                var rut = document.getElementById('rut').value;
                e.preventDefault();
                if (!Fn.validaRut(rut)) {
                    Swal.fire(
                        'Error',
                        'Rut ingresado no sigue el formato xxxxxxxx-x',
                        'error'
                    )
                    return;
                } else {
                    var form = $(this).parents(form);
                    Swal.fire({
                        title: 'Agregar Nuevo usuario',
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
