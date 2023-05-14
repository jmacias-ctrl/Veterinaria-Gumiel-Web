@extends('layouts.panel_usuario')
<title>Ingresar Funcionario - Veterinaria Gumiel</title>
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
    <a href="{{ route('funcionarios.index') }}"> <span class="material-symbols-outlined"
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('funcionarios.index')}}" style="color:black;">Funcionarios</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Editar Funcionarios</li>
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
                <form action="{{ url('/funcionarios/'.$funcionarios->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="container">
                    <h2 class="mt-4">Editar funcionario</h2>
                    <div class="row mt-3">
                    <div class="row mt-3">
                    <div class="row mt-3">
                            <div class="col">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" 
                                    aria-label="Nombre" value="{{ old('name', $funcionarios->name) }}">
                                @error('name')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                            <!-- <div class="col">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" id="apellido" name="apellido"
                                    class="form-control @error('apellido') is-invalid @enderror" 
                                    aria-label="Apellido" value="{{ old('apellido', $funcionarios->name) }}" required>
                                @error('apellido')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div> -->
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col">
                                <label for="rut" class="form-label">Rut</label>
                                <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut"
                                    name="rut" value="{{ old('rut',$funcionarios->rut) }}" required>
                                @error('rut')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" 
                                    value="{{ old('email', $funcionarios->email) }}" required>
                                @error('email')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="telefono" class="form-label">Telefono</label>
                                <div class="input-group">
                                    <div class="input-group-text">+56</div>
                                    <input type="number" class="form-control @error('telefono') is-invalid @enderror"
                                        id="telefono" name="telefono" maxlength="9" minlength="9"
                                        value="{{ old('telefono', $funcionarios->phone) }}">
                                </div>
                                @error('telefono')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="password">Contraseña</label>
                                <input type="text" name="password" class="form-control">
                                <small class="text-warning">Solo llena el campo si desea cambiar la contraseña</small>
                            </div>
                        </div>

                        <h5 class="mt-4">Roles</h5>
                        <div class="row justify-content-center align-items-center g-2">


                            @foreach ($roles as $rol)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="roles{{ $rol->id }}"
                                            value="{{ $rol->name }}" @if (old('roles' . $rol->id . ']') == $rol->name) checked @endif>
                                        <label class="form-check-label" for="inlineRadio">
                                            {{ $rol->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="row row-cols-auto">
                            <div class="col"><input class="btn btn-primary" id="btn-submit" type="submit" style="background-color:#19A448; border-color:#19A448;" value="Guardar cambios"></div>
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
