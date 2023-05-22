@extends('layouts.panel_usuario')
<title>Administracion de Stock - Veterinaria Gumiel</title>
@section('css-after')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .swal2-container {
            z-index: 10000;
        }
    </style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
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
    Administracion de Stock
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                @if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('admin') }}" style="color:black;">
                    @elseif(auth()->user()->hasRole('Veterinario'))
                        <a href="{{ route('veterinario') }}" style="color:black;">
                        @elseif (auth()->user()->hasRole('Peluquero'))
                            <a href="{{ route('peluquero') }}" style="color:black;">
                            @elseif (auth()->user()->hasRole('Inventario'))
                                <a href="{{ route('inventario') }}" style="color:black;">
                @endif
                Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Administracion de Stock</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}
    <div class="row justify-content-center align-items-center g-2 m-4">
        <div class="col col-sm">
            <div class="card shadow p-4 align-items-center justify-content-center">
                <div class="d-flex">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <h3 class="text-center mx-2">Productos</h3>
                </div>
                @if ($cant_productos['no_stock'] > 0)
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_insumos_medicos['no_stock'] }} sin stock</p>
                @elseif ($cant_productos['low_stock'] > 0)
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_insumos_medicos['low_stock'] }} sin stock</p>
                @else
                    <p class="fs-5 text fw-bold text-success">No hay productos en peligro de stock</p>
                @endif
            </div>
        </div>
        <div class="col col-sm">
            <div class="card shadow p-4 align-items-center justify-content-center">
                <div class="d-flex">
                    <span class="material-symbols-outlined">admin_meds</span>
                    <h3 class="text-center mx-2">Insumos Medicos</h3>
                </div>
                @if ($cant_insumos_medicos['no_stock'] > 0)
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_insumos_medicos['no_stock'] }} sin stock</p>
                @else
                    <p class="fs-6 text fw-bold text-success">No hay insumos medicos en peligro de stock</p>
                @endif
            </div>
        </div>
        <div class="col col-sm">
            <div class="card shadow p-4 align-items-center justify-content-center">
                <div class="d-flex">
                    <span class="material-symbols-outlined">vaccines</span>
                    <h3 class="text-center mx-2">Medicinas</h3>
                </div>
                @if ($cant_medicinas['no_stock'] > 0)
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_medicinas['no_stock'] }} sin stock</p>
                @else
                    <p class="fs-6 text fw-bold text-success">No hay insumos medicos en peligro de stock</p>
                @endif
            </div>
        </div>
    </div>
    <div class="card shadow p-4">
        <div class="btn-group align-self-center shadow" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-success active buttonChangeTable" id="productosButton">Productos</button>
            <button type="button" class="btn btn-success buttonChangeTable" id="insumosButton">Insumos Medicos</button>
            <button type="button" class="btn btn-success buttonChangeTable" id="medicinasButton">Medicinas</button>
        </div>
        <div class="card-header">
            <h2 id="selected-table">Productos</h2>
        </div>
        <div class="card-body">
            <table class="table  table-bordered dt-responsive nowrap" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Stock</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


<!-- Modal -->
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
        function setTable(table, value) {
            table = $("#table").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                "pageLength": 5,
                "lengthChange": false,
                responsive: true,
                serverSide: true,
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
                ajax: {
                    url: "{{ route('administracion_inventario.index') }}",
                    type: 'GET',
                    data: {
                        'value': value,
                    },
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
                        data: 'stock',
                        name: 'stock'
                    },
                ]
            });
        }
        $(document).ready(function() {
            var table = setTable(table, "productos");
            $(".buttonChangeTable").on("click", function() {
                var getId = $(this).attr("id");
                $("#productosButton").removeClass('active');
                $("#insumosButton").removeClass('active');
                $("#medicinasButton").removeClass('active');
                $(this).addClass('active');
                switch (getId) {
                    case "productosButton":
                        $("#table").addClass("d-none");
                        $("#table").DataTable().destroy();
                        table = setTable(table, "productos");
                        $("#selected-table").html('Productos');
                        $("#table").removeClass("d-none");
                        break;
                    case "insumosButton":
                        $("#table").addClass("d-none");
                        $("#table").DataTable().destroy();
                        table = setTable(table, "insumos");
                        $("#selected-table").html('Insumos Medicos');
                        $("#table").removeClass("d-none");
                        break;
                    case "medicinasButton":
                        $("#table").addClass("d-none");
                        $("#table").DataTable().destroy();
                        table = setTable(table, "medicinas");
                        $("#selected-table").html('Medicinas');
                        $("#table").removeClass("d-none");
                        break;
                }
            });
        });
    </script>
@endsection
