@extends('layouts.panel_usuario')
<title>Gestión Tipo Medicamentos </title>
@section('css-before')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dataTables_filter,
        .dataTables_info {
            display: none;
        }
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Gestión de Tipo de Medicamentos
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Tipo Medicamentos</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <div class="card-header border-0 p-0 mb-4">
                    <div class="d-flex justify-content-between">
                        <h1>Listado de Tipo de Medicamentos</h1>
                        @can('ingresar medicamentos vacunas')
                            <a class="btn btn-primary ms-5 boton-aceptar"
                                href="{{ route('admin.tipomedicamentos_vacunas.create') }}"
                                style="background-color:#19A448; border-color:#19A448;" role="button">Crear</a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table
                        class="datatable display responsive nowrap table-sm table table-hover table-striped table-bordered w-100 shadow-sm"
                        id="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-after')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                responsive: true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ tipos por página",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron datos",
                    "infoEmpty": "No hay datos para mostrar",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    },
                },
                ajax: {
                    url: "{{ route('admin.tipomedicamentos_vacunas.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
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
                title: '¿Eliminar tipo de medicamento?',
                text: "¿Estás seguro? ¡no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('admin.tipomedicamentos_vacunas.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('¡Tipo de medicamento eliminado correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Tipo de medicamento eliminado correctamente!',
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
