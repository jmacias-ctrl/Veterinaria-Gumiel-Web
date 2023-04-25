@extends('layouts.layouts_users')
<title>Gestion Insumos médicos</title>
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
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="text-decoration:none;">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Insumos Medicos</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h4>Gestion de Insumos Medicos</h4>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a class="btn btn-primary ms-5" href="{{ route('admin.tipoinsumos.index') }}"
                style="background-color:#2E7646; border-color:#2E7646;" role="button">Tipo insumos</a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a class="btn btn-primary ms-5" href="{{ route('admin.marcaInsumos.index') }}"
                style="background-color:#2E7646; border-color:#2E7646;" role="button">Marca insumos</a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a class="btn btn-primary ms-5" href="{{ route('admin.insumos_medicos.create') }}"
                style="background-color:#19A448; border-color:#19A448;" role="button">Agregar insumo</a>
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
                    <th scope="col">Marca</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insumos_medicos as $insumos)
                    <tr>
                        <th>{{ $insumos->id }}</th>
                        <th>{{ $insumos->nombre }}</th>
                        <th>{{ $insumos->marca }}</th>
                        <th>{{ $insumos->Tipoinsumos->nombre }}</th>
                        <th>{{ $insumos->stock }}</th>
                        <th><button type="button" class="btn btn-danger" onclick="deleted({{ $insumos->id }})"><span
                                    class="material-symbols-outlined">delete</span></button>
                            <a id="editInsumos" style="background-color:#F7C044; border-color:#F7C044;"
                                class="btn btn-primary"
                                href="{{ route('admin.insumos_medicos.edit', ['id' => "$insumos->id"]) }}"
                                role="button"><span class="material-symbols-outlined">manage_accounts</span></a>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
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
                title: '¿Eliminar Insumo medico?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'

            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('admin.insumos_medicos.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('Insumo medico eliminado correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Insumo medico eliminado correctamente!',
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
