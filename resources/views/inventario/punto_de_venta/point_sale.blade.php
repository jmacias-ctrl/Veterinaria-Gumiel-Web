@extends('layouts.panel_usuario')
<title>Punto de Venta - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .swal2-container {
            z-index: 10000;
        }

        .modal {
            overflow-y: auto;
        }
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Punto de Venta
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Punto de Venta</li>
    </nav>
@endsection
@section('content')
    <div class="card shadow py-4 px-3 mt-0 mx-0">
        <h3>Resumen de la venta:</h3>
        <p>Puede utilizar un lector de codigo de barras</p>
        <p id="scannedProduct">Ultimo Codigo Escaneado: </p>
        <div class="table-responsive rounded px-3 mt-3">
            <table class="table align-items-center border" style="width:100%;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="productShown">
                    <tr>
                        <th>No hay productos añadidos</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="ms-3 mt-3">

            <h3 id="subTotal">Sub-total: $0</h3>
            <h3 id="total">Total: $0</h3>
        </div>

        <div class="d-flex flex-column align-items-center">
            <div class="row">
                <div class="col">

                    <button type="button" class="btn btn-danger btn-lg" onclick="cancelarVenta()">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-lg" onclick="chequearCarro()">
                        Pagar
                    </button>

                </div>
            </div>
        </div>
        <h2>Productos</h2>
        <div class="row my-2">
            <div class="col-sm-7">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="material-symbols-outlined">search</span></div>
                    </div>
                    <input type="text" name="searchProduct" id="searchProduct" class="form-control shadow-none"
                        placeholder="Ingrese el nombre de algún producto...">
                    <button id="barcodeScanner" class="btn btn-outline-success" data-toggle="modal"
                        data-target="#barcodeScan" role="button"><span
                            class="material-symbols-outlined">barcode_scanner</span></button>
                </div>
            </div>
            <div class="col-sm">
                <select name="" id="selectMarca" class="form-control">
                    <option value="all">Todas las marcas</option>
                    @foreach ($marcaProductos as $item)
                        <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex flex-wrap overflow-auto p-0" style="height:700px;" id="productAvailable">
            <p id="notFound" class="d-none">No se ha encontrado productos, realice otra busqueda o utilice otro
                filtro.</p>
            @foreach ($productos as $pro)
                <div class="producto mx-2" id="{{ $pro->nombre }}_{{ $pro->marcaproductos->nombre }}">
                    <div class="card p-2"
                        style="background-color:light-gray; margin-bottom: 20px; height: auto; width:220px">
                        <img src="/image/productos/{{ $pro->imagen_path }}" class="card-img-top mx-auto"
                            style="height: 150px; width: 150px;display: block;" alt="{{ $pro->imagen_path }}">

                        <div class="card-body">
                            <p class="text-center text-truncate">{{ $pro->nombre }}</p>
                            <h6 class="card-title text-center">{{ $pro->marcaproductos->nombre }}</h6>

                            <div style="display:flex;">

                            </div>
                            <div class="d-flex flex-column bd-highlight mb-3">
                                <p class="text-center">$ {{ number_format($pro->precio, 0, ',', '.') }}</p>
                                <input type="number" class="form-control form-control-sm" value="1"
                                    id="quantity_{{ $pro->id }}" name="quantity" min="1"
                                    max="{{ $pro->stock }}">
                            </div>

                            <p class="text-center @if ($pro->stock < 10) text-danger @endif">Stock:
                                {{ $pro->stock }}</p>
                            <div class="card-footer" style="background-color: white;">
                                <div class="row">
                                    @if ($pro->stock > 0)
                                        <button style="margin: 0 auto;" class="btn btn-secondary btn-sm"
                                            onclick="addProduct({{ $pro->id }})" class="tooltip-test">
                                            <i class="fa fa-shopping-cart"></i> Añadir
                                        </button>
                                    @else
                                        <p class="text-danger">Producto no Disponible</p>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>

    </div>
@endsection
<!-- Button trigger modal -->


<!-- Modal -->
@include('inventario.punto_de_venta.modal.comprobante')
@include('inventario.punto_de_venta.modal.barcode-scan')
@include('inventario.punto_de_venta.modal.pagoVenta_Modal')


