@extends('layouts.layouts_users')
<title>Servicio </title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-5">
                <h4>Servicio</h4>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-5">
                <a class="btn btn-primary ms-5" href="{{ route('admin.servicio.create') }}" role="button">Agregar Servicio
                    </a>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table
                class="datatable display responsive nowrap table-sm table table-hover table-striped table-bordered w-100 shadow-sm"
                id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $servicio)
                        <tr>
                            <th>{{ $servicio->id }}</th>
                            <th>{{ $servicio->nombre }}</th>
                            <th>{{ $servicio->precio }}</th>
                            <th>
                                @foreach ($servicio->tipo as $tiposervicios)
                                    {{ $tiposervicios }}
                                    <br>
                                @endforeach
                            
                                <button type="button" class="btn btn-danger" onclick="deleted({{ $servicio->id }})"><span
                                        class="material-symbols-outlined">delete</span></button>
                                <a id="editInsumos" class="btn btn-primary"
                                    href="{{ route('admin.servicio.edit', ['id' => "$servicio->id"]) }}"
                                    role="button"><span class="material-symbols-outlined">edit</span></a>

                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js-after')
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script>
        $(document).ready(function() {
            var table = $("#table").DataTable({
                responsive: true,
                processing: true,
                searching: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                },
                pageLength: 10,
            });
        });
        function deleted(id_get) {
            Swal.fire({
                title: '¿Eliminar servicios?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            })
        }
    </script>
@endsection
