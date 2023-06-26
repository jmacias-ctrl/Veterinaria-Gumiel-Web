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
    <div id="contain" class="container p-0">
        <div class="row m-sm-0 m-4">

            <div class="col-12 p-0">
                <div class="shadow m-2 p-4" style="display:flex; border-radius:2px; background-color:#dbdfe3">
                    <div class="bg-success" style="width:40px;"></div>
                    <div class="px-4" style="display:flex; width:100%; justify-content:space-between;">
                        <div class="d-flex">
                            <h2 class="mb-auto mt-auto text-dark font-weight-bold" style="font-size:24px;">Productos </h2>
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
                        <i style="text-color:gray; font-size:43px;" class="bi-x4 bi-cart-fill"></i>
                        <button onclick="abrir_carro_parcial()" class="btn_carro d-flex float-end" style="height:100%; width:100%; justify-content:center; position:absolute;">
                            <span id="cantcart" class="p-0 text-white font-weight-bold" style="font-size:13px; margin:10px 0 auto 3px;">{{ \Cart::getTotalQuantity() }}</span>
                        </button>
                    </div>
                </div>
    
                <div class="row m-0 p-0" id="productAvailable">
                    @foreach($products as $pro)
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
                                            <input type="submit" onclick="agregar(this)" value="Agregar a carro" class="b_agregar w-100 font-weight-bold"
                                            id="{{$pro->id}}" name="{{$pro->nombre}}" min="{{$pro->precio}}" accept="{{ $pro->imagen_path }}" alt="{{$pro->slug}}"
                                            />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div id="vacio">
                    <div class="d-flex justify-content-center px-2 mt-2">
                        <div class="col-xl-6 col-lg-6 col-sm-10 col-12 bg-white m-0 p-5 shadow" style="text-align: center; border-radius:6px; border:1px solid lightgrey;">
                            <h5 class="h5 font-weight-bold" >No se encontraron productos.</h5>
                            <span class="h5">Para tu busqueda</span>
                            <span class="h5" id="emptysearch"></span>
                            <div class="d-flex justify-content-center mx-5 mt-3 mb-0" style="border-bottom:2px solid black;">
                                <img src="/image/vacio2.png"
                                style="width: 150px; height: 90px; object-fit:cover;"
                                alt="vacio.png">
                            </div>
                            <hr style="background-color:black; opacity:1; height:1.7px; margin:8px 92px;">
                            <hr style="background-color:black; opacity:1; height:1.5px; margin:0 135px;">
                        </div>
                    </div>
                </div>

                <div id="loading" style="position:absolute;" class="w-100">
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

    <div id="navvv" style="position:absolute; width:100%; height:100%;">
        <div  style="display:flex; width:100%; height:100%;">
            <div onclick="cerrar_carro_parcial()" style="background:rgba(23,23,23,0.3); width:100%; height:100%;"></div>
            <div  id="carrito" style="background-color:white; height:100%; width:0;">
            
                <div id="titulo" class="pt-2 pb-3" style="width: 360px; height: 99px;">
                    <div class="shadow p-4 d-flex" style="background-color:#dbdfe3; width: 360px;">
                        <button onclick="cerrar_carro_parcial()">
                            <i style="text-color:gray; font-size:43px;" class="bi bi-x"></i>
                        </button>
                        <h2 class="my-auto text-dark font-weight-bold" style="font-size:24px;">Carrito de compras</h2>
                    </div>
                </div>
                <div id="lista" class="p-0" style="width:360px; ">
                    <div style="width:100%; background-color:ligthGray; height:100%; overflow-y:auto;">
                        <div id="for">
                            @foreach($cartCollection as $item)
                                <div class="row m-0 my-2 mx-2 p-3" style="background-color:white; border-radius:5px; border: 2px solid #ebebeb;">
                                    <div class="p-0 col-3 m-auto" >
                                        <div style="position: relative;">
                                            <img style="max-height:50px; margin:auto;" src="/image/productos/{{ $item->attributes->image }}">
                                            <div class="bg-dark w-7 top-0 h-7 d-flex" style="position: absolute; border-radius:50px; text-align:center;">
                                                <span id="cantfor{{$item->id}}" style="margin:auto;  color:white;">{{ $item->quantity }}</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-9 p-0" >
                                        <h3 class="overflow-ellipsis" style=" white-space: nowrap; overflow: hidden;">
                                            {{$item->attributes->slug}}
                                        </h3>
                                        <spam style="font-size:12px;">precio: ${{number_format($item->price, 0, ',', '.')}}</spam><br>
                                        <spam id="subfor{{$item->id}}" style="font-size:12px;">subtotal: ${{number_format(\Cart::get($item->id)->getPriceSum(), 0, ',', '.')}}</spam>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                                
                <div id="resumen" style="height:39px;">
                    <div style="border-bottom: 1px solid #808080; border-top: 2px solid #808080; height:39px; background-color:#dbdfe3; display:flex; width:100%; ">
                        <button onclick="abrir_resumen()" class="d-flex w-100 h-100 px-4" style=" padding-top:10px; padding-bottom:5px; height:16px; justify-content:space-between;">
                            <h1 class="text-dark font-weight-bold">Resumen de carrito</h1>
                            <span id="icono"><i class="bi bi-chevron-up"></i></span>
                        </button>
                    </div>
                    <div id="cuerpo_resumen" class="px-4 py-3" style="background-color:#dbdfe3;">
                        <div  class="row p-0 m-0">
                            <div class="col-12 p-0" >
                                <div  class="row p-0 m-0">
                                    <div class="col-6 p-0" >
                                        <h5 class="m-0 p-0">SubTotal :</h5>
                                    </div>
                                    <div class="col-6 p-0" >
                                        <h5 id="subtotal" class="m-0 float-right">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                                <hr class="mt-2">
                                <div  class="row py-2 m-0">
                                    <div class="col-6  p-0">
                                        <h4 class="text-success  m-0 d-flex align-items-center font-weight-bold" style="font-size:20px;">Total :</h4>
                                    </div>
                                    <div class="col-6 p-0">
                                        <h4 id="total" class="text-success m-0 float-right font-weight-bold" style="font-size:20px;">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="row p-0 pt-2 m-0">
                            <div class="col-4 pr-1 pl-0" >
                                <a onclick="cerrar_carro_parcial()" class="bg-transparent pb-2 pt-1 btn btn-block font-weight-bold text-secondary border border-secondary" style="border-radius:5px;">Cerrar</a>
                            </div>
                            <div class="col-8 pr-0 pl-1" >
                                <a href="{{route('shop.cart.index')}}" class="ir_carro bg-secondary pb-2 pt-1 btn btn-block font-weight-bold text-white border border-secondary" style="border-radius:5px;">Ir al Carrito</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