@section('js-after')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#metodoPagoForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).parents(form);
                var efectivo = parseInt($('#montoEfectivo').val());
                var total = parseInt($('#monto').val());
                var metodoPago = $('#metodoPago').val();
                var nombreCliente = $('#nombreCliente').val();
                var numOperacion = $('#numOperacion').val();
                var banco = $('#banco').val();
                if (metodoPago == 'efectivo' && efectivo < total) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `Cantidad de efectivo ofrecido es menor que el total`,
                        showConfirmButton: false,
                        timer: 1500,
                    })

                } else {
                    Swal.fire({
                        title: '¿Realizar Venta?',
                        text: "¿Estás seguro que los datos están correctos?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Realizar Venta',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            axios.post("{{ route('point_sale.venta') }}", {
                                    metodoPago: metodoPago,
                                    banco: banco,
                                    montoEfectivo: efectivo,
                                    vuelto: vuelto,
                                    nombreCliente: nombreCliente,
                                    numOperacion: numOperacion,
                                })
                                .then(function(response) {
                                    $('#pagoVenta').modal('toggle');
                                    $('#ventaId').val(response.data.ventaId);
                                    toastr.success('Venta realizada exitosamente')
                                    $('#numVenta').html('Num. venta: ' + response.data
                                        .nuevaVenta['id_venta']);
                                    $('#fecha').html('Fecha: ' + response.data.fecha);
                                    $('#hora').html('Hora: ' + response.data.hora);
                                    $('#nombreClienteShow').html('Nombre del Cliente: ' +
                                        response
                                        .data
                                        .nuevaVenta['nombre_cliente']);
                                    $('#metodoPagoShow').html('Metodo de Pago: ' + response.data
                                        .metodoPago);
                                    $('#totalVentaShow').html('Total de la Venta: ' + new Intl
                                        .NumberFormat('es-CL', {
                                            currency: 'CLP',
                                            style: 'currency'
                                        }).format(response.data.montoFinal));
                                    $('#productosVendidos').empty();
                                    $.map(response.data.productosComprados, function(
                                        elementOrValue,
                                        indexOrKey) {
                                        var productMoney = new Intl.NumberFormat(
                                            'es-CL', {
                                                currency: 'CLP',
                                                style: 'currency'
                                            }).format(elementOrValue.price)
                                        var total = elementOrValue.price *
                                            elementOrValue
                                            .quantity;
                                        var TotalFormat = new Intl.NumberFormat(
                                            'es-CL', {
                                                currency: 'CLP',
                                                style: 'currency'
                                            }).format(total)
                                        $("#productosVendidos").append(`
            
                                    <tr> 
                                        
                                        <th> ${indexOrKey}</th>                     
                                        <td class="text-wrap">${elementOrValue.name}</td>
                                        <th>${elementOrValue.quantity}</th>
                                        <td>${productMoney}</td>
                                        <td>${TotalFormat}</td>
                                    </tr>
                                
                            
                                    
                                `);



                                    });
                                    setTimeout(() => {
                                        $('#comprobanteModal').modal('show')
                                    }, 500);


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
                }

            });
            $("#searchProduct").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $('#notFound').addClass('d-none');
                $("#selectMarca").val("all")
                $("#productAvailable .producto").filter(function() {
                    $(this).toggle($(this).attr('id').toLowerCase().indexOf(value) > -1)

                });
                if ($(".producto:visible").length <= 0) {
                    $('#notFound').removeClass('d-none')
                }
            });
            $("#selectMarca").on('change', function() {
                var value = $(this).val().toLowerCase();
                $('#notFound').addClass('d-none');
                $("#searchProducto").val("");
                if (value == "all") {
                    value = "";
                }
                $("#productAvailable .producto").filter(function() {
                    $(this).toggle($(this).attr('id').toLowerCase().indexOf(value) > -1)

                });
                if ($(".producto:visible").length <= 0) {
                    $('#notFound').removeClass('d-none')
                }
            });
        })

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



        function chequearCarro() {
            let monto = $('#monto').val();
            if (monto > 0) {
                let montoFormat = new Intl.NumberFormat('es-CL', {
                    currency: 'CLP',
                    style: 'currency'
                }).format(monto);
                $('#pagoVenta').modal('toggle');
                $('#totalPagarModal').html('Total: ' + montoFormat);
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: `No hay productos seleccionados`,
                    showConfirmButton: false,
                    timer: 1500
                })
            }

        }

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
        var barcode = '';
        var interval;
        document.addEventListener('keydown', function(evt) {
            if (interval)
                clearInterval(interval);
            if (evt.code == 'Enter') {
                if (barcode) {
                    barcodeScanner_physical(barcode);
                    barcode = '';
                    return;
                }
            }
            if(evt.key !='Shift'){
                barcode += evt.key;
            }
            interval = setInterval(()=>barcode = '', 20);
        });

        function barcodeScanner_physical(input) {
            var cantProducto = 1;
            var codigoEscaneado = input;
            axios.get(" {{ route('point_sale.addProduct') }}", {
                    params: {
                        codigo: codigoEscaneado,
                        cantProduct: cantProducto,
                    }
                })
                .then(res => {
                    if (res.data.success == true) {
                        updateTable(res.data.cartItems, res.data.total, res.data.subTotal);
                    }
                    $("#scannedProduct").html('Ultimo Codigo Escaneado: '+ codigoEscaneado);

                })

                .catch(err => {
                })
        }

        function cancelarVenta() {
            Swal.fire({
                title: '¿Cancelar Venta?',
                text: "¿Estás seguro? Se eliminaran todos los productos del carro",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    axios.get("{{ route('point_sale.clear') }}", {})
                        .then(function(response) {

                            toastr.success("¡Venta cancelada correctamente!");

                        })
                        .catch(function(error) {
                            toastr.error("La acción no se pudo realizar");
                        })
                        .finally(function() {
                            $("#productShown").empty();
                            $("#productShown").append(`
                            <tr> 
                                <th>No hay productos añadidos</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                            
                            </tr>  
                            `)
                            $("#total").html("Total: $0");
                            $("#subTotal").html("Sub-total: $0");;
                            $("#monto").val(0);
                        });
                }
            });
        }

        function deleteProduct(value) {
            axios.get(" {{ route('point_sale.removeProduct') }}", {
                    params: {
                        value: value,
                    }
                })
                .then(res => {
                    updateTable(res.data.cartItems, res.data.total, res.data.subTotal);
                    if ($('#productShown').is(':empty')) {
                        $("#productShown").append(`
                            <tr> 
                                <th>No hay productos añadidos</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                            
                            </tr>  
                            `)
                    }
                })

                .catch(err => {
                    console.error(err);

                    $(`#errorText${err.response.data.errors2}`).removeClass('d-none');
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `Producto ${err.response.data.errors} sin stock`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
        }

        function updateProduct(value) {
            var getQuantity = $('#quantity_table_' + value).val();

            axios.get(" {{ route('point_sale.updateProduct') }}", {
                    params: {
                        id: value,
                        quantity: getQuantity,
                    }
                })
                .then(res => {
                    updateTable(res.data.cartItems, res.data.total, res.data.subTotal);

                })

                .catch(err => {

                    $(`#errorText${err.response.data.errors2}`).removeClass('d-none');
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `Producto ${err.response.data.errors} sin stock`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
        }

        function updateTable(cartItems, getTotal, getSubtotal) {
            $("#productShown").empty();
            $.map(cartItems, function(elementOrValue, indexOrKey) {
                var productMoney = new Intl.NumberFormat('es-CL', {
                    currency: 'CLP',
                    style: 'currency'
                }).format(elementOrValue.price)
                $("#productShown").append(`
            
                        <tr>                       
                            <td class="text-wrap">${elementOrValue.name}</td>
                            <th class ="pl-4" scope="row"><input type="number" class="form-control form-control-sm"
                                            id="quantity_table_${elementOrValue.id}" min="1" value="${elementOrValue.quantity}" onchange="updateProduct(${elementOrValue.id})" style="width:80px"></th>
                            <td>${productMoney}</td>
                            <td><button type="button" class="btn btn-outline-danger" onclick="deleteProduct(${elementOrValue.id})">Eliminar</button></td>
                         
                        </tr>
                    
                
                        
                    `);



            });

            $("#monto").val(getTotal);
            var total = new Intl.NumberFormat('es-CL', {
                currency: 'CLP',
                style: 'currency'
            }).format(getTotal)
            var subTotal = new Intl.NumberFormat('es-CL', {
                currency: 'CLP',
                style: 'currency'
            }).format(getSubtotal)
            $("#total").html("Total: " + total);
            $("#subTotal").html("Sub-total: " + subTotal);
        }

        function addProduct(value) {
            var cantProducto = $("#quantity_" + value).val();
            axios.get(" {{ route('point_sale.addProduct') }}", {
                    params: {
                        value: value,
                        cantProduct: cantProducto,
                    }
                })
                .then(res => {

                    updateTable(res.data.cartItems, res.data.total, res.data.subTotal);

                })

                .catch(err => {
                    console.error(err);

                    $(`#errorText${err.response.data.errors2}`).removeClass('d-none');
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `Producto ${err.response.data.errors} sin stock`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
        }
    </script>
@endsection
