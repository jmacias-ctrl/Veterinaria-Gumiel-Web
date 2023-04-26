@extends('layouts.layouts_users')
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container-sm p-5" style="background: white;">
        <div class="d-inline-flex">
            <a href="{{route('admin.roles.index')}}"> <span class="material-symbols-outlined" style="font-size:40px;">
                    arrow_back
                </span> </a>
            <h2 class="mx-5">Modificar Rol</h2>
        </div>
        <hr>
        <form action="{{ route('admin.roles.update') }}" method="POST" id="formRole">
            @csrf
            <div id="RoleWindow">
                <h5 class="mt-4">Informacion del Rol</h5>
                <input type="hidden" name="id" value="{{ $rol->id }}">
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Logistica"
                            aria-label="Nombre" value="{{ $rol->name }}" required>
                    </div>
                    <hr class="my-3">
                    <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Rol">
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
                var form = $(this).parents(form);
                $("#formRole").validate();
                e.preventDefault();

                Swal.fire({
                    title: 'Modificar    Rol',
                    text: "¿Estás seguro de que todos los datos estan correctos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Modificar',
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
