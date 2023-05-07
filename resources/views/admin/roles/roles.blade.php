@extends('layouts.panel_usuario')
<title>Gestion Roles - Veterinaria Gumiel</title>
@section('css-after')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Gestion de Roles
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Roles</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1>Listado de Roles</h1>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-primary mr-auto" href="{{ route('admin.roles.add') }}" role="button"
                            style="background-color:#19A448; border-color:#19A448;">Ingresar
                            Rol</a>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="table-responsive">
                    <table
                        class="datatable display responsive nowrap table table-sm table-bordered table-hover table-striped shadow-sm"
                        id="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js-after')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        @if (Session::has('success'))
            <script>
                toastr.success("{{ Session::get('success') }}");
            </script>
        @endif
        @if (Session::has('error'))
            <script>
                toastr.error("{{ Session::get('error') }}");
            </script>
        @endif
        <script>
            $(document).ready(function() {
                var table = $("#table").DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                    },
                    pageLength: 10,
                    ajax: {
                        url: "{{ route('admin.roles.index') }}",
                        type: 'GET',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    ]
                });
            });

            function deleted(id_get) {

                Swal.fire({
                    title: '¿Eliminar Rol?',
                    text: "¿Estás seguro? no podrás revertir la acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (result.isConfirmed) {
                        axios.post("{{ route('admin.roles.delete') }}", {
                                id: id_get
                            })
                            .then(function(response) {

                                toastr.success('Rol eliminado correctamente!');

                            })
                            .catch(function(error) {
                                toastr.error('La acción no se pudo realizar');
                            })
                            .finally(function() {
                                $('#table').DataTable().ajax.reload();

                            });
                    }
                });

            }
        </script>
    @endsection
