@extends('layouts.app')
<title>Gestion Usuarios - Administrador</title>
@section('css-before')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col">
                            <h4 class="card-title mb-3">Gestion de Usuarios</h4>
                        </div>
                        <div class="col text-right">
                            <a class="btn btn-primary mr-auto" href="{{ route('admin.usuarios.add') }}" role="button">Ingresar
                                Usuario</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="datatable display responsive nowrap table table-sm table-bordered table-hover table-striped w-100 shadow-sm"
                            id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Rut</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th>{{ $user->id }}</th>
                                        <th>{{ $user->name }}</th>
                                        <th>{{ $user->rut }}</th>
                                        <th>{{ $user->email }}</th>
                                        <th>{{ $user->phone }}</th>
                                        <th>
                                            @foreach ($user->nombre_rol as $rol)
                                                {{ $rol }}
                                                <br>
                                            @endforeach
                                        </th>
                                        <th><button type="button" class="btn btn-danger"
                                                onclick="deleted({{ $user->id }})"><span
                                                    class="material-symbols-outlined">delete</span></button>
                                            <a id="modifyRoles" class="btn btn-primary"
                                                href="{{ route('admin.usuarios.roles', ['id' => "$user->id"]) }}"
                                                role="button"><span
                                                    class="material-symbols-outlined">manage_accounts</span></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                pageLength: 10,
            });
        });

        function deleted(id_get) {

            Swal.fire({
                title: '¿Eliminar usuario?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('admin.usuarios.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('Usuario eliminada correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario eliminado correctamente!',
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