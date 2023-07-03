@extends('layouts.panel_usuario')
<title>Pedidos Online - Veterinaria Gumiel</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
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
    Pedidos Online
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Pedidos Online</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <div class="card-header border-0 p-0 mb-4">
                    <div class="d-flex justify-content-between">
                        <h1>Pedidos Online</h1>
                    </div>
                </div>
                @if (session()->get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Num. Venta</th>
                            <th>Nombre Cliente</th>
                            <th>Rut Cliente</th>
                            <th>Correo Cliente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('inventario.ventas.modal.detalleVenta')
@section('js-after')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
    <script>
        $(document).ready(function() { 
            var table = $("#table").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                searching: true,
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
                ajax: {
                    url: "{{ route('pedidos_online.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id_venta',
                        name: 'id_venta'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'rut',
                        name: 'rut'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'hora',
                        name: 'hora'
                    },
                    {
                        data: 'estado',
                        name: 'estado'
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
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });

        function verDetalle(id) {
            axios.get("{{ route('ventas.detalle') }}", {
                    params: {
                        id: id,
                    }
                })
                .then(function(response) {
                    $('#numVenta').html('Num. venta: ' + response.data
                        .venta['id_venta']);
                    $('#fecha').html('Fecha: ' + response.data.venta['fecha']);
                    $('#hora').html('Hora: ' + response.data.venta['hora']);
                    $('#nombreClienteShow').html('Nombre del Cliente: ' + response.data
                        .venta['nombre_cliente']);
                    $('#metodoPagoShow').html('Metodo de Pago: ' + response.data
                        .venta['metodo_pago']);
                    $('#totalVentaShow').html('Total de la Venta: ' + new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(response.data.montoFinal));
                    $('#productosVendidos').empty();
                    $("#efectivo").removeClass('d-none');
                    $("#vuelto").removeClass('d-none');
                    $("#id_operacion").removeClass('d-none');
                    $("#Banco").removeClass('d-none');

                    if (response.data.venta['metodo_pago'] == "efectivo") {
                        $("#id_operacion").addClass('d-none');
                        $("#Banco").addClass('d-none');
                        $("#efectivo").html('Efectivo Dado: ' + new Intl.NumberFormat('es-CL', {
                            currency: 'CLP',
                            style: 'currency'
                        }).format(response.data.detalle_metodo['efectivo']))
                        $("#vuelto").html('Vuelto: ' + new Intl.NumberFormat('es-CL', {
                            currency: 'CLP',
                            style: 'currency'
                        }).format(response.data.detalle_metodo['vuelto']))
                    } else if (response.data.venta['metodo_pago'] == "tarjeta") {
                        $("#efectivo").addClass('d-none');
                        $("#vuelto").addClass('d-none');
                        $("#id_operacion").html('Num Operacion: ' + response.data.detalle_metodo['num_operacion'])
                    } else if(response.data.venta['metodo_pago']=="transferencia"){
                        $("#efectivo").addClass('d-none');
                        $("#vuelto").addClass('d-none');
                        $("#id_operacion").html('Num Operacion: ' + response.data.detalle_metodo['num_operacion'])
                        $("#Banco").html('Banco: ' + response.data.detalle_metodo['banco'])
                    }else{
                        $("#efectivo").addClass('d-none');
                        $("#vuelto").addClass('d-none');
                        $("#id_operacion").addClass('d-none')
                        $("#Banco").addClass('d-none')
                    }
                    $.map(response.data.itemsComprado, function(elementOrValue,
                        indexOrKey) {
                        var productMoney = new Intl.NumberFormat('es-CL', {
                            currency: 'CLP',
                            style: 'currency'
                        }).format(elementOrValue.monto)
                        var total = elementOrValue.monto * elementOrValue.cantidad;
                        var TotalFormat = new Intl.NumberFormat('es-CL', {
                            currency: 'CLP',
                            style: 'currency'
                        }).format(total)
                        $("#productosVendidos").append(`
            
                                    <tr> 
                                        
                                        <th> ${indexOrKey}</th>                     
                                        <td class="text-wrap">${elementOrValue.nombre}</td>
                                        <th>${elementOrValue.cantidad}</th>
                                        <td>${productMoney}</td>
                                        <td>${TotalFormat}</td>
                                    </tr>
                                
                            
                                    
                                `);



                    });

                    $('#detalleVenta').modal('show')
                    console.log(response);
                })
                .catch(function(error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `No se pudo recuperar el detalle de la venta`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(error);
                });
        }
    </script>
@endsection
