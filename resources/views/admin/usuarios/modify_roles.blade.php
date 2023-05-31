@extends('layouts.panel_usuario')
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        #RoleWindow {
            border: 1px solid;
            padding: 15px;
            border-radius: 25px;
        }
    </style>
@endsection
@section('title')
    Modificar Roles Usuario - Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('header-title')
    Modificación de Roles del Usuario {{ $user->name }}
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Roles</li>
    </nav>
@endsection
@section('back-arrow')
    <a href="{{ route('admin.usuarios.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('admin.usuarios.update.roles') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                        <h3 class="mt-4">Roles</h3>
                        @error('roles')
                            <div class="text-danger"><span><small>{{ _('Debes seleccionar al menos un rol') }}</small></span>
                            </div>
                        @enderror
                        <div class="row justify-content-center align-items-center g-2">
                            @foreach ($user->nombre_roles as $rol)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role"
                                            value="{{ $rol }}" checked>
                                        <label class="form-check-label" for="">
                                            {{ $rol }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($roles as $rol)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role"
                                            value="{{ $rol->name }}">
                                        <label class="form-check-label">
                                            {{ $rol->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>

                        <input name="" id="btn-submit" class="btn btn-primary" type="submit" value="Modificar Roles"
                            style="background-color:#19A448; border-color:#19A448;">
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
                    title: 'Modificación de Roles de un Usuario',
                    text: "¿Estás seguro de los roles asignados?",
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
