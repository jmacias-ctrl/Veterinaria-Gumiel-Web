@extends('layouts.appshop')
@section('title')
CARRITO | Veterinaria Gumiel
@endsection
@section('content')
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container p-0">
        <div class="row justify-content-center px-4 py-4">
            <div id="div_productos" class="col-lg-8 p-0 pr-2 pb-2">
                <nav aria-label="breadcrumb" >
                    <ol class="m-0  breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{route('shop.shop')}}">Tienda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
                <div class="bg-white shadow d-flex pr-4" style="border-bottom-width: 2px; border-radius: 20px;">
                    <a class="navbar-brand m-4" href="{{ route('inicio') }}"><img src="{{ asset('image/logo.png') }}"
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
                <div id="carro" class="col-12 p-0">
                    @foreach($cartCollection as $item)
                        <div id="div{{$item->id}}" class="row m-0 mt-3 bg-white" style="border-radius:20px; border:2px solid lightgray;">
                            <div class="col-1  d-flex p-0">
                                <div id="dsr{{$item->id}}" style="display:block;">
                                    <div class="card w-100 h-100 border-0" style="border-radius:20px;">
                                        <button id="{{$item->id}}_btns" name="{{$item->stock}}" value="{{ $item->quantity }}" style="margin:auto; outline: none;"><i class="btnsor fa fa-angle-up btn-edit"></i></button>
                                        <div style="padding:0 auto; text-align:center; position:relative;">
                                            <div id="{{$item->id}}_icon" class="w-100 h-100 p-1" hidden style="position:absolute;">
                                                <div class="spinner-border spinner-border-sm" style="color:gray" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <input type="text" id="input{{$item->id}}" class="w-100" style="text-align:center"  disabled name="nombre" value="{{ $item->quantity }}">
                                        </div>
                                        <button id="{{$item->id}}_btnr" name="{{$item->stock}}" style="margin:auto; outline: none;"><i class="btnsor fa fa-angle-down btn-edit"></i></button>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="p-0 col-2 d-flex align-items-center justify-content-center">
                                <img style="max-height:100px;" src="/image/productos/{{ $item->attributes->image }}" class="p-1" >
                            </div>
                            <div class="col-sm-8 col-7 p-3">
                                <h3 class="font-weight-normal overflow-ellipsis mb-0" style=" white-space: nowrap; overflow: hidden;">
                                    {{$item->attributes->slug}}
                                </h3>
                                <h3 class="font-weight-bold" style="font-size: 13px">{{$item->marca}}</h3>
                                <spam style="font-size: 14px"> Precio Unidad: ${{number_format($item->price, 0, ',', '.')}}</spam><br>
                                <spam style="font-size: 14px" id="preciototal{{$item->id}}">Precio Total: ${{number_format(\Cart::get($item->id)->getPriceSum(), 0, ',', '.')}}</spam>
                                    
                                
                            </div>
                            <div class="col-sm-1 col-2 pl-0 pr-1  d-flex align-items-center justify-content-end">
                                <div class="m-0"  style="display:flex; justify-content:center; width:50px; height:50px;">
                                        <button id="{{$item->id}}" onclick="deleted(this)" class="btn-w w-100"><i class="fa fa-trash" ></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 p-0 pl-2">
                <div  class="shadow border mb-3 p-5 card">
                    <div class="m-0 p-0" style="display:flex; justify-content:end;">
                            <button onclick="deletedAll()"><i class="m-auto btn-wAll fa fa-trash" ></i></button>
                        
                    </div> 
                    <div class="row m-0 p-0 pb-4 pt-5">
                        <h2 class="p-0 font-weight-bold">Resumen</h2>
                    </div>
                    <div  class="row p-0">
                        <div class="col-6" >
                            <h5 class="m-0">SubTotal :</h5>
                        </div>
                        <div class="col-6" >
                            <h5 id="subtotal" class="m-0 float-right">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h5>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div  class="row pb-4">
                        <div class="col-6 ">
                            <h4 class="m-0 d-flex align-items-center">Total :</h4>
                        </div>
                        <div class="col-6 ">
                            <h4 id="total" class="m-0 float-right">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h4>
                        </div>
                    </div>
                    <div>
                        @if (Auth::check())
                            <form action="{{ route('shop.checkout.checkout')}}" method="POST">
                                {{csrf_field()}}
                                <div onclick="cero()">
                                    <input type="submit" value="Ir a pagar" class="btn btn-block font-weight-bold" @if(sizeof($cartCollection)<=0) disabled @endif style="color:white; background-color:#19A448; border-color:#19A448;"/>
                                </div> 
                            </form>    
                        
                        @else
                        <form action="{{ route('shop.checkout.login')}}" method="get">
                                {{csrf_field()}}
                                <div onclick="cero()">
                                    <input type="submit" value="Ir a pagar" class="btn btn-block font-weight-bold" @if(sizeof($cartCollection)<=0) disabled @endif  style="color:white; background-color:#19A448; border-color:#19A448;"/>
                                </div>
                            </form>    
                        @endif
                    </div>
                    <div class="m-3 d-flex">
                        <a href="{{route('shop.shop')}}" class="m-auto a-dec font-weight-bold ">Seguir comprando</a>
                    </div>



                    <div >


                </div>
                    
            
            </div>
        </div>
    </div>




