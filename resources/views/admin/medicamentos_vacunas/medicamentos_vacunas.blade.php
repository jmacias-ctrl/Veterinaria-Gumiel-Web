@extends('layouts.panel_usuario')
<title>Gestión Medicamentos - Veterinaria Gumiel</title>
@section('css-after')
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
    Gestión de Medicamentos
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Medicamentos</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <div class="card-header border-0 p-0 mb-4">
                    <div class="d-flex justify-content-between">
                        <h1>Listado de Medicamentos</h1>
                        @can('ingresar medicamentos vacunas')
                            <a class="btn btn-primary ms-5" href="{{ route('admin.medicamentos_vacunas.create') }}"
                                style="background-color:#19A448; border-color:#19A448;" role="button">Agregar</a>
                        @endcan
                    </div>
                </div>
                <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Medicamentos Enfocados</th>
                            <th scope="col">Mililitros</th>
                            <th scope="col">Gramos</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>
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
    <script>
        $(document).ready(function() {
            let columns = [0, 1, 2, 3, 4, 5, 6];
            var table = $("#table").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                dom: 'Bfrtip',
                responsive: true,
                "language": {
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron datos",
                    "infoEmpty": "No hay datos para mostrar",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    },
                },
                buttons: {
                    buttons: [{
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-copy"></i>',
                            className: 'btn btn-outline-light mb-2',
                            titleAttr: 'Copiar',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            titleAttr: 'Exportar a Excel',
                            className: 'btn btn-outline-success mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-csv"></i>',
                            titleAttr: 'Exportar a CSV',
                            className: 'btn  btn-outline-info mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn btn-outline-danger mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i style="color:orange" class="fas fa-print"></i>',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-outline-warning mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        }
                    ]
                },
                ajax: {
                    url: "{{ route('admin.medicamentos_vacunas.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'codigo',
                        name: 'codigo'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'id_marca',
                        name: 'id_marca'
                    },
                    {
                        data: 'id_tipo',
                        name: 'id_tipo'
                    },
                    {
                        data: 'medicamentos_enfocados',
                        name: 'medicamentos_enfocados'
                    },
                    {
                        data: 'mililitros',
                        name: 'mililitros'
                    },
                    {
                        data: 'gramos',
                        name: 'gramos'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });
            $('#myInput').on('keyup', function() {
                $('#table').dataTable().fnFilter(this.value);
            });
        });

        function deleted(id_get) {

            Swal.fire({
                title: '¿Eliminar Medicamento?',
                text: "¿Estás seguro? ¡no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'

            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('admin.medicamentos_vacunas.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('¡Medicamento eliminado correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Medicamento eliminado correctamente!',
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
