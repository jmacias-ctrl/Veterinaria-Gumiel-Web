@extends('layouts.layouts_users')
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
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container-sm">
        <h2>Modificar Roles Usuarios</h2>
        <hr>
        <form action="{{ route('admin.role.update.permissions') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $role->id }}">
            <div id="RoleWindow">
                <h4>Rol: {{ $role->name }}</h4>
                <hr>
                <h5 class="my-4">Permisos</h5>
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
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar productos"
                                id="flexCheckDefault" @if ($permissions->contains('modificar productos')) checked @endif>
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
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar servicios"
                                id="flexCheckDefault" @if ($permissions->contains('modificar servicios')) checked @endif>
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
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver insumos medicos"
                                id="flexCheckDefault" @if ($permissions->contains('ver insumos medicos')) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Ver
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar insumos medicos"
                                id="flexCheckDefault" @if ($permissions->contains('modificar insumos medicos')) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Modificar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar insumos medicos"
                                id="flexCheckDefault" @if ($permissions->contains('eliminar insumos medicos')) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Eliminar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar insumos medicos"
                                id="flexCheckDefault" @if ($permissions->contains('ingresar insumos medicos')) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Ingresar
                            </label>
                        </div>
                    </div>
                </div>
                <hr>

                <input name="" id="btn-submit" class="btn btn-primary" type="submit" value="Modificar Permisos">
            </div>
        </form>
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