@extends('layouts.appshop')
@section('title')
CARRITO | Veterinaria Gumiel
@endsection
@section('content')
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container pt-2">
        <div class="row justify-content-center">
            <div id="div_productos" class="col-lg-8 p-0 pr-2 pb-2">
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
                    dsr{{$item->id}}
                        <div class="row m-0 mt-3 bg-white" style="border-radius:20px; border:2px solid lightgray;">
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
                            <div class="col-8 p-3">
                                <h3 class="overflow-ellipsis mb-3" style=" white-space: nowrap; overflow: hidden;">
                                    {{$item->name}}
                                </h3>
                                <spam>Precio Unidad: ${{number_format($item->price, 0, ',', '.')}}</spam><br>
                                <spam>Precio Total: ${{number_format(\Cart::get($item->id)->getPriceSum(), 0, ',', '.')}}</spam>
                                    
                                
                            </div>
                            <div class="col-1 pl-0  d-flex align-items-center justify-content-center">
                                <div>
                                    <form action="{{ route('shop.cart.remove') }}"  method="POST" class="m-0"  style="display:flex; justify-content:center; width:50px; height:50px;">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <button  class="btn-w w-100"><i class="fa fa-trash" ></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4 p-0 pl-2">
                <div  class="shadow border mb-3 p-5 card">
                    <div class="m-0 p-0">
                            <button onclick="deleted()" class="p-2"><i class="m-auto btn-wAll fa fa-trash" ></i></button>
                        
                    </div> 
                    <div class="row m-0 p-0 pb-4 pt-5">
                        <h2 class="p-0 font-weight-bold">Resumen</h2>
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
                                <div onclick="cero()">
                                    <input type="submit" value="Ir a pagar" class="btn-comprar btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('shop.checkout.checkout')}}" method="POST">
                                {{csrf_field()}}
                                <div onclick="cero()">
                                    <input type="submit" value="Ir a pagar" class="btn-comprar btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
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
                }).catch(function(error) {
                    toastr.error('La acción no se pudo realizar');
                    cant.style.color="black";
                    divs_loading.hidden=true;

                });
            }else{
                divs.style.pointerEvents = "auto";
                cant.style.color="black";
                divs_loading.hidden=true;
                toastr.clear();
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
                }).catch(function(error) {
                    toastr.error('La acción no se pudo realizar');
                    cant.style.color="black";
                    divs_loading.hidden=true;
                });
            }else{
                divs.style.pointerEvents = "auto";
                cant.style.color="black";
                divs_loading.hidden=true;
                toastr.clear();
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
        if({{\Cart::getTotal()}}==0){
            toastr.clear();
            toastr.error('Agregue al menos un Producto al Carrito de Compras para poder Continuar con la Compra.', 'Carro Vacio!', {timeOut: 5000});
        }
    }
    </script>
@endsection
    <script>
    function deleted()
    {
        if({{\Cart::getTotal()}}==0)
        {
            toastr.clear();
            toastr.error('¡Carrito vacio!');
        }else{
            Swal.fire({
                title: '¿Vaciar carrito?',
                text: "¿Estás seguro? ¡no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'green',
                cancelButtonColor: 'red',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("{{ route('shop.cart.clear') }}")
                    .then(function(response)
                    {
                        toastr.clear();
                        toastr.success('¡Carrito vacio!');
                    })
                    .catch(function(error) {
                        toastr.clear();
                        toastr.error('La acción no se pudo realizar');
                    });
                }
            });
        }
    }
   

</script>
