@extends('layouts.layouts_users')
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
        <h3>Ingresar insumos medicos</h3>
        <hr>
        <form action="{{ route('admin.insumos_medicos.store') }}" method="POST">
            @csrf
            <div id="RoleWindow">
                <h5 class="mt-4">Informacion Personal</h5>
                <div class="row mt-3">
                    <div class="col">
                        <label for="nombre" class="form-label">Nombre insumo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Agujas"
                            aria-label="Nombre" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca"
                            placeholder="Ej. Novamed" required>
                    </div>
                </div>
                <hr class="mt-4">
                <h5 class="mt-4">Tipos de Insumos Medicos</h5>
                <div class="row justify-content-center align-items-center g-2">
                    @foreach ($tipoinsumos as $tipos)
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoinsumos" value="{{ $tipos->id }}">
                                <label class="form-check-label" for="">
                                    {{ $tipos->nombre }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="integer" class="form-control" id="stock" name="stock"
                            placeholder="ej. 21" maxlength="11" minlength="1">
                    </div>
                </div>

                <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Usuario">
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
                    title: 'Agregar Nuevo Insumo Medico',
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