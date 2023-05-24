@extends('layouts.panel_usuario')
<title>Administracion de Inventario - Veterinaria Gumiel</title>
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
        @import url('https://fonts.cdnfonts.com/css/k-o-d-e-39-hidden');

        .dataTables_filter,
        .dataTables_info {
            display: none;
        }

        .barcodeId {
            font-family: 'K-O-D-E-39 Hidden', sans-serif;
        }
    </style>
    <link href="https://fonts.cdnfonts.com/css/k-o-d-e-39-hidden" rel="stylesheet">
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Administracion de Inventario
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
            <li class="breadcrumb-item" aria-current="page" style="color:white;"><a href="{{ route('administracion_inventario.index') }}" style="color:black;">Administracion de Inventario </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Historial</li>
    </nav>
@endsection
@section('back-arrow')
    <a href="{{ route('administracion_inventario.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
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
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_productos['no_stock'] }} sin stock</p>
                @elseif ($cant_productos['low_stock'] > 0)
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_productos['low_stock'] }} sin stock</p>
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
                    <p class="fs-6 text fw-bold text-success">No hay medicinas en peligro de stock</p>
                @endif
            </div>
        </div>
    </div>
    <div class="card shadow p-4">
        <div class="btn-group align-self-center shadow" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-success active buttonChangeTable" id="allButton">Todo</button>
            <button type="button" class="btn btn-success buttonChangeTable" id="productosButton">Productos</button>
            <button type="button" class="btn btn-success buttonChangeTable" id="insumosButton">Insumos Medicos</button>
            <button type="button" class="btn btn-success buttonChangeTable" id="medicinasButton">Medicinas</button>
        </div>

        <div class="card-header">
            <h2 id="selected-table">Historial</h2>

        </div>
        <div class="card-body">
            <div class="spinner-border mb-3 align-items-center text-success" id="loading-table" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div id="tableDiv" class="display">
                <table class="table table-bordered dt-responsive nowrap" style="width:100%;" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre Item</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Accion</th>
                            <th scope="col">Stock a Agregar/Restar</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('inventario.administracion_stock.modal.viewProduct')
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
        var columns = [0, 1, 2, 3, 4, 5, 6];
        function setTable(table, value) {
            table = $("#table").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                "pageLength": 5,
                "lengthChange": false,
                responsive: true,
                serverSide: true,
                dom: 'Bfrtip',
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
                            className: 'btn  btn-secondary mb-2',
                            titleAttr: 'Copiar',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            titleAttr: 'Exportar a Excel',
                            className: 'btn  btn-success mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-csv"></i>',
                            titleAttr: 'Exportar a CSV',
                            className: 'btn  btn-info mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn btn-danger mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i style="color:white" class="fas fa-print"></i>',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-warning mb-2',
                            exportOptions: {
                                columns: columns
                            }
                        }
                    ]
                },
                ajax: {
                    url: "{{ route('administracion_inventario.historial') }}",
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
                        data: 'tipo_item',
                        name: 'tipo_item'
                    },
                    {
                        data: 'accion',
                        name: 'accion'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'nombre_proveedor',
                        name: 'nombre_proveedor'
                    },
                    {
                        data: 'costo',
                        name: 'costo'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
            });
        }
        var shownTable = "productosButton";
        $(document).ready(function() {
            var table = setTable(table, "all");
            $("#loading-table").addClass('d-none');
            $(".buttonChangeTable").on("click", function() {
                var getId = $(this).attr("id");
                shownTable = getId;
                $("#loading-table").removeClass('d-none');
                $("#productosButton").removeClass('active');
                $("#insumosButton").removeClass('active');
                $("#medicinasButton").removeClass('active');
                $("#allButton").removeClass('active');
                $(this).addClass('active');

                $("#tableDiv").addClass("d-none");
                $("#table").DataTable().destroy();

                switch (getId) {
                    case "productosButton":
                        table = setTable(table, "productos");
                        $("#selected-table").html('Historial: Productos');
                        break;
                    case "insumosButton":
                        table = setTable(table, "insumos");
                        $("#selected-table").html('Historial: Insumos Medicos');
                        break;
                    case "medicinasButton":
                        table = setTable(table, "medicinas");
                        $("#selected-table").html('Historial: Medicinas');
                        break;
                    case "allButton":
                        table = setTable(table, "all");
                        $("#selected-table").html('Historial');
                        break;
                }
                setTimeout(() => {
                    $("#loading-table").addClass('d-none');
                    $("#tableDiv").removeClass("d-none");
                }, 150);

                $('#myInput').val("");

            });
        });
        $('#myInput').on('keyup', function() {
            $('#table').dataTable().fnFilter(this.value);
        });

        function showProduct(id, tipo_item) {
            axios.get("{{ route('administracion_inventario.verItem') }}", {
                    params: {
                        id: id,
                        tipo: tipo_item,
                    }
                })
                .then(function(response) {
                    $("#descripcionDiv").removeClass("d-none");
                    $('#enfocadoDiv').removeClass("d-none");
                    $('#precioDiv').removeClass("d-none");
                    $("#imagen_item").removeClass("d-none");

                    $("#descripcionDiv").addClass("d-flex");
                    $('#precioDiv').addClass("d-flex");
                    $('#enfocadoDiv').addClass("d-flex");

                    $('#nombre').html(response.data
                        .itemGet['nombre']);
                    if (response.data.tipo_item == "producto") {
                        $("#descripcion").html(response.data.itemGet["descripcion"]);
                        $('#precio').html(new Intl.NumberFormat('es-CL', {
                            currency: 'CLP',
                            style: 'currency'
                        }).format(response.data.itemGet["precio"]));
                        $("#imagen_item").attr("src", "/image/productos/" + response.data.itemGet["imagen_path"])
                    } else {
                        $("#descripcionDiv").removeClass("d-flex");
                        $('#precioDiv').removeClass("d-flex");
                        $("#descripcionDiv").addClass("d-none");
                        $("#imagen_item").addClass("d-none");
                        $('#precioDiv').addClass("d-none");
                    }
                    $('#tipo').html(response.data.itemGet["id_tipo"]);
                    $('#marca').html(response.data.itemGet["id_marca"]);
                    if (response.data.tipo_item == "producto") {
                        $('#enfocado').html(response.data.itemGet["producto_enfocado"]);
                    } else if (response.data.tipo_item == "insumo") {
                        $('#enfocado').html(response.data.itemGet["medicamentos_enfocado"]);
                    } else {
                        $('#enfocadoDiv').removeClass("d-flex");
                        $('#enfocadoDiv').addClass("d-none");
                    }

                    $('#stock').html(response.data.itemGet["stock"]);

                })
                .catch(function(error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `No se pudo obtener informacion del producto`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
            setTimeout(() => {
                $('#viewProductModal').modal('show')
            }, 100);

        }
    </script>
@endsection