<script>
    
    const btn_sr = document.querySelectorAll(".btnsor");
    const onclick = function (evento) {
        var id_btn=this.parentElement.id;
        var stock=this.parentElement.name;
        var id_input="input"+id_btn.substring(0, id_btn.indexOf("_"));
        var cant=document.getElementById(id_input);
        var id_div="dsr"+id_btn.substring(0, id_btn.indexOf("_"));
        var divs=document.getElementById(id_div);
        var id_loading=id_btn.substring(0, id_btn.indexOf("_"))+"_icon";
        var divs_loading=document.getElementById(id_loading);
        divs.style.pointerEvents = "none";
        divs_loading.hidden=false;
        cant.style.color="lightgray";

        if(id_btn.slice(-1)=="s"){        
            if(parseInt(cant.value)<parseInt(stock)){
                axios.post("{{route('shop.cart.update')}}",{
                    id: id_btn.substring(0, id_btn.indexOf("_")),
                    quantity: document.getElementById(id_input).value,
                    sor: id_btn.slice(-1)
                })
                .then(function(response) {
                    console.log(response.data);
                    divs.style.pointerEvents = "auto";
                    divs_loading.hidden=true;
                    cant.style.color="black";
                    cant.value=response.data.quantity;
                    document.getElementById("subtotal").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                    document.getElementById("total").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                    document.getElementById("preciototal"+response.data.id).innerHTML="Precio Total: $"+response.data.sumatotal.toLocaleString('de-DE');
                }).catch(function(error) {
                    toastr.error('La acción no se pudo realizar');
                    cant.style.color="black";
                    divs_loading.hidden=true;
                });
            }else{
                divs.style.pointerEvents = "auto";
                cant.style.color="black";
                divs_loading.hidden=true;
                toastr.remove();
                toastr.error('No hay mas stock de este producto.');}
            }

            if(id_btn.slice(-1)=="r"){        
                if(parseInt(cant.value)>1){
                axios.post("{{route('shop.cart.update')}}",{
                    id: id_btn.substring(0, id_btn.indexOf("_")),
                    quantity: document.getElementById(id_input).value,
                    sor: id_btn.slice(-1)
                })
                .then(function(response) {
                    console.log(response.data);
                    divs.style.pointerEvents = "auto";
                    divs_loading.hidden=true;
                    cant.style.color="black";
                    cant.value=response.data.quantity;
                    document.getElementById("subtotal").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                    document.getElementById("total").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                    document.getElementById("preciototal"+response.data.id).innerHTML="Precio Total: $"+response.data.sumatotal.toLocaleString('de-DE');
                }).catch(function(error) {
                    toastr.error('La acción no se pudo realizar');
                    cant.style.color="black";
                    divs_loading.hidden=true;
                });
            }else{
                divs.style.pointerEvents = "auto";
                cant.style.color="black";
                divs_loading.hidden=true;
                toastr.remove();
                toastr.error('Minimo 1 producto en carrito.');
            }
        }
    }
    
    btn_sr.forEach(boton => {
    	boton.addEventListener("click", onclick);
    });
    
    function def(){           
        if({{\Cart::getTotal()}}==0){
            document.querySelector(".btn-comprar").disabled = true;
            toastr.warning('Agregue al menos un Producto al Carrito de Compras para poder Continuar con la Compra.', 'Carro Vacio!', {timeOut: 5000});
        }
    }window.load = def();
    
    function cero(){
        if(document.querySelector(".btn-comprar").disabled){
            toastr.remove();
            toastr.error('Agregue al menos un Producto al Carrito para poder Continuar con la Compra.', 'Carro Vacio!', {timeOut: 5000});
        }
    }

    function deletedAll()
    {
        if({{\Cart::getTotal()}}==0)
        {
            toastr.remove();
            toastr.error('¡Carrito vacio!');
        }else{
            Swal.fire({
                title: '¿Vaciar carrito?',
                text: "¿Estás seguro? ¡no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'green',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("{{ route('shop.cart.clear') }}")
                    .then(function(response)
                    {
                        $('#carro').remove();
                        document.querySelector(".btn-comprar").disabled = true;
                        document.getElementById("subtotal").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                        document.getElementById("total").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                        toastr.remove();
                        toastr.success(response.data.mensaje);
                    })
                    .catch(function(error) {
                        toastr.remove();
                        toastr.error('La acción no se pudo realizar');
                    });
                }
            });
        }
    }

    function deleted(that)
    {
        var id="#div"+that.id;
        Swal.fire({
            title: '¿Eliminar producto?',
            text: "¿Estás seguro? ¡no podrás revertir la acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'green',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post("{{ route('shop.cart.remove') }}", {
                            id: that.id
                })
                .then(function(response)
                {
                    console.log(response.data);

                    $(id).remove();
                    document.getElementById("subtotal").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                    document.getElementById("total").innerHTML="$"+response.data.total.toLocaleString('de-DE');
                    toastr.remove();
                    toastr.success('¡Producto eliminado con exito!');
                })
                .catch(function(error) {
                    toastr.remove();
                    toastr.error('La acción no se pudo realizar');
                });
            }
        });
    }
    

</script>
@endsection