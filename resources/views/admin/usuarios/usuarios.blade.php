@extends('layouts.app')
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <a class="btn btn-primary" href="#" role="button">Añadir Usuario</a>
    <div class="table-responsive">
        <table class="display" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Correo</th>
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
                        <th><button type="button" class="btn btn-danger"
                                onclick="deleted({{ $user->id }})">Delete</button></th>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
@section('js-after')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            setTimeout(() => { location.reload(); }, 1500);
                            
                        });
                }
            });

        }
    </script>
@endsection
