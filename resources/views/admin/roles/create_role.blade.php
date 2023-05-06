@extends('layouts.layouts_users')
<title>Crear Rol - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container-xl p-5 border" style="background: white;">
        <div class="container-sm">
            <div class="d-inline-flex">
                <a href="{{route('admin.roles.index')}}"> <span class="material-symbols-outlined" style="font-size:40px;">
                        arrow_back
                    </span> </a>
                <h2 class="mx-5">Ingresar Nuevo Rol</h2>
            </div>
            <hr>
            <form action="{{ route('admin.roles.store') }}" method="POST" class="needs-validation">
                @csrf

                <div id="RoleWindow">
                    <h5 class="mt-4">Informacion del Rol</h5>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre"
                                class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Logistica"
                                aria-label="Nombre" required>
                            @error('nombre')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <hr class="my-3">
                        <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Rol" style="background-color:#19A448; border-color:#19A448;">
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
                    title: 'Agregar Nuevo Rol',
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
