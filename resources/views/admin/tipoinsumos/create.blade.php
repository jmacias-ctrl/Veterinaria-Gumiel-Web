@extends('layouts.app')
<title>Ingresar Tipo de Insumo</title>
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
    <div class="container-sm">
        <h2>Ingresar Nuevo Insumo Medico</h2>
        <hr>
        <form action="{{ route('admin.tipoinsumos.store') }}" method="POST">
            @csrf
            <div class="container">
                <h5 class="mt-4">Informacion del Insumo</h5>
                <div class="row mt-3">
                    <div class="col">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input minlength="4" type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Algodon"
                            aria-label="Nombre" required>
                    </div>
                <br>
                <div class="row">
                    <div class="col">
                        <br>
                        <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Rol">
                    </div>
                </div>
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
                    title: 'Agregar Nuevo Tipo de Tnsumo',
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