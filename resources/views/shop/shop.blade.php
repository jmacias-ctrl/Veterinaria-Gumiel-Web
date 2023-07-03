@extends('layouts.app')
@section('title')
Tienda - Veterinaria Gumiel
@endsection
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <div id="contain" class="container p-0" style="min-width:360px;">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div id="barra" class="p-4" style="margin-top:2px; position: -webkit-sticky; position: sticky; top:0; z-index: 2; display:flex; border-radius:2px; background-color:#dbdfe3;">
                    <div id="icono_filtro" style="display:flex; align-items: center;">
                        <button onclick="abrir_filtro_parcial()" class="btn_carro" style="color:gray; transition:0.4s;">
                            <i style="font-size:37px; -webkit-text-stroke: 1px;" class="bi bi-filter-square"></i>
                        </button>
                    </div>
                    <div id="div_cent" style="display:flex; width:100%; justify-content:space-between;">
                        <div id="titulo_b" class="d-flex" style="overflow:hidden; transition:0.4s;">
                            <h1 id="titulo_barra" class="font-weight-bold btn_carro" style="color:gray; font-size:34px; height:43px;">Productos </h1>
                        </div>
                        <div id="busq" class="btn_bf" style="display:flex; justify-content:end; border: 2px solid gray; border-radius:10px; transition:0.4s;">
                            <input type="text" class="fc bg-transparent text-dark border-0 py-2 px-3" style="width:100%" name="texto" id="busqueda" placeholder="Buscar">
                            <div id="btn_lupa" class="input-group-prepend">
                            <i id="lupa" class="my-auto mx-2 bg-transparent bi bi-search" style="-webkit-text-stroke: 1px; color:gray ; transition:0.4s;"></i>
                            </div>
                        </div>
                        <div id="ordenar_por" class="btn_bf ml-4" style="display:flex; border: 2px solid gray; border-radius:10px; transition:0.4s;">
                            <select id="selectOrden_barra" class=" btn_sel pt-2 pr-3 pb-2 pl-3 fc bg-transparent border-0" style="cursor: pointer; transition:0.4s;">
                                <option value="" hidden selected>Ordenar por:</option>
                                <option value="orden_az">Orden alfabético (A - Z)</option>
                                <option value="orden_za">Orden alfabético (Z - A)</option>
                                <option value="menor_precio">Menor precio</option>
                                <option value="mayor_precio">Mayor precio</option>
                                <option value="mejor_puntua">Mejor puntuación</option>
                            </select>
                        </div>
                    </div>
                    <div id="icono_carro" style="display:flex; justify-content:center;">
                        <button onclick="abrir_carro_parcial()" class="btn_carro" style="color:gray; transition:0.4s;">
                            <div style="position:relative; width:41px;">
                                <i style="font-size:43px;" class="bi bi-cart-fill"></i>
                                <div class="ml-1" style="display:flex; justify-content:center; width:90%; position:absolute; top: 10px;">
                                    <span id="cantcart" class="d-flex text-white font-weight-bold" style="font-size:13px;">{{ \Cart::getTotalQuantity() }}</span>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="row m-0">
                    <div id="filtros" style="padding:12px 8px 8px 0; width: 300px; padding-bottom: 8px;" >
                        <div id="barra_filtro" class="shadow" style="background-color:#dbdfe3; border-radius:2px;">
                            <div style="display:flex; padding:22px;">
                                <i style="color:gray; font-size:29px; -webkit-text-stroke: 1px; margin-right: 6px;" class="bi bi-filter"></i>
                                <h1 class="font-weight-bold" style="color:gray; font-size:24px;">Filtros </h1>
                            </div>
                            <div id="filtros_aplicados" style="padding:0 20px; display:none;"></div>
                            <div class="accordion accordion-flush">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <h1 class="font-weight-bold text-dark">Marca</h1>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" style="transition:0.5s" aria-labelledby="flush-headingOne" >
                                        <div class="accordion-body">
                                            @foreach($marcaProductos as $marca)
                                                <div class="form-check">
                                                    <input class="checkbox form-check-input check-marca" type="checkbox" value="{{$marca->id}}" name="{{$marca->nombre}}">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{$marca->nombre}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin:0 20px 0 20px;">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <h1 class="font-weight-bold text-dark">Tipo de producto</h1>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" style="transition:0.5s" aria-labelledby="flush-headingTwo">
                                        <div class="accordion-body">
                                            @foreach($tipoProductos as $tipo)
                                                <div class="form-check mt-1">
                                                    <input class="checkbox form-check-input check-tipo" type="checkbox" value="{{$tipo->id}}" name="{{$tipo->nombre}}">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{$tipo->nombre}}
                                                    </label>
                                                </div>
                                            @endforeach    
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin:0 20px 0 20px;">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            <h1 class="font-weight-bold text-dark">Especie</h1>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" style="transition:0.5s" aria-labelledby="flush-headingThree">
                                        <div class="accordion-body">
                                            @foreach($tipoEspecies as $especie)
                                                <div class="form-check">
                                                    <input class="checkbox form-check-input check-especie" type="checkbox" value="{{$especie->id}}" name="{{$especie->nombre}}">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{$especie->nombre}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin:0 20px 0 20px;">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                            <h1 class="font-weight-bold text-dark">Precio</h1>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse" style="transition:0.5s" aria-labelledby="flush-headingFour">
                                        <div class="accordion-body">
                                            <div class="d-flex">
                                                <input id="input_min" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="sin_borde" type="text" style="width:45%; margin:0 5% 0 0; padding:8px 10px; border-radius:7px; border: 1px solid gray;" placeholder="$ min">
                                                <input id="input_max" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="sin_borde" type="text" style="width:45%; margin:0 0 0 5%; padding:8px 10px; border-radius:7px; border: 1px solid gray;" placeholder="$ max">
                                            </div> 
                                            <p id="error_rango" style="display:none; color:red; font-size:14px;">Mensaje de error</p>
                                            <div id="checks" style="margin-top:20px;">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <div class="form-check">
                                                        <input class="checkbox form-check-input check-precio" type="checkbox">
                                                        <label class="precio-check" for="flexCheckDefault">
                                                        </label>
                                                    </div> 
                                                @endfor
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin:0 20px 0 20px;">
                            </div>
                            <div style="padding:20px;">
                                <a id="aplicar_filtro" onclick="aplicar_filtros()" class="bg-secondary pb-2 pt-1 btn btn-block font-weight-bold text-white border border-secondary" style="border-radius:5px;">Aplicar</a>
                            </div>
                        </div>
                    </div>
                    <div id="for_pro" class="col p-0" >
                        <div class="row m-0" style="padding-top:12px;" id="productAvailable">
                            @foreach($products as $pro)
                                <div class="col_productos producto col" style="padding:0 0 8px 8px;" data-slug="{{ $pro->slug }}" data-marca="{{ $pro->id_marca }}" data-tipo_producto="{{$pro->id_tipo}}" data-especie="{{$pro->producto_enfocado }}" data-precio="{{ $pro->precio }}">
                                    <div class="card">
                                        <div class="card-body">
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
                                                    <h5 class="text-dark m-0 " style=" white-space: nowrap; overflow: hidden;">{{ $pro->slug }}</h5>
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
                                                    <input type="submit" disabled value="Agregar a carro" class="w-100 font-weight-bold" style="padding:6px; border-radius:8px; color:white; background-color:#68c387; border:2px solid white;"/>
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
                        <div id="loading" style="position:absolute;" class="">
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
                        <div id="vacio">
                            <div class="d-flex justify-content-center px-2" style="margin-left: 7%; margin-right: 7%;">
                                <div class="w-100 bg-white m-0 shadow" style="padding:7%; text-align: center; border-radius:6px; border:1px solid lightgrey;">
                                    <div class="overflow-ellipsis " style="background-color:transparent; overflow:hidden;">
                                        <h5 class="h5 font-weight-bold" >No se encontraron productos.</h5>
                                        <span class="h5">Para tu busqueda</span>
                                        <span class="h5" id="emptysearch" style="overflow:hidden;"></span>
                                        <div class="d-flex justify-content-center mt-3 mb-0" style="margin-left: 7%; margin-right:7%; border-bottom:2px solid black;">
                                            <img src="/image/vacio2.png"
                                            style="width: 150px; height: 90px; object-fit:cover;"
                                            alt="vacio.png">
                                        </div>
                                        <hr style="background-color:black; opacity:1; height:1.7px; margin:8px 92px;">
                                        <hr style="background-color:black; opacity:1; height:1.5px; margin:0 135px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div id="nav_carrito" style="z-index: 2; position:absolute; width:100%; height:100%;">
        <div  style="display:flex; width:100%; height:100%;">
            <div id="cerrar" onclick="cerrar_carro_parcial(500)" style="background:rgba(23,23,23,0.3); width:100%; height:100%;"></div>
            <div  id="carrito" style="padding-top: 2px; background-color:white; height:100%; width:0;">

                <div id="titulo" style="width: 360px;">
                    <div class="shadow p-4 d-flex" style="background-color:#dbdfe3;">
                        <button onclick="cerrar_carro_parcial(500)">
                            <i style="color:gray; font-size:43.2px;" class="bi bi-x"></i>
                        </button>
                        <h2 class="my-auto text-dark font-weight-bold" style="font-size:24px;">Carrito de compras</h2>
                    </div>
                </div>
                <div id="lista" style="width:360px;">
                    <div style="height:100%; overflow-y:scroll;">
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
                <div id="resumen" style=" width:360px;">
                    <div id="btn_resumen" class="shadow" style="background-color:#dbdfe3; display:flex; border-bottom:1.4px solid darkgray;">
                        <button onclick="abrir_resumen()" class="d-flex w-100 h-100 px-4 py-3" style="justify-content:space-between;">
                            <h1 class="text-dark font-weight-bold">Resumen de carrito</h1>
                            <div style="width:18px">
                                <span id="icono" style="-webkit-text-stroke: 1px;"><i class="bi bi-chevron-up"></i></span>
                            </div>
                        </button>
                    </div>
                    <div id="cuerpo_resumen" class="px-4 py-3" style="background-color:#dbdfe3;">
                        <div  class="row p-0 m-0">
                            <div class="col-12 p-0" >
                                <div  class="row p-0 m-0">
                                    <div class="col-6 p-0" >
                                        <h1 class="m-0 p-0" style="font-size:14px;">SubTotal :</h1>
                                    </div>
                                    <div class="col-6 p-0" >
                                        <h1 id="subtotal" class="m-0 float-right" style="font-size:14px;">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h1>
                                    </div>
                                </div>
                                <hr class="mt-2">
                                <div  class="row py-2 m-0">
                                    <div class="col-6  p-0">
                                        <h4 class="text-success  m-0 d-flex align-items-center font-weight-bold" style="font-size:16px;">Total :</h4>
                                    </div>
                                    <div class="col-6 p-0">
                                        <h4 id="total" class="text-success m-0 float-right font-weight-bold" style="font-size:16px;">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="row p-0 pt-2 m-0">
                            <div class="col-4 pr-1 pl-0" >
                                <a onclick="cerrar_carro_parcial(500)" class="bg-transparent pb-2 pt-1 btn btn-block font-weight-bold text-secondary border border-secondary" style="border-radius:5px;">Cerrar</a>
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
    <!-- <div id="nav_filtro" style="z-index: 2; position:absolute; width:100%; height:100%;">
        <div  style="display:flex; width:100%; height:100%;">
            <div id="cerrar" onclick="cerrar_carro_parcial(500)" style="background:rgba(23,23,23,0.3); width:100%; height:100%;"></div>
            <div  id="carrito" style="padding-top: 2px; background-color:white; height:100%; width:0;">

                <div id="titulo" style="width: 360px;">
                    <div class="shadow p-4 d-flex" style="background-color:#dbdfe3;">
                        <button onclick="cerrar_carro_parcial(500)">
                            <i style="text-color:gray; font-size:43.2px;" class="bi bi-x"></i>
                        </button>
                        <h2 class="my-auto text-dark font-weight-bold" style="font-size:24px;">Carrito de compras</h2>
                    </div>
                </div>
                <div id="lista" style="width:360px;">
                    <div style="height:100%; overflow-y:scroll;">
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
                <div id="resumen" style=" width:360px;">
                    <div id="btn_resumen" class="shadow" style="background-color:#dbdfe3; display:flex; border-bottom:1.4px solid darkgray;">
                        <button onclick="abrir_resumen()" class="d-flex w-100 h-100 px-4 py-3" style="justify-content:space-between;">
                            <h1 class="text-dark font-weight-bold">Resumen de carrito</h1>
                            <div style="width:18px">
                                <span id="icono" style="-webkit-text-stroke: 1px;"><i class="bi bi-chevron-up"></i></span>
                            </div>
                        </button>
                    </div>
                    <div id="cuerpo_resumen" class="px-4 py-3" style="background-color:#dbdfe3;">
                        <div  class="row p-0 m-0">
                            <div class="col-12 p-0" >
                                <div  class="row p-0 m-0">
                                    <div class="col-6 p-0" >
                                        <h1 class="m-0 p-0" style="font-size:14px;">SubTotal :</h1>
                                    </div>
                                    <div class="col-6 p-0" >
                                        <h1 id="subtotal" class="m-0 float-right" style="font-size:14px;">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h1>
                                    </div>
                                </div>
                                <hr class="mt-2">
                                <div  class="row py-2 m-0">
                                    <div class="col-6  p-0">
                                        <h4 class="text-success  m-0 d-flex align-items-center font-weight-bold" style="font-size:16px;">Total :</h4>
                                    </div>
                                    <div class="col-6 p-0">
                                        <h4 id="total" class="text-success m-0 float-right font-weight-bold" style="font-size:16px;">${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="row p-0 pt-2 m-0">
                            <div class="col-4 pr-1 pl-0" >
                                <a onclick="cerrar_carro_parcial(500)" class="bg-transparent pb-2 pt-1 btn btn-block font-weight-bold text-secondary border border-secondary" style="border-radius:5px;">Cerrar</a>
                            </div>
                            <div class="col-8 pr-0 pl-1" >
                                <a href="{{route('shop.cart.index')}}" class="ir_carro bg-secondary pb-2 pt-1 btn btn-block font-weight-bold text-white border border-secondary" style="border-radius:5px;">Ir al Carrito</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    





<script>
    function init_barra()
    {
       
        
        document.addEventListener("click", function(event) {
            if(window.innerWidth<=639){
            if (!document.getElementById("busq").contains(event.target)) {
                document.getElementById("busq").style.width="35px";
                document.getElementById("busqueda").style.display="none";
                document.getElementById("titulo_b").style.width="166.5px";
            }
            else {
                document.getElementById("busqueda").style.display="";
                document.getElementById("busq").style.width=document.getElementById("div_cent").getBoundingClientRect().width;
                document.getElementById("busq").style.marginLeft="0";
                document.getElementById("titulo_b").style.width="0";

            }}
        });

        document.getElementById("busq").onmouseenter = function (e) {
            if(window.innerWidth<=639){
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width=document.getElementById("div_cent").getBoundingClientRect().width;
            document.getElementById("busq").style.marginLeft="0";
            document.getElementById("titulo_b").style.width="0";
            }
        }
        document.getElementById("titulo_b").style.width="166.5px";

        if(window.innerWidth>1535){
            document.getElementById("icono_filtro").style.display="none";
            document.getElementById("ordenar_por").style.display="";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="476px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";
            // $(".col_productos").attr ("style", "padding:0 0 8px 8px;  width:25%; flex:0 0 auto;");


        }else if(window.innerWidth<=1535 && window.innerWidth>1279){
            document.getElementById("icono_filtro").style.display="none";
            document.getElementById("ordenar_por").style.display="";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="476px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";
            // $(".col_productos").attr ("style", "padding:0 0 8px 8px; width:25%; flex:0 0 auto;");


        }else if(window.innerWidth<=1279 && window.innerWidth>1023){
            document.getElementById("icono_filtro").style.display="none";
            document.getElementById("ordenar_por").style.display="";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="476px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";
            // $(".col_productos").attr ("style", "padding:0 0 8px 8px; width:33.33333%; flex:0 0 auto;");
            

        }else if(window.innerWidth<=1023 && window.innerWidth>767){
            document.getElementById("icono_filtro").style.display="none";
            document.getElementById("ordenar_por").style.display="";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="33%";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";

            // $(".col_productos").attr ("style", "padding:0 0 8px 8px; width:50%; flex:0 0 auto;");
            

        }else if(window.innerWidth<=767 && window.innerWidth>639){
            document.getElementById("icono_filtro").style.display="flex";
            document.getElementById("ordenar_por").style.display="none";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="57%";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_filtro").style.marginRight="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="4px";
            document.getElementById("barra").style.marginRight="4px";
            // $(".col_productos").attr ("style", "padding:4px;  width:50%; flex:0 0 auto;");
            

        }else if(window.innerWidth<=639 && window.innerWidth>575){
            document.getElementById("icono_filtro").style.display="flex";
            document.getElementById("ordenar_por").style.display="none";
            document.getElementById("busqueda").style.display="none";
            document.getElementById("busq").style.width="35px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_filtro").style.marginRight="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="4px";
            document.getElementById("barra").style.marginRight="4px";
            // $(".col_productos").attr ("style", "padding:4px;  width:50%; flex:0 0 auto;");
            

        }else if(window.innerWidth<=575 && window.innerWidth>530){
            document.getElementById("icono_filtro").style.display="flex";
            document.getElementById("ordenar_por").style.display="none";
            document.getElementById("busqueda").style.display="none";
            document.getElementById("busq").style.width="35px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_filtro").style.marginRight="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="4px";
            document.getElementById("barra").style.marginRight="4px";
            // $(".col_productos").attr ("style", "padding:4px;  width:50%; flex:0 0 auto;");
            
        }else if(window.innerWidth<=530 && window.innerWidth>399){
            document.getElementById("icono_filtro").style.display="flex";
            document.getElementById("ordenar_por").style.display="none";
            document.getElementById("busqueda").style.display="none";
            document.getElementById("busq").style.width="35px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_filtro").style.marginRight="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="4px";
            document.getElementById("barra").style.marginRight="4px";
            // $(".col_productos").attr ("style", "padding:8px 15% 0 15%; width:100%;  flex:0 0 auto;");
            
        }else if(window.innerWidth<=399){
            document.getElementById("icono_filtro").style.display="flex";
            document.getElementById("ordenar_por").style.display="none";
            document.getElementById("busqueda").style.display="none";
            document.getElementById("busq").style.width="35px";
            document.getElementById("busq").style.marginLeft="10.5px";
            document.getElementById("icono_filtro").style.marginRight="10.5px";
            document.getElementById("icono_carro").style.marginLeft="10.5px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";
            // $(".col_productos").attr ("style", "padding:8px 5% 0 5%; width:100%; flex:0 0 auto;");


        }
    }

    var max=0,min=parseInt(document.getElementsByClassName('producto')[0].dataset.precio),num_intervalo=5,cards = [];
    function init_filtro()
    {

        document.getElementById("input_min").value="";
        document.getElementById("input_max").value="";
        
        for(var i=0;i<document.getElementsByClassName('producto').length;i++){
            if(parseInt(document.getElementsByClassName('producto')[i].dataset.precio)>max){
                max=document.getElementsByClassName('producto')[i].dataset.precio;
            }
            if(parseInt(document.getElementsByClassName('producto')[i].dataset.precio)<min){
                min=document.getElementsByClassName('producto')[i].dataset.precio;
            }
        }
        for(var i=1;i<=num_intervalo;i++){
            if(i==1){
                document.getElementsByClassName('precio-check')[(i-1)].innerHTML="Menos de $"+parseInt(max/num_intervalo*i).toLocaleString('de-DE');
                document.getElementsByClassName('check-precio')[(i-1)].setAttribute("data-precio_inicial",0);
                document.getElementsByClassName('check-precio')[(i-1)].setAttribute("data-precio_final",max/num_intervalo*i);
            }else if(i==num_intervalo){
                document.getElementsByClassName('precio-check')[(i-1)].innerHTML="Mas de $"+parseInt(max/num_intervalo*(i-1)).toLocaleString('de-DE');
                document.getElementsByClassName('check-precio')[(i-1)].setAttribute("data-precio_inicial",parseInt(max/num_intervalo*(i-1)));
                document.getElementsByClassName('check-precio')[(i-1)].setAttribute("data-precio_final",parseInt(max));
            }else{
                document.getElementsByClassName('precio-check')[(i-1)].innerHTML="Entre $"+parseInt(max/num_intervalo*(i-1)).toLocaleString('de-DE')+" y $"+parseInt(max/num_intervalo*i).toLocaleString('de-DE');
                document.getElementsByClassName('check-precio')[(i-1)].setAttribute("data-precio_inicial",max/num_intervalo*(i-1));
                document.getElementsByClassName('check-precio')[(i-1)].setAttribute("data-precio_final",max/num_intervalo*i);
            }
        }

        if(window.innerWidth>1535){
            document.getElementById('filtros').style.display="";
            document.getElementById('filtros').style.width="300px";
            document.getElementById('for_pro').style.width=document.getElementById('barra').getBoundingClientRect().width-document.getElementById('filtros').getBoundingClientRect().width;
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="24px";}
            document.getElementById("loading").style.left=8;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-8);
        
        }else if(window.innerWidth<=1535 && window.innerWidth>1279){
            document.getElementById('filtros').style.display="";
            document.getElementById('filtros').style.width="260px";
            document.getElementById('for_pro').style.width=document.getElementById('barra').getBoundingClientRect().width-document.getElementById('filtros').getBoundingClientRect().width;
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="20px";}
            document.getElementById("loading").style.left=8;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-8);
        }else if(window.innerWidth<=1279 && window.innerWidth>1023){
            
        
            document.getElementById('filtros').style.display="";
            document.getElementById('filtros').style.width="250px";
            document.getElementById('for_pro').style.width=document.getElementById('barra').getBoundingClientRect().width-document.getElementById('filtros').getBoundingClientRect().width;
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="22px";}
            document.getElementById("loading").style.left=8;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-8);
        }else if(window.innerWidth<=1023 && window.innerWidth>767){
            document.getElementById('filtros').style.display="";
            document.getElementById('filtros').style.width="240px";
            document.getElementById('for_pro').style.width=document.getElementById('barra').getBoundingClientRect().width-document.getElementById('filtros').getBoundingClientRect().width;
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="24px";}
            document.getElementById("loading").style.left=8;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-8);
        }else if(window.innerWidth<=767 && window.innerWidth>639){
            document.getElementById('filtros').style.display="none";
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="32px";}
            document.getElementById("loading").style.left=4;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-4);
        }else if(window.innerWidth<=639 && window.innerWidth>575){
            document.getElementById('filtros').style.display="none";
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="24px";}
            document.getElementById("loading").style.left=4;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-4);
        }else if(window.innerWidth<=575 && window.innerWidth>399){
            document.getElementById('filtros').style.display="none";
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="32px";}
            document.getElementById("loading").style.left=4;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-4);
        }else if(window.innerWidth<=399){
            document.getElementById('filtros').style.display="none";
            for(var j=0;j<document.getElementsByClassName('card-body').length;j++){ document.getElementsByClassName('card-body')[j].style.padding="32px";}
            document.getElementById("loading").style.left=4;
            document.getElementById("loading").style.width=(document.getElementById("for_pro").getBoundingClientRect().width-4);
        }

    }

    // captura cambio de tamaño navegador
    window.addEventListener("resize", function()
    {
        init_barra();
        init_filtro();
        cerrar_carro_parcial(0);
        document.getElementById("barra").style.top=(2+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().y);
    });

    window.onscroll = function() 
    {
        if((document.getElementById("barra_filtro").getBoundingClientRect().height+12+document.getElementById("barra").getBoundingClientRect().height+document.getElementById("barra").getBoundingClientRect().top)<window.innerHeight){
            document.getElementById("barra_filtro").style.top=(12+document.getElementById("barra").getBoundingClientRect().height+document.getElementById("barra").getBoundingClientRect().top);
           
            
        }else{
            document.getElementById("barra_filtro").style.top=(window.innerHeight-document.getElementById("barra_filtro").getBoundingClientRect().height);
            
        }
        document.getElementById("barra").style.top=(2+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().y);
       
    };
    
    function def()
    {
        if((document.getElementById("barra_filtro").getBoundingClientRect().height+12+document.getElementById("barra").getBoundingClientRect().height+document.getElementById("barra").getBoundingClientRect().top)<window.innerHeight){
            document.getElementById("barra_filtro").style.top=(12+document.getElementById("barra").getBoundingClientRect().height+document.getElementById("barra").getBoundingClientRect().top);
        }else{
            document.getElementById("barra_filtro").style.top=(window.innerHeight-document.getElementById("barra_filtro").getBoundingClientRect().height);
            
        }
        document.getElementById("barra").style.top=(2+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().y);

        init_barra();
        init_filtro();
        $("#busqueda").val("");
        $("#selectOrden_barra").val("");
        $('#vacio').hide();
        $('#loading').hide();
        $('#nav_carrito').hide();
        $('#nv').hide();
        document.getElementById('cuerpo_resumen').style.display="none";
        for(var j=0;j<document.getElementsByClassName('producto').length;j++){ cards[j]=true;}
        for(var i=0; i<document.getElementsByClassName("checkbox").length; i++){ document.getElementsByClassName("checkbox")[i].checked =false; }

    }window.load = def();

    function aplicar_filtros()
    {
        var marcas = [];
        var tipos = [];
        var especies = [];
        var precios_inicial = [];
        var precios_final = [];
        var precio = [];
        var aplicados = [];
    
        document.getElementById("busqueda").value="";
        document.getElementById('error_rango').style.display="none";

        document.getElementById('checks').style.display="";


        for(var i=0; i<document.getElementsByClassName("check-marca").length; i++)
        {
            if(!document.getElementsByClassName("check-marca")[i].checked){
                marcas.push(document.getElementsByClassName("check-marca")[i].value.toLowerCase());
            }else{
                aplicados.push("Marca: "+document.getElementsByClassName("check-marca")[i].name);
            }
        }

        for(var i=0; i<document.getElementsByClassName("check-tipo").length; i++)
        {
            if(!document.getElementsByClassName("check-tipo")[i].checked){
                tipos.push(document.getElementsByClassName("check-tipo")[i].value.toLowerCase());
            }else{
                aplicados.push("Tipo: "+document.getElementsByClassName("check-tipo")[i].name);
            }
        }

        for(var i=0; i<document.getElementsByClassName("check-especie").length; i++)
        {
            if(!document.getElementsByClassName("check-especie")[i].checked){
                especies.push(document.getElementsByClassName("check-especie")[i].value.toLowerCase());
            }else{
                aplicados.push("Especie: "+document.getElementsByClassName("check-especie")[i].name);
            }
        }

        for(var i=0; i<document.getElementsByClassName("check-precio").length; i++)
        {
            if(document.getElementsByClassName("check-precio")[i].checked){
                precios_inicial.push(document.getElementsByClassName("check-precio")[i].getAttribute("data-precio_inicial"));
                precios_final.push(document.getElementsByClassName("check-precio")[i].getAttribute("data-precio_final"));
                if(document.getElementById('input_min').value===""&&document.getElementById('input_max').value===""){
                    aplicados.push("precio: $"+parseInt(document.getElementsByClassName("check-precio")[i].getAttribute("data-precio_inicial")).toLocaleString('de-DE')+" - $"+parseInt(document.getElementsByClassName("check-precio")[i].getAttribute("data-precio_final")).toLocaleString('de-DE'));
                }
            }
        }
      
        if(document.getElementById('input_min').value!=""&&document.getElementById('input_max').value===""){
            if(parseInt(document.getElementById('input_min').value)<=max){
                aplicados.push("precio: $"+parseInt(document.getElementById('input_min').value).toLocaleString('de-DE')+" - $"+parseInt(max).toLocaleString('de-DE'));
            }else{
                document.getElementById('input_min').value="";
                document.getElementById('input_max').value="";
                document.getElementById('error_rango').style.display="";
                document.getElementById('error_rango').innerHTML="Valor minimo debe ser menor a $"+parseInt(max).toLocaleString('de-DE');
            }
        }else if(document.getElementById('input_min').value===""&&document.getElementById('input_max').value!=""){
            if(parseInt(document.getElementById('input_max').value)>=min){
                aplicados.push("precio: $"+parseInt(min).toLocaleString('de-DE')+" - $"+parseInt(document.getElementById('input_max').value).toLocaleString('de-DE'));
            }else{
                document.getElementById('input_min').value="";
                document.getElementById('input_max').value="";
                document.getElementById('error_rango').style.display="";
                document.getElementById('error_rango').innerHTML="Valor maximo debe ser mayor a $"+parseInt(min).toLocaleString('de-DE');
            }
        }else if(document.getElementById('input_min').value!=""&&document.getElementById('input_max').value!=""){
            if(parseInt(document.getElementById('input_max').value)>=parseInt(document.getElementById('input_min').value)){
                aplicados.push("precio: $"+parseInt(document.getElementById('input_min').value).toLocaleString('de-DE')+" - $"+parseInt(document.getElementById('input_max').value).toLocaleString('de-DE'));
            }else{
                document.getElementById('input_min').value="";
                document.getElementById('input_max').value="";
                document.getElementById('error_rango').style.display="";
                document.getElementById('error_rango').innerHTML="Valor maximo debe ser mayor a valor minino";

            }
        }
        
        for(var j=0;j<document.getElementsByClassName('producto').length;j++){
            document.getElementsByClassName('producto')[j].style.display="";
        }

        if(document.getElementsByClassName("check-marca").length!=marcas.length){
            for(var i=0;i<marcas.length;i++){
                for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                    if(document.getElementsByClassName('producto')[j].getAttribute("data-marca").toLowerCase()===marcas[i]){
                        document.getElementsByClassName('producto')[j].style.display="none";
                    }
                }
            }
        }

        if(document.getElementsByClassName("check-tipo").length!=tipos.length){
            for(var i=0;i<tipos.length;i++){
                for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                    if(document.getElementsByClassName('producto')[j].getAttribute("data-tipo_producto").toLowerCase()===tipos[i]){
                        document.getElementsByClassName('producto')[j].style.display="none";
                    }
                }
            }
        }

        if(document.getElementsByClassName("check-especie").length!=especies.length){
            for(var i=0;i<especies.length;i++){
                for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                    if(document.getElementsByClassName('producto')[j].getAttribute("data-especie").toLowerCase()===especies[i]){
                        document.getElementsByClassName('producto')[j].style.display="none";
                    }
                }
            }
        }
        if(precios_inicial.length!=0||document.getElementById('input_min').value!=""||document.getElementById('input_max').value!=""){
        
            if(document.getElementById('input_min').value===""&&document.getElementById('input_max').value===""){
                if(precios_inicial.length!=0){

                    for(var i=0;i<precios_inicial.length;i++){
                        for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                            if(parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))>parseInt(precios_inicial[i]) && parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))<=parseInt(precios_final[i])){
                                precio[j]=true;

                            }
                        }
                        
                    }
                }
            }else{
                
                if(document.getElementById('input_min').value!=""&&document.getElementById('input_max').value===""){
                    
                    for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                        if(parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))>=parseInt(document.getElementById("input_min").value) && parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))<=max){
                            precio[j]=true;
                            
                        }
                    }
                    
                }else if(document.getElementById('input_min').value===""&&document.getElementById('input_max').value!=""){
                    for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                        if(parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))>=min && parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))<=parseInt(document.getElementById("input_max").value)){
                            precio[j]=true;

                        }
                    }
                }else if(document.getElementById('input_min').value!=""&&document.getElementById('input_max').value!=""){
                    for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                        if(parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))>=parseInt(document.getElementById("input_min").value) && parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))<=parseInt(document.getElementById("input_max").value)){
                            precio[j]=true;
                        }
                    }
                }
            
            }

            for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                if(!precio[j]){
                    document.getElementsByClassName('producto')[j].style.display="none";
                }
            }
        }


        for(var j=0;j<document.getElementsByClassName('producto').length;j++){
            if(document.getElementsByClassName('producto')[j].style.display==="none"){
                cards[j]=false;
            }else{
                cards[j]=true;
            }
        }
        
        if(aplicados.length>0){
            document.getElementById("filtros_aplicados").style.display="";
            document.getElementById("filtros_aplicados").innerHTML="";
            document.getElementById("filtros_aplicados").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Filtros Aplicados</h1> <button onclick='borrar_filtros()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            for(var i=0;i<aplicados.length;i++){
                document.getElementById("filtros_aplicados").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados[i]+"</p>";
            }
            document.getElementById("filtros_aplicados").innerHTML+="<hr style='margin-top:16px;'>";

        }else{
            document.getElementById("filtros_aplicados").style.display="none";

        }
        document.getElementById('input_min').value="";
        document.getElementById('input_max').value="";
        var vacio=true;
        for(var i=0;i<cards.length;i++){
            if(cards[i]===true){
                vacio=false;
                break;
                
            }
        }
        if(vacio){
            $('#vacio').show();

        }else{
            $('#vacio').hide();

        }
        console.log(cards);

    }

    function borrar_filtros()
    {
        document.getElementById('input_min').value="";
        document.getElementById('input_max').value="";
        document.getElementById('checks').style.display="";
        for(var i=0; i<document.getElementsByClassName("checkbox").length; i++){ document.getElementsByClassName("checkbox")[i].checked =false; }
        aplicar_filtros();
    }

    $("#input_min").on("keyup", function()
    {
        document.getElementById('error_rango').style.display="none";
        if($(this).val()===""&&$("#input_max").val()===""){
            document.getElementById("checks").style.display="";
        }else{
            document.getElementById("checks").style.display="none";
        }
    });

    $("#input_max").on("keyup", function()
    {
        document.getElementById('error_rango').style.display="none";
        if($(this).val()===""&&$("#input_min").val()===""){
            document.getElementById("checks").style.display="";
        }else{
            document.getElementById("checks").style.display="none";
        }
    });


    $("#busqueda").on("keyup", function()
    {
        var valueBusqueda = $(this).val().toLowerCase();
        var vacio=false;
        for(var j=0;j<document.getElementsByClassName('producto').length;j++){
            if(document.getElementsByClassName('producto')[j].getAttribute("data-slug").toLowerCase().indexOf(valueBusqueda) === -1){
                document.getElementsByClassName('producto')[j].style.display="none";
            }else{
                if(cards[j]===true){
                    document.getElementsByClassName('producto')[j].style.display="";
                    vacio=true;
                }
            }
                
        }
       
        if(!vacio){
            $('#vacio').show();
            $("#emptysearch").html("\""+valueBusqueda+"\"");

        }else{
            $('#vacio').hide();

        }

        
    });
    
    
    $("#selectOrden_barra").on('change', function(){
        var value=$("#selectOrden_barra").val();
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
                    alert("aun no hay");
                    break;
                }
        });
        $("#productAvailable").html(divOrder);
    });

    function resta(that)
    {
        if(document.getElementById("input_sr"+that.id).value>1){
            document.getElementById("input_sr"+that.id).value--;
        }
    }

    function suma(that)
    {
        if(parseInt(document.getElementById("input_sr"+that.id).value, 10)<parseInt(that.value, 10)){
            document.getElementById("input_sr"+that.id).value++;
        }
    }
    
    function agregar(that)
    {
        var id=that.id;
        var name=that.name;
        var price=that.min;
        var quantity=document.getElementById("input_sr"+that.id).value;
        var image=that.accept;
        var slug=that.alt; 
        document.getElementById("loading").style.top=(document.getElementById("barra").getBoundingClientRect().top+window.scrollY);

        $("#loading").show();
        that.style.backgroundColor="#68c387";
        document.getElementById("productAvailable").style.opacity= 0.4;
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

    // function abrir_filtro_parcial()
    // {   document.getElementById("titulo").style.height="91.2px";
    //     document.getElementById("resumen").style.height="53.8px";
    //     document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-up"></i>';
    //     document.getElementById("nav_carrito").style.top=(window.scrollY+document.getElementById("barra").getBoundingClientRect().top-2);
    //     document.getElementById("nav_carrito").style.height=(window.innerHeight-(document.getElementById("barra").getBoundingClientRect().top-2));
    //     document.getElementById("lista").style.height=(parseInt(document.getElementById("nav_carrito").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10)-2);
    //     $('#nav_carrito').show();
    //     document.getElementById("carrito").style.transition="1s";
    //     document.getElementById("carrito").style.width="360px";
    //     document.body.style.overflow = 'hidden';
    // }

    function abrir_carro_parcial()
    {   document.getElementById("titulo").style.height="91.2px";
        document.getElementById("resumen").style.height="53.8px";
        document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-up"></i>';
        document.getElementById("nav_carrito").style.top=(window.scrollY+document.getElementById("barra").getBoundingClientRect().top-2);
        document.getElementById("nav_carrito").style.height=(window.innerHeight-(document.getElementById("barra").getBoundingClientRect().top-2));
        document.getElementById("lista").style.height=(parseInt(document.getElementById("nav_carrito").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10)-2);
        $('#nav_carrito').show();
        document.getElementById("carrito").style.transition="1s";
        document.getElementById("carrito").style.width="360px";
        document.body.style.overflow = 'hidden';
    }

    function cerrar_carro_parcial(delay_val)
    {
        $("#nav_carrito").delay(delay_val).fadeOut();
        $("#cuerpo_resumen").delay(500).fadeOut();
        document.getElementById("resumen").style.height="53.8px";
        document.getElementById("lista").style.height=(parseInt(document.getElementById("nav_carrito").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10));
        document.getElementById("carrito").style.width="0px";
        document.body.style.overflow = 'auto';
    }

    function abrir_resumen()
    {
        if(document.getElementById('cuerpo_resumen').style.display!=""){
            document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-down"></i>';
            document.getElementById("lista").style.transition = "0.5s";
            document.getElementById('cuerpo_resumen').style.display="";
            document.getElementById("resumen").style.height="191.8px";
        }else{
            document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-up"></i>';
            $("#cuerpo_resumen").delay(500).fadeOut();
            document.getElementById("resumen").style.height="53.8px";
        }
            document.getElementById("lista").style.height=(parseInt(document.getElementById("nav_carrito").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10));
    }



</script>

@endsection


<style>

    .fc:focus{
        outline: none;
    }
    .sin_borde:hover{
        outline: none;

    }
    .sin_borde:focus{
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

    #aplicar_filtro:active{
        background-color:#6c757d !important;
        border: 1px solid #dbdfe3 !important;
    }

    .accordion-button{
        background-color: transparent !important;
        box-shadow: none !important;
    }

    .accordion-item{
        background-color: transparent !important;
        border-bottom:0 !important;

    }

    .btn_carro:active{
        border:none;
        outline: none;

    }
    .btn_carro:hover{
        color:black !important;
        border:none;
        outline: none;

    }

    .btn_bf:hover{
        border:2px solid black !important;
    }
    .btn_sel:hover{
        color:black !important;
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

    #icono:hover{
        color: black;
        font-size:18px;

    }
    #icono:active{
        color: black;
        font-size:16px;

    }
    .col_productos{
            padding:8px 5% 0 5% !important;
            width:100% !important;
            flex:0 0 auto !important;
        }
    @media only screen and (min-width: 400px) {
        .col_productos{
            padding:8px 15% 0 15% !important;
            width:100% !important;
        }
        
    }
    @media only screen and (min-width: 531px) {
        .col_productos{
            padding:4px !important;
            width:50% !important;
        }
        
    }
    @media only screen and (min-width: 768px) {
        .col_productos{
            padding:0 0 8px 8px !important;
            width:50% !important;
        }
        
    }
    @media only screen and (min-width: 1024px) {
        .col_productos{
            padding:0 0 8px 8px !important;
            width:33.33333% !important;
        }
        
    }
    @media only screen and (min-width: 1280px) {
        .col_productos{
            padding:0 0 8px 8px !important;
            width:25% !important;
        }
        
    }
    
    

    body{

        background:url("/image/fondo-tienda.png");
        background-repeat: repeat;
        background-attachment: fixed;
        background-size:400px;
        background-color:rgba(12,12,12,0.2) !important;
        backdrop-filter:blur(1px);
    }
</style>