@extends('layouts.app')
<title>Gestion Tipo Insumos médicos</title>
@section('css-before')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-5">
                <h4>Gestion de Tipos de Insumos Medicos</h4>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-5">
                <a class="btn btn-primary ms-5" href="{{ route('admin.tipoinsumos.create') }}" role="button">Agregar tipo de insumo</a>  
            </div>
        </div>
        <br>
        <div class="row table-responsive">
            <table class="datatable display responsive nowrap table-sm table table-hover table-striped table-bordered w-100 shadow-sm" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoinsumos as $tipos)
                    <tr>
                        <th>{{ $tipos->id }}</th>
                        <th>{{ $tipos->nombre }}</th>
                        <th><button type="button" class="btn btn-danger"
                                                onclick="deleted({{ $tipos->id }})"><span
                                                    class="material-symbols-outlined">delete</span></button>
                                            <a id="editTipos" class="btn btn-primary"
                                                href="{{ route('admin.tipoinsumos.edit', ['id' => "$tipos->id"]) }}"
                                                role="button"><span
                                                    class="material-symbols-outlined">manage_accounts</span></a>
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
                pageLength: 10,
            });
        });

        function deleted(id_get) {

            Swal.fire({
                title: '¿Eliminar tipo de insumo?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('admin.tipoinsumos.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('Tipo de insumo eliminado correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Tipo de insumo eliminado correctamente!',
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
         