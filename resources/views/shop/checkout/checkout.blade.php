@extends('layouts.appshop')
@section('title')
CHECKOUT | Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="container px-4 py-4">
        <div class="row justify-content-center">
            <div class="col-lg-7 p-0 pr-lg-1">
                <nav aria-label="breadcrumb" >
                    <ol class="m-0  breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('shop.shop') }}">Tienda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
                <div class="bg-white shadow d-flex pr-5 pl-5 pt-4 pb-4 mb-2" style="border-radius: 15px;">
                    <div class="align-items-center" style="display: flex; justify-content: space-between; width:100%;">
                        <h1 class="font-weight-bold m-0"><i class="bi bi-wallet2 mr-3"></i>Metodo de pago</h1>
                        <div class="font-weight-bold m-0">
                            <h5 class="m-0">Hola {{Auth::user()->name}}</h5>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow d-flex justify-content-between pr-5 pl-5 pt-3 pb-3" style="border-radius: 15px;">
                    <div style="margin:auto 0;">
                        <input type="radio" name="Tipo" onchange="toggleButton(this)"  id="webpayplus" value="webpayplus">
                        <span>Webpay plus</span>
                    </div>
                    <div class="d-flex">
                        <img style="max-height:40px;" src="/image/logo-web-pay-plus.png">
                        <div id="loading" hidden class="mt-auto mb-auto ">
                            <div class="d-flex justify-content-center w-8 mt-auto mb-auto ml-3">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div id="check" hidden class="w-8 mt-auto mb-auto ml-3">
                            <span style="color:#19A448"><i class="fa-2x bi bi-check-lg"></i></span>
                        </div>
                    </div>
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
                    <div class="pb-5 pr-5 pl-5">
                        <form id="form" action="" method="POST">
                            {{csrf_field()}}
                            <input type="submit" id="submitButton" value="Ir a pagar" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
         

                    
<!-- pruebasssss -->

      




<!-- fin pruebasssssss -->
<script>
    function unselect() {
        document.getElementById('submitButton').disabled = true;
        document.querySelectorAll('[name=Tipo]').forEach((x) => x.checked = false);
    }window.load = unselect();

</script>

@endsection

<script>

    function toggleButton(that){
        document.getElementById("loading").hidden = false;
        var pago = document.getElementById('webpayplus').checked;
        if (pago) {
            
            axios.post("/"+that.value)
            .then(function(response){

                document.getElementById("loading").hidden = true;
                document.getElementById("check").hidden = false;
                document.getElementById('submitButton').disabled = false;
                document.forms['form'].action = response.data.url+"?token_ws="+response.data.token;
            })
            .catch(error=>console.log(error));            
        } else {
            document.getElementById('submitButton').disabled = true;
        }
    }

    </script>

