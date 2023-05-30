@extends('layouts.appshop')
@section('title')
CARRITO | Veterinaria Gumiel
@endsection
@section('content')
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4./dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="container pt-2">
        <div class="row justify-content-center">
            <div class="col-lg-8 p-0 pr-2 pb-2">
                <nav aria-label="breadcrumb" >
                    <ol class="m-0  breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
                <div class="bg-white shadow d-flex pr-4" style="border-bottom-width: 2px; border-radius: 20px;">
                    <a class="navbar-brand m-4" href="{{ route('inicio') }}"><img src="{{ asset('images/logoGumiel.png') }}"
                            style="width:80px;" /></a>
                    <div class="align-items-center" style="display: flex; justify-content: space-between; width:100%;">
                        <h1 class="font-weight-bold m-0">Carro de Compras</h1>
                        <div class="font-weight-bold m-0">
                            @if (!Auth::check())
                                <h5 class="m-0">Bienvenido</h5>
                            @else
                                <h5 class="m-0">Hola {{Auth::user()->name}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
                
                @foreach($cartCollection as $item)
                    <div class="col-12 p-0">
                        <div class="row m-0 mt-3 bg-white" style="border-radius:20px; border:2px solid lightgray;">
                            <div class="col-1  d-flex p-0">
                                <div class="card w-100 border-0" style="border-radius:20px;">
                                    
                                    <button style="margin:auto; outline: none;"><i class="fa fa-angle-up btn-edit"></i></button>
                                    <div style="padding:0 auto; text-align:center;"><span>{{ $item->quantity }}</span></div>
                                    <button style="margin:auto; outline: none;"><i class="fa fa-angle-down btn-edit"></i></button>
                                    
                                </div>
                            </div>
                            <div class="p-0 col-2 d-flex align-items-center justify-content-center">
                                <img style="max-height:100px;" src="/image/productos/{{ $item->attributes->image }}" class="p-1" >
                            </div>
                            <div class="col-8 p-3">
                                <h3 class="overflow-ellipsis mb-3" style=" white-space: nowrap; overflow: hidden;">
                                    {{$item->name}}
                                </h3>
                                <spam>Precio Unidad: ${{number_format($item->price, 0, ',', '.')}}</spam><br>
                                <spam>Precio Total: ${{number_format(\Cart::get($item->id)->getPriceSum(), 0, ',', '.')}}</spam>
                                    
                                
                            </div>
                            <div class="col-1 pl-0  d-flex align-items-center justify-content-center">
                                <div>
                                    <form action="{{ route('shop.cart.remove') }}" method="POST" class="m-0">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <button class="p-3 btn-w"><i class="fa fa-trash" ></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4 p-0 pl-2">
                <div  class="shadow border mb-3 p-5 card">
                    <div class="row m-0 p-0 ml-auto">
                        <a href="/shop" class="a-dec font-weight-bold ">Volver a la tienda</a>
                    </div> 
                    <div class="row m-0 p-0 pb-4 pt-5">
                        <h2 class="font-weight-bold">Resumen</h2>
                    </div>
                    <div  class="row p-0">
                        <div class="col-6" >
                            <h5 class="m-0">SubTotal :</h5>
                        </div>
                        <div class="col-6" >
                            <h5 class="m-0 float-right">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h5>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div  class="row pb-4">
                        <div class="col-6 ">
                            <h4 class="m-0 d-flex align-items-center">Total :</h4>
                        </div>
                        <div class="col-6 ">
                            <h4 class="m-0 float-right">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h4>
                        </div>
                    </div>
                    <div>
                        @if (!Auth::check())
                            <form action="{{ route('shop.checkout.login')}}" method="get">
                                {{csrf_field()}}
                                <input type="submit" id="btn-login" value="Ir a comprar login" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                            </form>
                        @else
                            <form action="{{ route('shop.checkout.checkout')}}" method="POST">
                                {{csrf_field()}}
                                <input type="submit" id="btn-checkout" value="Ir a comprar Checkout" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                            </form>
                        @endif
                        
                        
                    </div>
                    <div>
                        <form class="m-0" action="/shop/checkout/registro_invitado" method="POST">
                            {{csrf_field()}}
                            <button class="btn btn-block btn-link font-weight-bold a-dec">Borrar Carrito</button>
                        </form>
                    </div>
                    <div >


                </div>
                    
            
            </div>
        </div>
    </div>


    


  

<script>
    
    function cero(ruta){
        var ruta=ruta;
        if({{\Cart::getTotal()}}==0){
            
            toastr.remove();
            toastr.error('Agregue al menos un Producto al Carrito de Compras para poder Continuar con la Compra.', 'Carro Vacio!', {timeOut: 3000});
        }else{
            if(ruta=="checkout"){
                window.location.href = "{{ route('shop.checkout.checkout')}}";
            }
            if(ruta=="login"){
                window.location.href = "{{ route('shop.checkout.login')}}";
            }
        }
    }

    


    function def(){        
        if({{\Cart::getTotal()}}==0){
            document.getElementById('btn-checkout').disabled = true;
            document.getElementById('btn-login').disabled = true;
            toastr.remove();
            toastr.warning('Agregue al menos un Producto al Carrito de Compras para poder Continuar con la Compra.', 'Carro Vacio!', {timeOut: 5000});
        }

    }window.load = def();

    

</script>
@endsection

<style>
body{
    background:url("/image/fondo-tienda.png");
    background-repeat: repeat;
    background-attachment: fixed;
    background-size:400px;
    backdrop-filter:blur(1px);
        }
</style>