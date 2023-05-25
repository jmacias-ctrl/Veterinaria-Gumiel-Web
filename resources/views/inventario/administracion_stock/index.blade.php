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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Administracion de Inventario</li>
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
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_productos['no_stock'] }} sin stock</p>
                @elseif ($cant_productos['low_stock'] > 0)
                    <p class="fs-5 text fw-bold text-danger">{{ $cant_productos['low_stock'] }} sin stock</p>
                @else
                    <p class="fs-6 text fw-bold text-success">No hay productos en peligro de stock</p>
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
            <button type="button" class="btn btn-success active buttonChangeTable" id="productosButton">Productos</button>
            <button type="button" class="btn btn-success buttonChangeTable" id="insumosButton">Insumos Medicos</button>
            <button type="button" class="btn btn-success buttonChangeTable" id="medicinasButton">Medicinas</button>
        </div>

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-end">
                <h2 id="selected-table">Productos</h2>
                <div class="btn-group shadow mt-3" role="group" aria-label="Basic example">
                    <a id="historial" class="btn btn-outline-success btn-sm"
                        href="{{ route('administracion_inventario.historial') }}" role="button"><span
                            class="material-symbols-outlined">history</span></a>
                    <button id="barcodeScanner" class="btn btn-outline-success btn-sm" role="button"><span
                            class="material-symbols-outlined">barcode_scanner</span></button>
                    <a id="proveedoresBtn" class="btn btn-outline-success btn-sm" href="{{ route('proveedores.index') }}"
                        role="button"><span class="material-symbols-outlined">local_shipping</span></a>
                </div>
            </div>

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
                            <th scope="col">Nombre</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('inventario.administracion_stock.modal.adminProduct')
@include('inventario.administracion_stock.modal.viewProduct')
<!-- Modal -->
@section('js-after')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/barcodes/JsBarcode.code128.min.js"></script>
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
    @if (Session::has('successAdmin'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{Session::get("successAdmin")}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (Session::has('failed'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{Session::get("failed")}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
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
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    if (data['stock'] == '0') {
                        $(row).addClass('text-danger');
                    } else if (parseInt(data['stock']) < 10) {
                        $(row).addClass('text-warning');
                    }
                }
            });
        }
        var shownTable = "productosButton";
        $(document).ready(function() {

            var table = setTable(table, "productos");
            $("#loading-table").addClass('d-none');
            $(".buttonChangeTable").on("click", function() {
                var getId = $(this).attr("id");
                shownTable = getId;
                $("#loading-table").removeClass('d-none');
                $("#productosButton").removeClass('active');
                $("#insumosButton").removeClass('active');
                $("#medicinasButton").removeClass('active');
                $(this).addClass('active');

                $("#tableDiv").addClass("d-none");
                $("#table").DataTable().destroy();

                switch (getId) {
                    case "productosButton":
                        table = setTable(table, "productos");
                        $("#selected-table").html('Productos');
                        break;
                    case "insumosButton":
                        table = setTable(table, "insumos");
                        $("#selected-table").html('Insumos Medicos');
                        break;
                    case "medicinasButton":
                        table = setTable(table, "medicinas");
                        $("#selected-table").html('Medicinas');
                        break;
                }
                setTimeout(() => {
                    $("#loading-table").addClass('d-none');
                    $("#tableDiv").removeClass("d-none");
                }, 150);

                $('#myInput').val("");

            });
            $("#adminOption").on("change", function() {
                $("#nuevoProveedorDiv").addClass('d-none');

                $("#costoDiv").removeClass('d-none');
                $("#proveedorId").removeClass('d-none');
                $("#adjuntarFactura").removeClass('d-none');
                $("#checkStock").removeClass('d-none');
                $("#info").removeClass('d-none');

                $("#costoStockAgregado").prop('required', false);
                $("#proveedor").prop('required', false);
                $("#factura").prop('required', false);
                $("#nuevoProveedor").prop('required', false);

                var option = $(this).val();
                console.log(option);
                if (option == "Agregar") {
                    $("#checkStock").addClass('d-none');

                    $("#costoStockAgregado").prop('required', true);
                    $("#proveedor").prop('required', true);
                    $("#factura").prop('required', true);
                    var valueP = $("#proveedor").val();
                    if (valueP == "new") {
                        $("#nuevoProveedorDiv").removeClass('d-none');
                        $("#nuevoProveedor").prop('required', true);
                    } else {
                        $("#nuevoProveedorDiv").addClass('d-none');
                        $("#nuevoProveedor").prop('required', false);
                    }
                } else {
                    $("#costoDiv").addClass('d-none');
                    $("#proveedorId").addClass('d-none');
                    $("#adjuntarFactura").addClass('d-none');
                    console.log(shownTable);
                    if (shownTable != "productosButton") {
                        $("#checkStock").addClass('d-none');
                        $("#info").addClass('d-none');
                    }


                }
            });
            $("#proveedor").on("change", function() {
                var value = $("#proveedor").val();
                if (value == "new") {
                    $("#nuevoProveedorDiv").removeClass('d-none');
                    $("#nuevoProveedor").prop('required', true);
                } else {
                    $("#nuevoProveedorDiv").addClass('d-none');
                    $("#nuevoProveedor").prop('required', false);
                }
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
                    $("#barcode").JsBarcode(response.data
                        .itemGet['codigo']);
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

        function admin_product(id, tipo_item) {
            $("#newStock").val("");
            $("#costoStockAgregado").val("");
            $("#proveedor").val($("#proveedor option:first").val());
            $("#checkStockComprados").prop('checked', false);
            if (shownTable != "productosButton") {
                $("#checkStock").addClass('d-none');
                $("#info").addClass('d-none');
            }

            $("#factura").val("");
            $('#adminProductoModal').modal('show')

            axios.get("{{ route('administracion_inventario.verItem') }}", {
                    params: {
                        id: id,
                        tipo: tipo_item,
                    }
                })
                .then(function(response) {
                    $("#id_item").val(response.data.itemGet['id']);
                    $("#tipo_item").val(response.data.tipo_item);
                    $("#nombre_item").html(response.data.itemGet['nombre']);
                    $("#statusStock").html(response.data.itemGet['stock'] + " unidades");
                    if (parseInt(response.data.itemGet['stock']) <= 0) {
                        $("#statusStock").addClass('text-danger');
                    } else {
                        $("#statusStock").removeClass('text-danger');
                    }
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
        }
    </script>
@endsection
