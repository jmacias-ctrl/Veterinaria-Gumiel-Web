@extends('layouts.panel_usuario')
<title>Punto de Venta - Veterinaria Gumiel</title>
@section('css-before')
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Punto de Venta</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}
    <div class="row">
        <div class="col-lg">
            <div class="card shadow p-4 overflow-auto">
                <h2>Productos</h2>
                <div class="row my-2 mb-4">
                    <div class="col-sm-7">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="material-symbols-outlined">search</span></div>
                            </div>
                            <input type="text" name="search" id="search" class="form-control shadow-none"
                                placeholder="Ingrese el nombre de algún producto...">
                        </div>
                    </div>
                    <div class="col-sm">
                        <select name="" id="selectCategory" class="form-control">
                            <option value="all">Todos los productos</option>

                        </select>

                    </div>
                </div>
                <div class="row">
                    @foreach ($productos as $pro)
                        <div class="col-lg-3">
                            <div class="card p-2" style="background-color:light-gray; margin-bottom: 20px; height: auto;">
                                <img src="/image/productos/{{ $pro->imagen_path }}" class="card-img-top mx-auto"
                                    style="height: 150px; width: 150px;display: block;" alt="{{ $pro->imagen_path }}">

                                <div class="card-body">
                                    <p>{{ $pro->marca }}</p>
                                    <a href="{{ route('shop.show', ['id' => $pro->id]) }}">
                                        <h6 class="card-title">{{ $pro->nombre }}</h6>
                                    </a>

                                    <div style="display:flex;">

                                    </div>
                                    <div class="d-flex flex-column bd-highlight mb-3">
                                        <p class="text-center">$ {{ $pro->precio }}</p>
                                        <input type="number" class="form-control form-control-sm" value="1"
                                            id="quantity_{{ $pro->id }}" name="quantity" min="1"
                                            max="{{ $pro->stock }}">
                                    </div>

                                    <div class="card-footer" style="background-color: white;">
                                        <div class="row">
                                            <button style="margin: 0 auto;" class="btn btn-secondary btn-sm"
                                                onclick="addProduct({{ $pro->id }}, false)" class="tooltip-test">
                                                <i class="fa fa-shopping-cart"></i> Añadir
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow p-4">
                <h2>Venta</h2>
                <div class="table-responsive shadow border rounded pt-3">
                    <table class="table align-items-center table-sm mb-3">
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
                <h3>Resumen de la venta:</h3>
                <div class="d-flex flex-column float-right">
                    <h3 id="subTotal">Sub-total: $0</h3>
                    <h3 id="total">Total: $0</h3>
                    <div class="row">
                        <div class="col">

                            <button type="button" class="btn btn-danger btn-lg" onclick="cancelarVenta()">Cancelar</button>
                            <button type="button" class="btn btn-primary btn-lg" onclick="chequearCarro()">
                                Pagar
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="pagoVenta" tabindex="-1" aria-labelledby="pagoVenta" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Realizar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" id="id" name="id" value="{{auth()->user()->id}}">
                    <input type="hidden" id="monto" name="monto">
                    <h3>Metodo de Pago</h3>
                    <select class="form-control" id="metodoPago" name="metodoPago" onchange="cambioMetodoPago()">
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                    <hr>
                    <div class="form-group">
                        <label for="nombreCliente">Nombre del Cliente:</label>
                        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"
                            placeholder="Ej. Juan">
                    </div>
                    <div class="form-group d-none" id="numOperacionDiv" >
                        <label for="numOperacion">Numero de Operacion:</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" id="numOperacion" placeholder="">
                        </div>
                    </div>
                    <div class="form-group d-none" id="bancoDiv">
                        <label for="banco">Banco</label>
                        <select class="form-control" id="banco" name="banco">
                            <option value="bancoestado">Banco Estado</option>
                            <option value="bancofalabella">Banco Falabella</option>
                            <option value="bancosantander">Banco Santander</option>
                            <option value="bancobci">Banco BCI</option>
                            <option value="bancochile">Banco de Chile</option>
                            <option value="bancoscotiabank">Banco Scotiabank</option>
                        </select>
                    </div>
                    <div class="form-group" id="montoEfectivoDiv">
                        <label for="montoEfectivo">Efectivo:</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" id="montoEfectivo" placeholder="">
                        </div>
                    </div>
                    <hr>
                    <h3 id="totalPagarModal">Total a Pagar: $0</h3>
                    <h3 id="vuelto">Vuelto: $0</h3>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit"  class="btn btn-primary" value="Pagar">
            </div>
            </form>
        </div>
    </div>
