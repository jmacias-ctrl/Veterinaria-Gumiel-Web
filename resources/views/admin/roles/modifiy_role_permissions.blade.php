@extends('layouts.panel_usuario')
<title>Modificacion de Permisos del Rol - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('back-arrow')
    <a href="{{ route('admin.roles.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Modificacion de Permisos Rol {{ $role->name }}
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.roles.index') }}"
                    style="color:black;">Roles</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Permisos</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('admin.role.update.permissions') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <h2 class="my-4">Permisos</h2>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col">
                            <h5>Productos</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]" value="ver productos"
                                    id="flexCheckDefault" @if ($permissions->contains('ver productos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ver
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    value="modificar productos" id="flexCheckDefault"
                                    @if ($permissions->contains('modificar productos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Modificar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar productos"
                                    id="flexCheckDefault" @if ($permissions->contains('eliminar productos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Eliminar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar productos"
                                    id="flexCheckDefault" @if ($permissions->contains('ingresar productos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ingresar
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <h5>Servicios</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]" value="ver servicios"
                                    id="flexCheckDefault" @if ($permissions->contains('ver servicios')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ver
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    value="modificar servicios" id="flexCheckDefault"
                                    @if ($permissions->contains('modificar servicios')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Modificar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar servicios"
                                    id="flexCheckDefault" @if ($permissions->contains('eliminar servicios')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Eliminar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar servicios"
                                    id="flexCheckDefault" @if ($permissions->contains('ingresar servicios')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ingresar
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2 mt-3">
                        <div class="col">
                            <h5>Insumos Medicos</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    value="ver insumos medicos" id="flexCheckDefault"
                                    @if ($permissions->contains('ver insumos medicos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ver
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    value="modificar insumos medicos" id="flexCheckDefault"
                                    @if ($permissions->contains('modificar insumos medicos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Modificar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    value="eliminar insumos medicos" id="flexCheckDefault"
                                    @if ($permissions->contains('eliminar insumos medicos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Eliminar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    value="ingresar insumos medicos" id="flexCheckDefault"
                                    @if ($permissions->contains('ingresar insumos medicos')) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ingresar
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <input name="" id="btn-submit" class="btn btn-primary" type="submit"
                        value="Modificar Permisos" style="background-color:#19A448; border-color:#19A448;">
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
                    title: 'Modificar Permisos del Rol',
                    text: "¿Estás seguro de que quieres modificar los permisos?",
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
