@extends('layouts.layouts_users')
<title>Gestion Usuarios - Administrador</title>
@section('css-before')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="breadcrumb mb-1 mx-2 opacity-50">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="text-decoration:none;">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>
    </div>
    <h1>Gestion Roles</h1>
    <hr>
    <div class="d-flex justify-content-between mb-3">
        <div class="col">
            <a class="btn btn-primary mr-auto" href="{{ route('admin.roles.add') }}" role="button">Ingresar
                Rol</a>
        </div>
    </div>

    @if (session()->get('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="datatable display responsive nowrap table table-sm table-bordered table-hover table-striped shadow-sm"
            id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $rol)
                    <tr>
                        <th>{{ $rol->id }}</th>
                        <td>{{ $rol->name }}</td>
                        <td><button type="button" class="btn btn-danger" onclick="deleted({{ $rol->id }})"><span
                                    class="material-symbols-outlined">delete</span></button>
                            <a id="modifyRoles" class="btn btn-warning"
                                href="{{ route('admin.roles.modify', ['id' => "$rol->id"]) }}" role="button"><span
                                    class="material-symbols-outlined">edit</span></a>
                            <a id="EditPermissions" class="btn btn-primary"
                                href="{{ route('admin.roles.permission', ['id' => "$rol->id"]) }}" role="button"><span
                                    class="material-symbols-outlined">settings</span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

                            toastr.success('Rol eliminado correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Rol eliminado correctamente!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(() => {
                                location.reload();
                            }, 1500);

                        });
                }
            });

        }
    </script>
@endsection