<script>
    // captura cambio de tamaño navegador
    window.addEventListener("resize", function(){
        cerrar_carro_parcial();
    });

    function resta(that){
        if(document.getElementById("input_sr"+that.id).value>1){
            document.getElementById("input_sr"+that.id).value--;
        }
    }

    function suma(that){
        if(parseInt(document.getElementById("input_sr"+that.id).value, 10)<parseInt(that.value, 10)){
            document.getElementById("input_sr"+that.id).value++;
        }
    }
    // window.onscroll = function() {
    //     // console.log("el cero         = "+(document.getElementById("foot").getBoundingClientRect().top-window.innerHeight));
    //     // console.log("footer          = "+document.getElementById("foot").getBoundingClientRect().top);
    //     // console.log("scroll        = "+(window.scrollY+500));
    //     // console.log("top container = "+(document.getElementById("contain").getBoundingClientRect().top));
    //     // console.log("top toastsss  = "+(document.getElementById("contain").getBoundingClientRect().y+window.scrollY+100));
    //     // console.log("tam toastsss    = "+document.getElementById("nv").getBoundingClientRect().height);
    //     // console.log("toastsss = "+document.getElementById("nv").getBoundingClientRect().height);
    //     console.log("top head    = "+document.getElementById("head").getBoundingClientRect().top);
    //     console.log("height head = "+document.getElementById("head").getBoundingClientRect().height);
    //     console.log("suma head   = "+(document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().top));
    //     //document.getElementById("toast-container").style.top=(10+window.scrollY+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().top);
        
    // };

    function def(){
        $("#busqueda").val("");
        $("#selectOrden").val("")
        $('#vacio').hide();
        $('#loading').hide();
        $('#navvv').hide();
        $('#nv').hide();
        document.getElementById('cuerpo_resumen').style.display="none";
        

        

    }window.load = def();

    $("#busqueda").on("keyup", function()
    {
        var valueBusqueda = $(this).val().toLowerCase();
        var count=0;
        $("#productAvailable .producto").filter(function() {
            $(this).toggle(($(this).attr('slug').toLowerCase().indexOf(valueBusqueda) > -1))
            if($(this).attr('slug').toLowerCase().indexOf(valueBusqueda) > -1)   count++;
        });
        if(!count){
            $('#vacio').show();
            $("#emptysearch").html("\""+valueBusqueda+"\"");
        }else{
            $('#vacio').hide();
        }
    });

    $("#selectOrden").on('change', function()
    {
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
                    break;
                }
        });
        $("#productAvailable").html(divOrder);
    });

    function agregar(that)
    {
        // document.getElementById("nv_info").style.width="0px";
        var id=that.id;
        var name=that.name;
        var price=that.min;
        var quantity=document.getElementById("input_sr"+that.id).value;
        var image=that.accept;
        var slug=that.alt;
        var pantalla=$(window).scrollTop()+window.innerHeight/3;
        document.getElementById("loading").style.top=pantalla;
        $("#loading").show();
        that.style.backgroundColor="#68c387";
        document.getElementById("productAvailable").style.opacity= 0.9;
        document.getElementById("productAvailable").style.pointerEvents = "none";

        axios.post("{{ route('shop.cart.store') }}", {
            id: id,
            name: name,
            price: price,
            quantity: quantity,
            image: image,
            slug: slug
        })
        .then(function(response)
        {
            that.style.backgroundColor="#19A448";
            document.getElementById("cantcart").innerHTML=response.data.cantcarro;
            $("#loading").hide();
            document.getElementById("input_sr"+that.id).value=1;
            document.getElementById("productAvailable").style.opacity= 1;
            document.getElementById("productAvailable").style.pointerEvents = "auto";
            document.getElementById("subtotal").innerHTML="$"+response.data.total.toLocaleString('de-DE');
            document.getElementById("total").innerHTML="$"+response.data.total.toLocaleString('de-DE');
            if(response.data.tipo_mensaje=="success"){
                
                // $('#nv').show();
                // if((document.getElementById("foot").getBoundingClientRect().top-window.innerHeight)<=0)
                // {
                    
                //     document.getElementById("nv").style.top=(10+window.scrollY+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().top);
                //     // document.getElementById("nv").style.top=(document.getElementById("contain").getBoundingClientRect().height+window.scrollY+100);
                // }else{
                //     document.getElementById("nv").style.top=(window.scrollY+window.innerHeight-document.getElementById("nv").getBoundingClientRect().height-10);
                // }
                // document.getElementById("nv_info").style.width="360px";
                // $("#nv").fadeOut(50000);
                if(response.data.cantidad==response.data.cantidadanterior){
                    document.getElementById('for').innerHTML=document.getElementById('for').innerHTML+
                    '<div class="row m-0 my-2 mx-2 p-3" style="background-color:white; border-radius:5px; border: 2px solid #ebebeb;">'+
                        '<div class="p-0 col-3 m-auto">'+
                            '<div style="position: relative;">'+
                                '<img style="max-height:50px; margin:auto;" src="/image/productos/'+image+'">'+
                                '<div class="bg-dark w-7 top-0 h-7 d-flex" style="position: absolute; border-radius:50px; text-align:center;">'+
                                    '<span id="cantfor'+id+'" style="margin:auto;  color:white;">'+quantity+'</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-9 p-0">'+
                            '<h3 class="overflow-ellipsis" style=" white-space: nowrap; overflow: hidden;">'+slug+'</h3>'+
                            '<spam style="font-size:12px;">precio: $'+price.toLocaleString('de-DE')+'</spam><br>'+
                            '<spam id="subfor'+id+'" style="font-size:12px;">subtotal: $'+response.data.subtotal.toLocaleString('de-DE')+'</spam>'+
                        '</div>'+
                    '</div>';
                }else{
                    document.getElementById('cantfor'+id).innerHTML=response.data.cantidad;
                    document.getElementById('subfor'+id).innerHTML='subtotal: $'+response.data.subtotal.toLocaleString('de-DE');
                }
                

            }                   

        })
        .catch(function(error) {
            toastr.remove();
            toastr.error('La acción no se pudo realizar');
        });
    }

    function abrir_carro_parcial()
    {
        document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-up"></i>';
        document.getElementById("navvv").style.top=(document.getElementById("contain").getBoundingClientRect().y+window.scrollY);
        document.getElementById("navvv").style.height=(window.innerHeight-document.getElementById("contain").getBoundingClientRect().y);
        document.getElementById("lista").style.height=(parseInt(document.getElementById("navvv").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10));
        $('#navvv').show();
        document.getElementById("carrito").style.transition="1s";
        document.getElementById("carrito").style.width="360px";
        document.body.style.overflow = 'hidden';
    }

    function cerrar_carro_parcial()
    {
        document.getElementById("resumen").style.height="39px";
        document.getElementById("lista").style.height=(parseInt(document.getElementById("navvv").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10));
        document.getElementById("navvv").style.transition="1s";
        document.getElementById("carrito").style.width="0px";
        $('#navvv').hide();
        document.getElementById('cuerpo_resumen').style.display="none";
        document.body.style.overflow = 'auto';
    }

    function abrir_resumen()
    {
        if(document.getElementById('cuerpo_resumen').style.display!=""){
            document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-down"></i>';
            document.getElementById("lista").style.transition = "0.5s";
            document.getElementById('cuerpo_resumen').style.display="";
            document.getElementById("resumen").style.height="180px";
        }else{
            document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-up"></i>';
            document.getElementById("lista").style.transition = "0s";
            document.getElementById('cuerpo_resumen').style.display="none";
            document.getElementById("resumen").style.height="39px";
        }
        
        document.getElementById("lista").style.height=(parseInt(document.getElementById("navvv").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10));
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
    .ir_carro:hover{
        background-color: gray;
        color:black;
        outline: none;
    }
    .ir_carro:active{
        background-color:#dbdfe3;
        color:gray;
        outline: none;
    }
    .btn_carro:active{
        border:none;
        outline: none;

    }
    .btn_carro:hover{
        border:none;
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
    .btn-wAll{
            color:black;
            font-size: 20px;
    }
    .btn-wAll:hover{
        color:red;
        outline: none;    
    }
    .btn-wAll:active{
        color:red;
        outline: none;
        font-size: 19px;
    }
    body{

        background:url("/image/fondo-tienda.png");
        background-repeat: repeat;
        background-attachment: fixed;
        background-size:400px;
        backdrop-filter:blur(1px);
    }
</style>