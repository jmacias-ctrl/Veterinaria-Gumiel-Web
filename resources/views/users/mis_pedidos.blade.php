@extends('layouts.app')
<title>Mis Pedidos - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="form-row">
        @include('layouts.panel_cliente')
        <div class="col-md-9 mt-3">
            <div class="card shadow me-3">
                <div class="card-header border-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Mis Pedidos</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap mt-2" style="width:100%;"
                        id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Num. Orden</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@include('users.modal.mi_pedido')
@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $("#table").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                responsive: true,
                "language": {
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron pedidos",
                    "infoEmpty": "No hay pedidos para mostrar",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    },
                    "lengthMenu": "Mostrando _MENU_ pedidos",
                },
                ajax: {
                    url: "{{ route('mis-pedidos') }}",
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
                        data: 'monto',
                        name: 'monto'
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

        function verDetalle(id) {
            axios.get("{{ route('ver-pedido') }}", {
                    params: {
                        id: id,
                    }
                })
                .then(function(response) {
                    $("#detalleTable").DataTable().destroy();
                    $('#numVenta').html('Num. venta: ' + response.data
                        .venta['id_venta']);
                    $('#fecha').html('Fecha: ' + response.data.venta['fecha']);
                    $('#hora').html('Hora: ' + response.data.venta['hora']);
                    $('#totalVentaShow').html('Total de la Venta: ' + new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(response.data.montoFinal));
                    $('#productosVendidos').empty();
                    $("#efectivo").removeClass('d-none');
                    $("#vuelto").removeClass('d-none');
                    $("#id_operacion").removeClass('d-none');
                    $("#Banco").removeClass('d-none');
                    $('#metodoPagoShow').html('Metodo de Pago: Online')
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
                    $("#detalleTable").DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                        },
                        responsive: true,
                        "paging": false,
                        "searching": false,
                        "bInfo": false,
                        "language": {
                            "search": "Buscar:",
                            "zeroRecords": "No se encontraron productos",
                            "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                            "paginate": {
                                "previous": "<",
                                "next": ">",
                            },
                            "lengthMenu": "Mostrando _MENU_ pedidos",
                        },
                    });
                    $('#detalleVenta').modal('show')
                })
                .catch(function(error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `No se pudo recuperar el detalle de la venta`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
        }
    </script>
@endsection
