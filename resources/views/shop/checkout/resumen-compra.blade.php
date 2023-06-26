@extends('layouts.appshop')
@section('title')
RESUMEN DE COMPRA | Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <div class="container pt-2 h-100">
        <div class="row justify-content-center">
            <div class="col-lg-7 p-0 pr-lg-1">
                <nav aria-label="breadcrumb" >
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
                <!-- <div class="bg-white shadow d-flex pr-5 pl-5 pt-4 pb-4 mb-2" style="border-radius: 15px;">
                    <div class="align-items-center" style="display: flex; justify-content: space-between; width:100%;">
                        <h1 class="font-weight-bold m-0"><i class="bi bi-card-checklist mr-3"></i>Resumen de compra</h1>
                        <div class="font-weight-bold m-0">
                            <h5 class="m-0">Hola {{Auth::user()->name}}</h5>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow p-4" style="border-radius: 15px;">
                    <div id="aceptada">
                        <div class="col-12" style="display:flex; justify-content:center">
                            <i class="bi bi-check-circle" style="color:green; font-size:80px;"></i>
                        </div>
                        <div class="col-12 p-4" style="display:flex; justify-content:center">
                            <h2>Compra Exitosa</h2>
                        </div>
                        <div class="col-12 p-4 bg-light bg-ligth shadow" style="border-radius: 15px;">
                            <div><h2 class=" pl-3 pr-3 font-weight-normal">Detalles de Compra</h2></div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Numero de Orden:</span>
                                <span class="m-0">{{$response->getBuyOrder()}}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Monto Pagado:</span>
                                <span class="m-0">${{ number_format($response->getAmount(), 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Codigo de Autorización:</span>
                                <span class="m-0">{{$response->getAuthorizationCode()}}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Fecha de Transacción:</span>
                                <span id="fecha" class="m-0"></span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Hora de Transacción:</span>
                                <span id="hora" class="m-0"></span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Tipo Pago:</span>
                                <span id="tipo_pago" class="m-0"></span>
                            </div>
                            <div id="num_cuotas">
                                <div id="num_cuotas" class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                    <span class="m-0">Numero de Cuotas:</span>
                                    <span id="num_cuotas_span" class="m-0">{{$response->getInstallmentsNumber()}}</span>
                                </div>
                            </div>
                            <div id="mon_cuotas">
                                <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                    <span class="m-0">Monto de Cuotas:</span>
                                    <span id="mon_cuotas_span" class="m-0">${{ number_format($response->getInstallmentsAmount(), 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Numero de Targeta:</span>
                                <span class="m-0">**** **** **** {{$response->getCardDetail()['card_number']}}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Fecha de Expiración:</span>
                                <span id="fecha_targeta" class="m-0"></span>
                            </div>
                            <div><h2 class="mt-5 pl-3 pr-3 font-weight-normal">Detalles de Cliente</h2></div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Tipo Cliente:</span>
                                <span class="m-0">{{Auth::user()->roles[0]->name}}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Nombre Cliente:</span>
                                <span class="m-0">{{Auth::user()->name}}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Rut Cliente:</span>
                                <span class="m-0">{{Auth::user()->rut}}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                                <span class="m-0">Email Cliente:</span>
                                <span class="m-0">{{Auth::user()->email}}</span>
                            </div>

                            <button class="btn btn-danger m-4" type="button"><i class="fas fa-file-pdf"></i> Descargar Comprobante de pago</button>
                        
                        </div>
                    </div>
                    <div id="rechazada">
                        <div class="col-12" style="display:flex; justify-content:center">
                            <i class="bi bi-x-circle" style="color:red; font-size:80px;"></i>
                        </div>
                        <div class="col-12 p-4" style="display:flex; justify-content:center">
                            <h2>Compra Fallida</h2>
                        </div>
                        <div id="texto" class="col-12" style="text-align: center;"></div>
                    </div>
                </div> -->

                @include('pdf.comprobante-pago')

                <div class="text-center">
                    <button href="{{ route('testing') }}" class="btn btn-danger m-4" type="button">
                        <i class="fas fa-file-pdf"></i> Descargar Comprobante de pago
                    </button>
                </div>

            </div>
            <div class="col-lg-5 p-0 pl-lg-1">
                <div class="row bg-white shadow m-0">
                   
                    <h2 class="m-0 p-2 pr-4 pl-4  font-weight-normal" style="border-bottom-width: 3px;">
                        <i class="bi bi-cart-check mr-2" style="font-size:30px;"></i>
                        Mis Productos ( {{\Cart::getTotalQuantity()}} )
                    </h2>
                
                    @foreach($cartCollection as $item)
                        <div class="row m-0 pt-3 pb-3 pr-4 pl-4" style="border-bottom-width: 2px;">
                            <div class="p-0 col-3 m-auto" >
                                <div style="position: relative;">
                                    <img style="max-height:80px;" src="/image/productos/{{ $item->attributes->image }}">
                                    <div class="bg-dark w-7 top-0 h-7 d-flex" style="position: absolute; border-radius:50px; text-align:center;">
                                        <span style="margin:auto;  color:white;">{{ $item->quantity }}</span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-9 p-0" >
                                <h3 class="overflow-ellipsis" style=" white-space: nowrap; overflow: hidden;">
                                    {{$item->name;}}
                                </h3>
                                <spam>precio: ${{number_format($item->price, 0, ',', '.')}}</spam><br>
                                <spam>subtotal: ${{number_format(\Cart::get($item->id)->getPriceSum(), 0, ',', '.')}}</spam>
                            </div>
                        </div>
                    @endforeach
                    <div class="row m-0 pr-5 pl-5 pt-4 pb-4">
                        <div class="d-flex justify-content-between pb-4" style="border-bottom-width: 2px;">
                            <h3 class="font-weight-normal m-0">SubTotal :</h3>
                            <h3 class="font-weight-normal m-0">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pt-4">
                            <h3 class="m-0">Total a pagar:</h3>
                            <h3 class="m-0">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="p-4">
                        <form id="form_finish" class="m-0" action="{{route('finish',['status_finish'=>$response->getResponseCode()])}}" method="get">
                            {{csrf_field()}}
                            <input type="submit" id="button_finish" value="" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                        </form>
                        <div id="hid" class="row pt-4">
                            <a href="/shop" class="a-dec font-weight-bold w-10" style="text-align: center;">Finalizar</a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>  

<script>
    function wload() {

        if(!{{$response->getResponseCode()}}){
            var date="{{$response->getTransactionDate()}}";
            var cardDate="{{$response->getAccountingDate()}}";
            document.getElementById("fecha").innerHTML= date.substring(8, 10)+"-"+date.substring(5, 7)+"-"+date.substring(0, 4);
            document.getElementById("hora").innerHTML= date.substring(11, 13)+":"+date.substring(14, 16)+":"+date.substring(17, 19);
            document.getElementById("fecha_targeta").innerHTML= cardDate.substring(2, 4)+"/"+cardDate.substring(0, 2);
            var tipo_targeta="{{$response->getPaymentTypeCode()}}";
            switch (tipo_targeta) {
                case "VD":
                    texto_tipo="Venta Débito";
                    document.getElementById("num_cuotas").hidden = true;
                    document.getElementById("mon_cuotas").hidden = true;
                    break;
                case "VP":
                    texto_tipo="Venta Prepago";
                    document.getElementById("num_cuotas").hidden = true;
                    document.getElementById("mon_cuotas").hidden = true;
                    break;
                case "VC":
                    texto_tipo="Venta Crédito";
                    document.getElementById("mon_cuotas").hidden = true;
                    break;
                case "NC":
                    texto_tipo="Venta Crédito";
                    //no pude hacer la prueba aca
                    break;
                case "SI":
                    texto_tipo="Venta Crédito";
                    break;
                case "S2":
                    texto_tipo="Venta Crédito";
                    break;
                case "VN":
                    texto_tipo="Venta Crédito";
                    document.getElementById("num_cuotas_span").innerHTML=1;
                    document.getElementById("mon_cuotas_span").innerHTML="${{ number_format($response->getAmount(), 0, ',', '.') }}";
                    break;
            }

            document.getElementById("tipo_pago").innerHTML=texto_tipo;
            document.getElementById('button_finish').value = "Finalizar";
            document.getElementById("hid").hidden = true;
            document.getElementById("rechazada").hidden = true;
        }else{
            var texto;
            var option={{$response->getResponseCode()}};
            switch (option) {
                case -1:
                    texto="Error en el ingreso de datos de la Transacción.";
                    break;
                case -2:
                    texto="Se produjo un fallo al procesar la transacción relacionado a parámetros de la tarjeta y/o su cuenta asociada.";
                    break;
                case -3:
                    texto="Error en Transacción.";
                    break;
                case -4:
                    texto="Transacción rechazada por parte del emisor.";
                    break;
                case -5:
                    texto="Transacción con riesgo de posible fraude.";
                    break;
                case -6:
                    texto="Transacción con flujo de pago anormal.";
                    break;
                default:
                    texto="Transacción rechazada.";
                    break;
            }

            document.getElementById("texto").innerHTML = texto;
            document.getElementById('button_finish').value = "Volver a intentar";
            document.getElementById("hid").hidden = false;
            document.getElementById("aceptada").hidden = true;
            resumen_error();
            
        }
    }window.load = wload();

</script>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function resumen_error() {
        Swal.fire({
            title: 'Rechazado',
            text: "Compra Fallida",
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        });
    }
</script>

<style>
body{
    background:url("/image/fondo-tienda.png");
    background-repeat: repeat;
    background-attachment: fixed;
    background-size:400px;
    backdrop-filter:blur(1px);
        }
</style>

