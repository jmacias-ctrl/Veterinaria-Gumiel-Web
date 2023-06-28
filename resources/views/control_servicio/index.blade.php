@extends('layouts.panel_usuario')
<title>Punto de Pago Servicios - Veterinaria Gumiel</title>
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

        .swal2-container {
            z-index: 10000;
        }
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Punto de Reserva/Pagos de Servicios
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Ventas</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <div class="card-header border-0 p-0 mb-4">
                    <div class="d-flex justify-content-between">
                        <h1>Punto de Reserva/Pago de Servicios</h1>
                        <a class="btn btn-success" href="{{route('control_servicios.agendar')}}" role="button" style="height:45px">Agendar Cita</a>
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
                            <th>Nombre Cliente</th>
                            <th>Rut Cliente</th>
                            <th>Servicio</th>
                            <th>Nombre Funcionario</th>
                            <th>Estado</th>
                            <th>Monto</th>
                            <th>¿Pagado?</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('control_servicio.modal.pagoVenta_Modal')
@include('control_servicio.modal.comprobante')
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
        function prepararPago(id, monto) {
            let montoPagar = new Intl.NumberFormat('es-CL', {
                currency: 'CLP',
                style: 'currency'
            }).format(monto);
            $('#monto').val(monto);
            $('#id').val(id);
            $('#totalPagarModal').html('Total: ' + montoPagar);
            $('#pagoVenta').modal('toggle');
        }
        $(document).ready(function() {
            var table = $("#table").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },

                searching: true,
                responsive: true,
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ reservas por pagina",
                    "zeroRecords": "No se encontraron reservas sin pagar",
                    "infoEmpty": "No hay datos para mostrar",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    },
                },
                ajax: {
                    url: "{{ route('control_servicios.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'funcionario_id',
                        name: 'funcionario_id'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'precio',
                        name: 'precio'
                    },
                    {
                        data: 'pagado',
                        name: 'pagado'
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
            $('#metodoPagoForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).parents(form);
                var efectivo = $('#montoEfectivo').val();
                var total = $('#monto').val();
                var metodoPago = $('#metodoPago').val();
                var nombreCliente = $('#nombreCliente').val();
                var numOperacion = $('#numOperacion').val();
                var banco = $('#banco').val();
                var id_reserva = $('#id').val();
                if (metodoPago == 'efectivo' && efectivo < total) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `Cantidad de efectivo ofrecido es menor que el total`,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                }
                Swal.fire({
                    title: '¿Realizar Pago?',
                    text: "¿Estás seguro que los datos estan correctos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Realizar Venta',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (result.isConfirmed) {
                        console.log(efectivo);
                        console.log(nombreCliente);
                        console.log(banco);
                        console.log(numOperacion);
                        axios.post("{{ route('control_servicios.pagar') }}", {
                                id: id_reserva,
                                metodoPago: metodoPago,
                                banco: banco,
                                montoEfectivo: efectivo,
                                vuelto: vuelto,
                                nombreCliente: nombreCliente,
                                numOperacion: numOperacion,
                            })
                            .then(function(response) {
                                $('#pagoVenta').modal('hide')
                                $('#ventaId').val(response.data.ventaId);
                                toastr.success('Venta realizada exitosamente')
                                $('#numVenta').html('Num. venta: ' + response.data
                                    .nuevaVenta['id_venta']);
                                $('#fecha').html('Fecha: ' + response.data.fecha);
                                $('#hora').html('Hora: ' + response.data.hora);
                                $('#nombreClienteShow').html('Nombre del Cliente: ' + response
                                    .data
                                    .nuevaVenta['nombre_cliente']);
                                $('#metodoPagoShow').html('Metodo de Pago: ' + response.data
                                    .metodoPago);
                                $('#totalVentaShow').html('Total de la Venta: ' + new Intl
                                    .NumberFormat('es-CL', {
                                        currency: 'CLP',
                                        style: 'currency'
                                    }).format(response.data.montoFinal));
                                $('#servicioPagado').empty();
                                var productMoney = new Intl.NumberFormat('es-CL', {
                                    currency: 'CLP',
                                    style: 'currency'
                                }).format(response.data.servicioPagado["price"])
                                var total = response.data.servicioPagado["price"] * response
                                    .data.servicioPagado["quantity"];
                                var TotalFormat = new Intl.NumberFormat('es-CL', {
                                    currency: 'CLP',
                                    style: 'currency'
                                }).format(total)
                                $("#productosVendidos").append(`
            
                                    <tr> 
                                        
                                        <th> 1 </th>                     
                                        <td class="text-wrap">${response.data.servicioPagado["name"]}</td>
                                        <th>${response.data.servicioPagado["quantity"]}</th>
                                        <td>${productMoney}</td>
                                        <td>${TotalFormat}</td>
                                    </tr>
                                
                            
                                    
                                `);

                                setTimeout(() => {
                                    $('#comprobanteModal').modal('show')
                                }, 500);
                                console.log(response);
                            })
                            .catch(function(error) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: `No se pudo realizar la venta`,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                console.log(error);
                            });
                    }
                });
            });
        });
        $('#montoEfectivo').on('change', function() {
            let efectivo = $('#montoEfectivo').val();
            let monto = $('#monto').val();
            let calc = efectivo - monto
            let vuelto = new Intl.NumberFormat('es-CL', {
                currency: 'CLP',
                style: 'currency'
            }).format(calc);
            if (calc > 0) {
                $('#vueltoHtml').html('Vuelto: ' + vuelto);
                $('#vuelto').val(vuelto);
            } else {
                $('#vueltoHtml').html('Vuelto: $0');
                $('#vuelto').val(vuelto);
            }
        });

        function cambioMetodoPago() {
            let metodoPago = $('#metodoPago').val();
            $('#montoEfectivo').prop('required', false);

            $('#banco').prop('required', false);

            $('#numOperacion').prop('required', false);

            $('#numOperacionDiv').removeClass('d-none')
            $('#bancoDiv').removeClass('d-none')
            $('#montoEfectivoDiv').removeClass('d-none')
            $('#vuelto').removeClass('d-none')

            $('#numOperacionDiv').addClass('d-none')
            $('#bancoDiv').addClass('d-none')
            $('#montoEfectivoDiv').addClass('d-none')
            $('#vuelto').addClass('d-none')

            if (metodoPago == "efectivo") {
                $('#montoEfectivoDiv').removeClass('d-none');
                $('#vuelto').removeClass('d-none');
                $('#montoEfectivo').prop('required', true);
            } else if (metodoPago == "transferencia") {
                $('#bancoDiv').removeClass('d-none');
                $('#numOperacionDiv').removeClass('d-none');
                $('#banco').prop('required', true);
                $('#numOperacion').prop('required', true);
            } else {
                $('#numOperacionDiv').removeClass('d-none');
                $('#numOperacion').prop('required', true);
            }
        }
    </script>
@endsection
