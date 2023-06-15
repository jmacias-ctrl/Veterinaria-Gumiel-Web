@extends('layouts.app')
@section('title')
Tienda - Veterinaria Gumiel
@endsection
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>



<!-- <div class="">
    <select name="" id="selectMarca" class="form-control">
        <option value="">Todas las marcas</option>
        @foreach ($marcaProductos as $item)
            <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
        @endforeach
    </select>

</div> -->

    <div class="container p-0 w-90">
        <div class="row m-sm-0 m-4">
            <div class="col-lg-12 p-0">
                <div class="p-2">
                    <div class="shadow p-4" style="display:flex; border-radius:2px; background-color:#dbdfe3">
                        <div class="bg-success" style="width:40px;"></div>
                        <div class="px-4" style="display:flex; width:100%; justify-content:space-between;">    
                            <div class="d-flex">
                                <h2 class="mb-auto mt-auto text-dark font-weight-bold">Productos </h2>
                            </div>
                            <div style="display:flex; border: 2px solid gray; border-radius:10px;">
                                <input type="text" class="py-2 px-3 fc bg-transparent text-dark border-0" name="texto" id="busqueda" placeholder="Buscar">
                                <div class="input-group-prepend">
                                <i class="my-auto mx-2 bg-transparent text-dark bi bi-search"></i>
                                </div>
                            </div>
                            <div style="display:flex; border: 2px solid gray; border-radius:10px;">
                                <select id="selectOrden" class="pt-2 pr-3 pb-2 pl-3 fc bg-transparent text-dark border-0">
                                    <option value="" hidden selected>Ordenar por:</option>
                                    <option value="orden_az">Orden alfabético (A - Z)</option>
                                    <option value="orden_za">Orden alfabético (Z - A)</option>
                                    <option value="menor_precio">Menor precio</option>
                                    <option value="mayor_precio">Mayor precio</option>
                                    <option value="mejor_puntua">Mejor puntuación</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex" style="position:relative;">
                            <span style="font-size:43px;">
                                <i style="text-color:gray;" class="bi-x4 bi-cart-fill"></i>
                            </span>
                            <button class="d-flex" style="height:100%; width:100%; justify-content:center; position:absolute;">
                                <span id="cantcart" class="text-white font-weight-bold" style="font-size:13px; display:flex; align-items: center;margin-left: 3px;">{{ \Cart::getTotalQuantity() }}</span>
                            </button>
                        </div>
                    </div>
                </div>    
                <div class="row m-0 p-0" id="productAvailable">
                    @foreach($products as $pro)
                        <input type="hidden" id="input{{$pro->id}}" name="{{$pro->nombre}}" value="{{$pro->precio}}" accept="{{ $pro->imagen_path }}" alt="{{$pro->slug}}">
                        <div class="col-xl-3 col-lg-4 col-sm-6 p-2 producto" slug="{{ $pro->slug }}" marca="{{ $pro->marca }}" data-precio="{{ $pro->precio }}" data-slug="{{ $pro->slug }}">
                            <div class="card">
                                <div class="card-body p-sm-4 p-5">
                                    <a href="{{ route('shop.show' ,['id'=>$pro->id]) }}" style="text-decoration:none;">
                                        @if (!$pro->stock)
                                        <div style="display:flex; justify-content:center;  position:relative;">
                                            <img  src="/image/productos/{{ $pro->imagen_path }}"
                                            style="height:150px; filter: grayscale(100%);"
                                            alt="{{ $pro->imagen_path }}">
                                        </div>
                                        @else
                                        <div style="display:flex; justify-content:center;  position:relative;">
                                            <img src="/image/productos/{{ $pro->imagen_path }}"
                                            style="height:150px;"
                                            alt="{{ $pro->imagen_path }}">
                                        </div>
                                        @endif
                                        <div>
                                            <h5 class="text-dark m-0 overflow-ellipsis " style=" white-space: nowrap; overflow: hidden;">{{ $pro->slug }}</h5>
                                            <span class="text-dark overflow-ellipsis font-weight-bold" style=" white-space: nowrap; overflow: hidden;">{{ $pro->marca }}</span>
                                        </div>
                                    </a>
                                    <div class="mt-3 mb-2" style="display:flex;">
                                        <p style=" pointer-events:none; margin:6px auto 6px 0;">${{number_format($pro->precio, 0, ',', '.')}}</p>
                                        @if (!$pro->stock)
                                        <div style="display:flex; pointer-events:none;">
                                            <p class="my-auto font-weight-bold">Producto agotado</p>
                                        </div>
                                        @else
                                        <div>
                                            <div class="btn-group h-100">
                                                <button onclick="resta(this)" id="{{$pro->id}}" class="btn_add" style="padding:0 10.3px 0 10.3px; border-radius:50px;"><i class=" bi bi-dash"></i></button>
                                                <input id="input_sr{{$pro->id}}" type="text" maxlength="3" class="fc mx-1 w-14" style=" pointer-events:none; text-align:center; border-radius:50px; border: 1px solid lightgray" autocomplete="off" value="1" onkeypress="if(this.value.charAt(0)=='') return (event.charCode >= 49 && event.charCode <= 57); else return (event.charCode >= 48 && event.charCode <= 57);"/>
                                                <button onclick="suma(this)" value="{{$pro->stock}}" id="{{$pro->id}}" class="btn_add" style="padding:0 10.3px 0 10.3px; border-radius:50px;"><i class=" bi bi-plus"></i></button>
                                            </div>    
                                        </div>
                                        @endif
                                    </div>
                                    <div class="d-flex">
                                        @if (!$pro->stock)
                                            <input type="submit" disabled value="Agregar a carro" class="w-100 font-weight-bold" style="padding:6px; border-radius:8px; color:white; background-color:#68c387; border:1px solid white;"/>
                                        @else
                                            <input type="submit" onclick="agregar(this)" id="{{$pro->id}}" value="Agregar a carro" class="b_agregar w-100 font-weight-bold"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="vacio">
                        <div class="d-flex justify-content-center px-2 mt-2">
                            <div class="col-xl-6 col-lg-6 col-sm-10 col-12 bg-white m-0 p-5 shadow" style="text-align: center; border-radius:6px; border:1px solid lightgrey;">
                                <h3 class="font-weight-bold" >No se encontraron productos.</h3>
                                <span class="h5">Para tu busqueda</span>
                                <span class="h5" id="emptysearch"></span>
                                <div class="d-flex justify-content-center m-3">
                                    <img src="/image/vacio.png"
                                    style="width: 150px; height: 90px; object-fit:cover;"
                                    alt="vacio.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="loading" style="position:absolute;">
                        <div style="display: flex; margin:0 auto; justify-content: center;">
                            <div class="spinner-grow text-primary mx-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-dark mx-2" style="opacity:1;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-secondary mx-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-primary mx-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-secondary mx-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-dark mx-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-primary mx-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 



