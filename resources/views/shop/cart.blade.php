@extends('layouts.appshop')
@section('content')
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function def(){
      
        if({{\Cart::getTotal()}}==0){
            toastr.remove();
            toastr.warning('Agregue al menos un Producto al Carrito de Compras para poder Continuar con la Compra.', 'Carro Vacio!', {timeOut: 5000});
        }
    }window.load = def();

    
</script>



    <div class="container pt-2">
        <div class="row justify-content-center">
            <div class="col-lg-8 pr-2 pl-2">
                <div class=" pl-5 pr-5 d-flex align-items-center bg-secondary shadow border rounded-3">    
                    <a class="navbar-brand ml-0 mt-4 mb-4 mr-4" href="{{ route('inicio') }}"><img src="{{ asset('images/logoGumiel.png') }}"
                            style="width:80px;" /></a>
                    <div class="d-flex align-items-center" style="display: flex; justify-content: space-between; width:100%;">
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
                
                <div class="row m-0 mt-3 bg-secondary shadow border border-secondary border-1 rounded-3">
                    <div class="col-lg-1 bg-success ">
                        caca
                    </div>
                </div>


<!-- 
                        <div class="row">
                        <div class="col-lg-2">
                            <img src="/image/productos/{{ $item->attributes->image }}" class="img-thumbnail" >
                        </div>
                        <div class="col-lg-6">
                            <p>
                                <b><a href="/shop/show/{{ $item->id }}">{{ $item->name }}</a></b><br>
                                <b>Precio: </b>${{ $item->price }}<br>
                                <b>Sub Total: </b>${{ \Cart::get($item->id)->getPriceSum() }}<br>
                                {{--<b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                            </p>
                        </div>
                        
                        <div class="col-lg-4" style="display:flex;">
                            <div>
                                <form  action="{{ route('shop.cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                    <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}"
                                            id="quantity" name="quantity" style="margin:0 10px 0 0; width: 70px;" min="1" max="{{ $item->stock }}">
                                    
                                    <button class="btn btn-secondary btn-sm" style="margin:0 10px 0 0; height:30px; width: 33px;"><i class="fa fa-edit"></i></button>
                                </form>
                            </div>
                            <div>
                                <form action="{{ route('shop.cart.remove') }}" method="POST" >
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right:5px; width: 33px;"><i class="fa fa-trash" style="width: 14px; heigth: 14px; "></i></button>
                                </form>
                            </div>
                        </div>
                    </div> 
-->
                @endforeach
            </div>
            <div class="col-lg-4 pr-2 pl-2">
                <div  class="shadow border mb-3 p-5 bg-secondary">
                    <div class="row m-0 p-0 justify-content-end">
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
                            <button onclick="cero('login');" id="btn-login"  class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;">Ir a Comprar login</button>
                        @else
                            <button onclick="cero('checkout');" id="btn-checkout"  class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;">Ir a Comprar checkout</button>
                        @endif
                        
                        
                    </div>
                    <div>
                        <form class="m-0" action="{{route('shop.cart.clear')}}" method="POST">
                            {{csrf_field()}}
                            <button class="btn btn-block btn-link font-weight-bold a-dec">Borrar Carrito</button>
                        </form>
                    </div>
                    <div >


                </div>
                    
            
            </div>
        </div>
    </div>


    


  
@endsection

<script>
    
    function cero(ruta){
        var ruta=ruta;
        if({{\Cart::getTotal()}}==0){
            
            toastr.remove();
            toastr.warning('Agregue al menos un Producto al Carrito de Compras para poder Continuar con la Compra.', 'Carro Vacio!', {timeOut: 3000});
        }else{
            if(ruta=="checkout"){
                window.location.href = "{{ route('shop.checkout.checkout')}}";
            }
            if(ruta=="login"){
                window.location.href = "{{ route('shop.checkout.login')}}";
            }
        }
    }
</script>
<style> 
    body{
        background:url("/image/fondo-tienda.png");
        background-repeat: repeat;
        background-attachment: fixed;
        background-size:450px;
        backdrop-filter:blur(1px);
        height: 100%;
    }
</style>