</div>
@section('js-after')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script>
        $(document).ready(function() {
            $('#ventaForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).parents(form);
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

                    }
                });
            });
        })

        $('#montoEfectivo').on('change', function(){
            let efectivo = $('#montoEfectivo').val();
            let monto = $('#monto').val();
            let vuelto = new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(efectivo - monto);
            if(efectivo>monto){
                $('#vuelto').html('Vuelto: ' + vuelto);
            }else{
                $('#vuelto').html('Vuelto: $0');
            }
        });

        function chequearCarro(){
            let monto = $('#monto').val();
            if(monto>0){
                let montoFormat = new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(monto);
                $('#pagoVenta').modal('toggle');  
                $('#totalPagarModal').html('Total: '+ montoFormat);
            }else{
                Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: `No hay productos seleccionados`,
                        showConfirmButton: false,
                        timer: 1500
                    })
            }
            
        }
        function cambioMetodoPago(){
            let metodoPago = $('#metodoPago').val();
            $('#montoEfectivo').removeAttr('required');
            $('#montoEfectivo').attr('disabled');
            
            $('#banco').removeAttr('required');
            $('#banco').attr('disabled');

            $('#numOperacion').removeAttr('required');
            $('#numOperacion').attr('disabled');
            
            $('#numOperacionDiv').removeClass('d-none')
            $('#bancoDiv').removeClass('d-none')
            $('#montoEfectivoDiv').removeClass('d-none')
            $('#vuelto').removeClass('d-none')

            $('#numOperacionDiv').addClass('d-none')
            $('#bancoDiv').addClass('d-none')
            $('#montoEfectivoDiv').addClass('d-none')
            $('#vuelto').addClass('d-none')

            if(metodoPago=="efectivo"){
                $('#montoEfectivoDiv').removeClass('d-none')
                $('#vuelto').removeClass('d-none')
            }else if(metodoPago=="transferencia"){
                $('#bancoDiv').removeClass('d-none')
                $('#numOperacionDiv').removeClass('d-none')
            }else{
                $('#numOperacionDiv').removeClass('d-none')
            }
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

                            toastr.success("Venta cancelada correctamente!");

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
                    $("#productShown").empty();
                    $.map(res.data.cartItems, function(elementOrValue, indexOrKey) {
                        var productMoney = new Intl.NumberFormat('es-CL', {
                            currency: 'CLP',
                            style: 'currency'
                        }).format(elementOrValue.price)
                        $("#productShown").append(`
            
                        <tr> 
                            
                                                   
                            <td class="text-wrap">${elementOrValue.name}</td>
                            <th class ="pl-4" scope="row">   ${elementOrValue.quantity}  </th>
                            <td>${productMoney}</td>
                            <td><button type="button" class="btn btn-outline-danger" onclick="deleteProduct(${elementOrValue.id})">Eliminar</button></td>
                         
                        </tr>
                    
                
                    
                    `);



                    });

                    $("#monto").val(res.data.total);
                    var total = new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(res.data.total)
                    var subTotal = new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(res.data.subTotal)
                    $("#total").html("Total: " + total);
                    $("#subTotal").html("Sub-total: " + subTotal);


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

        function addProduct(value, inTable) {
            if(inTable){
                var cantProducto = $("#quantity_table_" + value).val();
            }else{
                var cantProducto = $("#quantity_" + value).val();
            }
            
            axios.get(" {{ route('point_sale.addProduct') }}", {
                    params: {
                        value: value,
                        cantProduct: cantProducto,
                    }
                })
                .then(res => {


                    $("#productShown").empty();
                    $.map(res.data.cartItems, function(elementOrValue, indexOrKey) {
                        var productMoney = new Intl.NumberFormat('es-CL', {
                            currency: 'CLP',
                            style: 'currency'
                        }).format(elementOrValue.price)
                        $("#productShown").append(`
            
                        <tr> 
                            
                                                   
                            <td class="text-wrap">${elementOrValue.name}</td>
                            <th class ="pl-4" scope="row"><input type="number" class="form-control form-control-sm" value="1"
                                            id="quantity_table_${elementOrValue.id}" min="1"
                                            max="{{ $pro->stock }}" value="${elementOrValue.quantity} " onchange="addProduct(${elementOrValue.id}, true)"></th>
                            <td>${productMoney}</td>
                            <td><button type="button" class="btn btn-outline-danger" onclick="deleteProduct(${elementOrValue.id})">Eliminar</button></td>
                         
                        </tr>
                    
                
                    
                    `);



                    });

                    $("#monto").val(res.data.total);
                    var total = new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(res.data.total)
                    var subTotal = new Intl.NumberFormat('es-CL', {
                        currency: 'CLP',
                        style: 'currency'
                    }).format(res.data.subTotal)
                    $("#total").html("Total: " + total);
                    $("#subTotal").html("Sub-total: " + subTotal);

                    $("#quantity_" + value).val(1);
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