<script>
    
 



// prueba fin
    function resta(that){
        if(document.getElementById("input_sr"+that.id).value>1){
            document.getElementById("input_sr"+that.id).value--;
            
        }
    }

    function suma(that){
        console.log(document.getElementById("input_sr"+that.id).value);
        console.log(that.value);
        if(parseInt(document.getElementById("input_sr"+that.id).value, 10)<parseInt(that.value, 10)){
            document.getElementById("input_sr"+that.id).value++;

        }
    }

    

    function def(){           
        $("#busqueda").val("");
        $("#selectOrden").val("")
        $('#vacio').hide();
        $('#loading').hide();
        
    }window.load = def();

    $("#busqueda").on("keyup", function() {
        var valueBusqueda = $(this).val().toLowerCase();
        var count=0;
        $("#productAvailable .producto").filter(function() {
            $(this).toggle(($(this).attr('slug').toLowerCase().indexOf(valueBusqueda) > -1))
            if($(this).attr('slug').toLowerCase().indexOf(valueBusqueda) > -1)   count++; 
        });
        console.log("count: "+count);
        if(!count){
            $('#vacio').show();
            $("#emptysearch").html("\""+valueBusqueda+"\"");
        }else{
            $('#vacio').hide();
        }
    });

    $("#selectOrden").on('change', function() {
        var value=$("#selectOrden").val();
        var divOrder = $("#productAvailable .producto").sort(function (a, b) {
            switch (value) {
                case "orden_az":
                    return $(a).data("slug").toLowerCase() > $(b).data("slug").toLowerCase()?1:-1;
                    break;

                case "orden_za":
                    return $(a).data("slug").toLowerCase() > $(b).data("slug").toLowerCase()?-1:1;
                    break;

                case "menor_precio":
                    return $(a).data("precio") > $(b).data("precio")?1:-1;
                    break;

                case "mayor_precio":
                    return $(a).data("precio") > $(b).data("precio")?-1:1;
                    break;

                case "mejor_puntua":
                    console.log("Mejor puntuación");
                    break;
                }
        });
        $("#productAvailable").html(divOrder);
    });

    function agregar(that){
        var id=that.id;
        console.log(id);
        console.log({{$products[2]->stock}});
        // var name=document.getElementById("input"+that.id).name;
        // var price=document.getElementById("input"+that.id).value;
        // var quantity=document.getElementById("input_sr"+that.id).value;
        // var image=document.getElementById("input"+that.id).accept;
        // var slug=document.getElementById("input"+that.id).alt;
        // var pantalla=$(window).scrollTop()+window.innerHeight/4;
        // document.getElementById("loading").style.top =pantalla;
        // $("#loading").show();
        // that.style.backgroundColor="#68c387";
        // document.getElementById("productAvailable").style.opacity= 0.9;
        // document.getElementById("productAvailable").style.pointerEvents = "none";

        // axios.post("{{ route('shop.cart.store') }}", {
        //     id: id,
        //     name: name,
        //     price: price,
        //     quantity: quantity,
        //     image: image,
        //     slug: slug
        // })
        // .then(function(response)
        // {
        //     that.style.backgroundColor="#19A448";
        //     document.getElementById("cantcart").innerHTML=response.data.carro;
        //     toastr.remove();
        //     $("#loading").hide();
        //     document.getElementById("input_sr"+that.id).value=1;
        //     document.getElementById("productAvailable").style.opacity= 1;
        //     document.getElementById("productAvailable").style.pointerEvents = "auto";
        //     if(response.data.tipo_mensaje=="error") toastr.error(response.data.mensaje);
        //     if(response.data.tipo_mensaje=="warning") toastr.warning(response.data.mensaje);
        //     if(response.data.tipo_mensaje=="success") toastr.success(response.data.mensaje);
        // })
        // .catch(function(error) {
        //     toastr.remove();
        //     toastr.error('La acción no se pudo realizar');
        // });
    }

</script>

@endsection
<style>
    
    .fc:focus{
          outline: none;
    }
    .btn_add{
        background-color:#dbdfe3;
        color:black;
        transition:0.2s;

    }
    .btn_add:hover{
        background-color: gray;
        color:black;
        outline: none;    
    }
    .btn_add:active{
        background-color:#dbdfe3;
        color:gray;
        outline: none;
    }
    .b_agregar{
        color:white;
        background-color:#19A448;
        border:2px solid white;
        border-radius:8px;
        padding:6px;
        transition:0.2s;
        

    }
    .b_agregar:hover{
        background-color:#19A448;
        border:2px solid #19A448;

    }
    .b_agregar:active{
        background-color:#68c387;
        border:2px solid white;



    }
    body{
        background:url("/image/fondo-tienda.png");
        background-repeat: repeat;
        background-attachment: fixed;
        background-size:400px;
        backdrop-filter:blur(1px);
    }
</style>