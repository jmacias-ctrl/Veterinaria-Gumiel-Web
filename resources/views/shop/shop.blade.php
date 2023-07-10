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
                <div id="barra" class="p-4 shadow" style="margin-top:2px; position: -webkit-sticky; position: sticky; top:0; z-index: 2; display:flex; border-radius:2px; background-color:#f3f4f5;">
                    <div id="icono_filtro" style="display:flex; align-items: center;">
                        <button onclick="abrir_catfil_parcial()" class="btn_carro" style="color:gray; transition:0.4s;">
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
                        <div id="barra_categorias" class="shadow" style="background-color:#f3f4f5; border-radius:2px;">
                            <div style="display:flex; padding:22px;">
                                <i style="color:gray; font-size:29px; -webkit-text-stroke: 1px; margin-right: 6px;" class="bi bi-filter"></i>
                                <h1 class="font-weight-bold" style="color:gray; font-size:24px;">Categorías </h1>
                            </div>
                            <div id="categorias_aplicados" style="padding:0 20px; display:none;"></div>
                            <div class="accordion accordion-flush">
                                @foreach ($categorias as $cat)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cat{{$cat->id}}" aria-expanded="false" aria-controls="cat{{$cat->id}}">
                                                <h1 class="font-weight-bold text-dark">{{$cat->nombre}}</h1>
                                            </button>
                                        </h2>
                                        <div id="cat{{$cat->id}}" class="accordion-collapse accordionCat collapse" style="transition:0.5s" aria-labelledby="cat{{$cat->id}}">
                                            <div id="c{{$cat->id}}" class="accordion-body">
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin:0 20px 0 20px;">
                                @endforeach
                            </div>
                            <div style="padding:28px;">
                                <a id="aplicar_categorias" onclick="aplicar_categorias()" class="bg-secondary pb-2 pt-1 btn btn-block font-weight-bold text-white border border-secondary" style="border-radius:5px;">Aplicar Categorías</a>
                            </div>
                        </div>
                        <div id="barra_filtro" class="shadow" style="margin-top:12px; background-color:#f3f4f5; border-radius:2px;">
                            <div style="display:flex; padding:22px;">
                                <i style="transform: rotate(180deg); color:gray; font-size:29px; -webkit-text-stroke: 1px; margin-right: 6px;" class="bi bi-filter"></i>
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
                                                    <input class="checkbox_filtro form-check-input check-filtro check-marca" type="checkbox" value="{{$marca->id}}" name="{{$marca->nombre}}">
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
                                                    <input class="checkbox_filtro form-check-input check-tipo check-filtro " type="checkbox" value="{{$tipo->id}}" name="{{$tipo->nombre}}">
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
                                                    <input class="checkbox_filtro form-check-input check-especie check-filtro" type="checkbox" value="{{$especie->id}}" name="{{$especie->nombre}}">
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
                                                        <input class="checkbox_filtro form-check-input check-precio check-filtro" type="checkbox">
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
                                <a id="aplicar_filtro" onclick="aplicar_filtros()" class="bg-secondary pb-2 pt-1 btn btn-block font-weight-bold text-white border border-secondary" style="border-radius:5px;">Aplicar Filtros</a>
                            </div>
                        </div>
                    </div>

                    <div id="for_pro" class="col p-0" >
                        <div class="row m-0" style="padding-top:12px;" id="productAvailable">
                            @foreach($products as $pro)
                                <div class="col_productos producto col" data-slug="{{ $pro->slug }}" data-marca="{{ $pro->id_marca }}" data-tipo_producto="{{$pro->id_tipo}}" data-especie="{{$pro->producto_enfocado }}" data-precio="{{ $pro->precio }}" data-subcategoria="{{ $pro->subcategoria }}">
                                    <div style="background:white; border-radius:5px;">
                                        <div class="card-body shadow">
                                            <a onclick="modal_detalle({{$pro}})" style="text-decoration:none;">
                                                @if ($pro->stock<"1")
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
                                                <p style=" pointer-events:none; margin:3px auto 3px 0;">${{number_format($pro->precio, 0, ',', '.')}}</p>
                                                @if ($pro->stock<"1")
                                                <div style="display:flex; pointer-events:none;">
                                                    <p class="my-auto font-weight-bold">Producto agotado</p>
                                                </div>
                                                @else
                                                <div>
                                                    <div class="btn-group h-100">
                                                        <button onclick="resta(this)" id="{{$pro->id}}" class="my-auto btn_add" style="width:30px; height:30px; padding:0; border-radius:50px;"><i class=" bi bi-dash"></i></button>
                                                        <input id="input_sr{{$pro->id}}" type="text" maxlength="3" class="fc mx-1 w-12" style="height:32px; pointer-events:none; text-align:center; border-radius:50px; border: 1px solid lightgray" autocomplete="off" value="1" />
                                                        <button onclick="suma(this)" value="{{$pro->stock}}" id="{{$pro->id}}" class="my-auto btn_add" style="width:30px; height:30px; padding:0; border-radius:50px;"><i class=" bi bi-plus"></i></button>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="d-flex">
                                                @if (!$pro->stock)
                                                    <input type="submit" disabled value="Agregar a carro" class="w-100 font-weight-bold" style="padding:6px; border-radius:8px; color:white; background-color:#68c387; border:2px solid white;"/>
                                                @else
                                                    <input type="submit" onclick="agregar(this,false)" value="Agregar al carrito" class="b_agregar w-100 font-weight-bold"
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

    <div id="nav_catfil" style="z-index: 2; position:absolute; width:100%;">
        <div style="display:flex; width:100%; height:100%;">
            <div  id="catfil" style="padding-top: 2px; background-color:white; height: 100%; width:0px;">
                <div id="titulo_catfil" style="position:relative; left:-360px; width: 360px;">
                    <div class="shadow d-flex" style="z-index:1; padding:24px 18px 24px 30px; background-color:#f3f4f5; justify-content:space-between;">
                        <h2 class="my-auto text-dark font-weight-bold" style="font-size:24px;">Categorías y Filtros</h2>
                        <button onclick="cerrar_catfil_parcial(false)">
                            <i style="color:gray; font-size:43.2px;" class="bi bi-x"></i>
                        </button>
                    </div>
                    <div id="categoriasYfiltros" class="shadow mt-3" style=" width: 360px; height: 100%; overflow-y: scroll;">
                        <div class="shadow" style="padding:24px 30px 24px 30px; width: 100%; background-color:#f3f4f5;">
                            <div id="ordenar_por" class="btn_bf" style="display:flex; border: 2px solid gray; border-radius:10px; transition:0.4s;">
                                <select id="selectOrden_nav" class=" btn_sel pt-2 pr-3 pb-2 pl-3 w-100 fc bg-transparent border-0" style="cursor: pointer; transition:0.4s;">
                                    <option value="" hidden selected>Ordenar por:</option>
                                    <option value="orden_az">Orden alfabético (A - Z)</option>
                                    <option value="orden_za">Orden alfabético (Z - A)</option>
                                    <option value="menor_precio">Menor precio</option>
                                    <option value="mayor_precio">Mayor precio</option>
                                </select>
                            </div>
                        </div>
                        <div class="shadow mt-3" style=" width: 100%; background-color: white;">
                            <div id="barra_categorias_nav" class="shadow" style="background-color:#f3f4f5; border-radius:2px;">
                                <div style="display:flex; padding:28px;">
                                    <i style="color:gray; font-size:29px; -webkit-text-stroke: 1px; margin-right: 6px;" class="bi bi-filter"></i>
                                    <h1 class="font-weight-bold" style="color:gray; font-size:24px;">Categorías </h1>
                                </div>
                                <div id="categorias_aplicados_nav" style="padding:0 20px; display:none;"></div>
                                <div class="accordion accordion-flush">
                                    @foreach ($categorias as $cat)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" style="padding-left:30px; padding-right:30px;" type="button" data-bs-toggle="collapse" data-bs-target="#cat_nav{{$cat->id}}" aria-expanded="false" aria-controls="cat_nav{{$cat->id}}">
                                                    <h1 class="font-weight-bold text-dark">{{$cat->nombre}}</h1>
                                                </button>
                                            </h2>
                                            <div id="cat_nav{{$cat->id}}" class="accordion-collapse accordionCat_nav collapse" style="transition:0.5s" aria-labelledby="cat_nav{{$cat->id}}">
                                                <div id="c_nav{{$cat->id}}" class="accordion-body" style="padding:0 30px 30px 30px;">
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin:0 30px 0 30px;">
                                    @endforeach
                                </div>
                                <div style="padding:28px;">
                                    <a id="aplicar_categorias_nav" onclick="aplicar_categorias_nav()" class="bg-secondary pb-2 pt-1 btn btn-block font-weight-bold text-white border border-secondary" style="border-radius:5px;">Aplicar Categorias</a>
                                </div>
                            </div>
                            <div id="filtro_nav" class="shadow" style="margin-top:12px; background-color:#f3f4f5; border-radius:2px;">
                            <div style="display:flex; padding:28px;">
                                <i style="transform: rotate(180deg); color:gray; font-size:29px; -webkit-text-stroke: 1px; margin-right: 6px;" class="bi bi-filter"></i>
                                <h1 class="font-weight-bold" style="color:gray; font-size:24px;">Filtros </h1>
                            </div>
                            <div id="filtros_aplicados_nav" style="padding:0 30px; display:none;"></div>
                                <div class="accordion accordion-flush">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button" style="padding-left:30px; padding-right:30px;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <h1 class="font-weight-bold text-dark">Marca</h1>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse show" style="transition:0.5s" aria-labelledby="flush-headingOne" >
                                            <div class="accordion-body" style="padding:0 30px 30px 30px;">
                                                @foreach($marcaProductos as $marca)
                                                    <div class="form-check">
                                                        <input class="checkbox_nav form-check-input check-filtro_nav check-marca_nav" type="checkbox" value="{{$marca->id}}" name="{{$marca->nombre}}">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            {{$marca->nombre}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin:0 30px 0 30px;">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" style="padding-left:30px; padding-right:30px;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                <h1 class="font-weight-bold text-dark">Tipo de producto</h1>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" style="transition:0.5s" aria-labelledby="flush-headingTwo">
                                            <div class="accordion-body" style="padding:0 30px 30px 30px;">
                                                @foreach($tipoProductos as $tipo)
                                                    <div class="form-check mt-1">
                                                        <input class="checkbox_nav form-check-input check-tipo_nav check-filtro_nav " type="checkbox" value="{{$tipo->id}}" name="{{$tipo->nombre}}">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            {{$tipo->nombre}}
                                                        </label>
                                                    </div>
                                                @endforeach    
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin:0 30px 0 30px;">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" style="padding-left:30px; padding-right:30px;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                <h1 class="font-weight-bold text-dark">Especie</h1>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" style="transition:0.5s" aria-labelledby="flush-headingThree">
                                            <div class="accordion-body" style="padding:0 30px 30px 30px;">
                                                @foreach($tipoEspecies as $especie)
                                                    <div class="form-check">
                                                        <input class="checkbox_nav form-check-input check-especie_nav check-filtro_nav" type="checkbox" value="{{$especie->id}}" name="{{$especie->nombre}}">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            {{$especie->nombre}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin:0 30px 0 30px;">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingFour">
                                            <button class="accordion-button collapsed" style="padding-left:30px; padding-right:30px;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                <h1 class="font-weight-bold text-dark">Precio</h1>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse" style="transition:0.5s" aria-labelledby="flush-headingFour">
                                            <div class="accordion-body" style="padding:0 30px 30px 30px;">
                                                <div class="d-flex">
                                                    <input id="input_min_nav" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="sin_borde" type="text" style="width:45%; margin:0 5% 0 0; padding:8px 10px; border-radius:7px; border: 1px solid gray;" placeholder="$ min">
                                                    <input id="input_max_nav" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="sin_borde" type="text" style="width:45%; margin:0 0 0 5%; padding:8px 10px; border-radius:7px; border: 1px solid gray;" placeholder="$ max">
                                                </div> 
                                                <p id="error_rango_nav" style="display:none; color:red; font-size:14px;">Mensaje de error</p>
                                                <div id="checks_nav" style="margin-top:20px;">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <div class="form-check">
                                                            <input class="checkbox_nav form-check-input check-precio_nav check-filtro_nav" type="checkbox">
                                                            <label class="precio-check_nav" for="flexCheckDefault">
                                                            </label>
                                                        </div> 
                                                    @endfor
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin:0 30px 0 30px;">
                                </div>
                                <div style="padding:30px;">
                                    <a id="aplicar_filtro_nav" onclick="aplicar_filtros_nav()" class="bg-secondary pb-2 pt-1 btn btn-block font-weight-bold text-white border border-secondary" style="border-radius:5px;">Aplicar Filtros</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div id="cerrar" onclick="cerrar_catfil_parcial(false)" style="background:rgba(23,23,23,0.3); width:100%; height:100%;"></div>

        </div>
    </div>
    
    <div id="nav_carrito" style="z-index: 2; position:absolute; width:100%; height:100%;">
        <div  style="display:flex; width:100%; height:100%;">
            <div id="cerrar" onclick="cerrar_carro_parcial(false)" style="background:rgba(23,23,23,0.3); width:100%; height:100%;"></div>
            <div  id="carrito" style="padding-top: 2px; background-color:white; height:100%; width:0;">

                <div id="titulo" style="width: 360px;">
                    <div class="shadow d-flex" style="padding:24px 30px 24px 18px; background-color:#f3f4f5; justify-content:space-between;">
                        <button onclick="cerrar_carro_parcial(false)">
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
                    <div id="btn_resumen" class="shadow" style="background-color:#f3f4f5; display:flex; border-bottom:1.4px solid darkgray;">
                        <button onclick="abrir_resumen()" class="d-flex w-100 h-100" style="padding:16px 30px 16px 30px; justify-content:space-between;">
                            <h1 class="text-dark font-weight-bold">Resumen de carrito</h1>
                            <div style="width:18px">
                                <span id="icono" style="-webkit-text-stroke: 1px;"><i class="bi bi-chevron-up"></i></span>
                            </div>
                        </button>
                    </div>
                    <div id="cuerpo_resumen" class="px-4 py-3" style="background-color:#f3f4f5;">
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
                                <a onclick="cerrar_carro_parcial(false)" class="bg-transparent pb-2 pt-1 btn btn-block font-weight-bold text-secondary border border-secondary" style="border-radius:5px;">Cerrar</a>
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

    <div id="detalle" style="display: none; padding:5%; position: absolute; left:0; z-index: 9999; min-width: 360px;" >
        <div id="detalle_close" onclick="cerrar_modal_detalle(false)" style="position: absolute; z-index: 9999; top: 0; left: 0;  width: 100%; height: 100%; background: rgba(12,12,12,0.4);"></div>
        <div id="detalle_div" style="position: relative; z-index: 9999; width: 100%; background: white; border-radius: 5px;">
            <div id="detalle_header" style="display:flex; justify-content:space-between; position: relative; top: 0; left: 0; width: 100%; padding:15px 13px 15px 20px; background: transparent; border-bottom:1px solid lightgray;">
                <h2 class="my-auto text-dark font-weight-bold" style="font-size:20px;">Detalle de Producto</h2>
                <button onclick="cerrar_modal_detalle(false)">
                    <i style="color:black; font-size:30px;" class="bi bi-x"></i>
                </button>
            </div>
            <div id="detalle_body" class="row"  style="margin:0; padding:20px; width:100%; background-color:white; overflow-y:auto;">
                <div class="col-lg-4 p-0 pe-2" >
                    <img id="pro-imagen" class=" card-img-top" style="margin:0 auto; width:250px;">
                </div>
                <div class="col-lg-8 p-0 px-2">
                    <div id="detalle_info">
                        <h1 id="pro-slug" style="color:gray; font-size:20px; margin-bottom:4px;"></h1>
                        <h1 id="pro-marca" style="font-weight:bold; margin-bottom:4px;"></h1>
                        <h1 id="pro-stock" style="font-size:14px; margin-bottom:4px;"></h1>
                        <h1 id="pro-precio" style="font-weight:bold; color:green; margin-bottom:12px;"></h1>
                        <h1 style="margin-bottom: 4px;">Tipo de Producto:</h1>
                        <h1 id="pro-tipo" style="margin-bottom:12px;"></h1>
                        <h1 style="margin-bottom: 4px;">Producto enfocado para:</h1>
                        <h1 id="pro-enfoque" style="margin-bottom:12px;"></h1>
                        <h1 id="detalle_titulo_categorias">Categoría(s):</h1>
                        <h1 id="pro-categorias" style="margin-bottom:12px;"></h1>
                        <h1 style="margin-bottom: 4px;">Descripción:</h1>
                        <h1 id="pro-descripcion" style="color:gray;"></h1>
                    </div>
                </div>
            </div>
            <div id="detalle_footer" style="border-top:1px solid lightgray; display:flex; justify-content:end; padding:19px">
                <div id="detalle_agotado" class="mx-2" style="display: flex;">
                    <div style="display:flex; pointer-events:none;">
                        <p class="my-auto font-weight-bold">Producto agotado</p>
                    </div>
                </div>
                <div id="detalle_noagotado" style="display: flex;">
                    <div>
                        <div class="btn-group h-100">
                            <button onclick="detalle_resta()" class="btn_add" style="width:37px; height:100%; border-radius: 50px;"><i class=" bi bi-dash"></i></button>
                            <input id="detalle_input" type="text" maxlength="3" class="fc mx-1" style="border-radius: 50px; width: 70px; height:100%; pointer-events:none; text-align:center; border: 1px solid lightgray" autocomplete="off" value="1" />
                            <button  onclick="detalle_suma()" class="btn_add" style="width:37px; height:100%; border-radius: 50px;"><i class=" bi bi-plus"></i></button>
                        </div>
                    </div>
                    <button id="detalle_agregar" type="button" onclick="agregar(this,true)" class="btn font-weight-bold mx-2" style="border-radius: 5px; color:white; background-color:#19A448; border-color:#19A448;">Agregar al carrito</button>
                </div>
                
                <button type="button" onclick="cerrar_modal_detalle(false)" class="btn btn-secondary font-weight-bold" style="border-radius: 5px;">Cerrar</button>
            </div>

        </div>
        
    </div>


    
<script>
    var max=0,min=parseInt(document.getElementsByClassName('producto')[0].dataset.precio),num_intervalo=5,cards = [];

    function modal_detalle(prod)
    {
        
        var categorias=<?php echo $categorias;?>;
        var subcategorias=<?php echo $subcategorias;?>;
        document.body.style.overflow = 'hidden';
        $("#detalle").fadeIn();
        document.getElementById("detalle").style.top= window.scrollY;
        document.getElementById("detalle").style.width=(window.innerWidth);
        document.getElementById("detalle").style.height=(window.innerHeight);
        document.getElementById("detalle_input").setAttribute("name",prod.stock);

        document.getElementById("detalle_agregar").setAttribute("max",prod.id);
        document.getElementById("detalle_agregar").setAttribute("name",prod.nombre);
        document.getElementById("detalle_agregar").setAttribute("min",prod.precio);
        document.getElementById("detalle_agregar").setAttribute("accept",prod.imagen_path);
        document.getElementById("detalle_agregar").setAttribute("alt",prod.slug);

        document.getElementById("pro-imagen").setAttribute("src","/image/productos/"+prod.imagen_path);         
        document.getElementById("pro-slug").innerHTML=prod.slug;
        document.getElementById("pro-marca").innerHTML=prod.marca;
        document.getElementById("pro-stock").innerHTML="Stock&nbsp;&nbsp;&nbsp;&nbsp;: "+prod.stock+" unidad(es)";
        document.getElementById("pro-precio").innerHTML="Precio&nbsp;: $"+parseInt(prod.precio).toLocaleString('de-DE');
        document.getElementById("pro-tipo").innerHTML="<p style='font-size:14px; font-weight:bold; display:inline-block; background-color:lightgray; color:black; padding:5px 10px 5px 10px; border-radius:10px; border:2px solid gray;'>"+prod.tipo+"</p>";
        document.getElementById("pro-enfoque").innerHTML="<p style='font-size:14px; font-weight:bold; display:inline-block; background-color:lightgray; color:black; padding:5px 10px 5px 10px; border-radius:10px; border:2px solid gray;'>"+prod.enfoque_especie+"</p>";
        document.getElementById("pro-categorias").innerHTML="";
        
        if(prod.stock<1){
            document.getElementById("detalle_agotado").style.display="flex";
            document.getElementById("detalle_noagotado").style.display="none";
            document.getElementById("pro-imagen").style.filter="grayscale(100%)";
            document.getElementById("pro-stock").innerHTML="Stock&nbsp;&nbsp;&nbsp;&nbsp;: "+prod.stock+" unidades";

        }else{
            document.getElementById("detalle_agotado").style.display="none";
            document.getElementById("detalle_noagotado").style.display="flex";
            document.getElementById("pro-imagen").style.filter="grayscale(0%)";
        }

        if(prod.subcategoria!=null)
        {
            document.getElementById("detalle_titulo_categorias").style.display="";
            document.getElementById("pro-categorias").style.display="";

            var sentencias =prod.subcategoria.split("-");
            if(sentencias[(sentencias.length-1)]==""){ sentencias.pop(); }

            for (let i = 0; i < sentencias.length; i++)
            {
                for (let j = 0; j < subcategorias.length; j++)
                {
                    if(subcategorias[j].id==sentencias[i])
                    {
                        for (let k = 0; k < categorias.length; k++)
                        {
                            if(categorias[k].id==subcategorias[j].id_categoria)
                            {
                                document.getElementById("pro-categorias").innerHTML+="<p style='font-size:14px; font-weight:bold; display:inline-block; background-color:lightgray; color:black; padding:5px 10px 5px 10px; margin:5px 5px 0 0; border-radius:10px; border:2px solid gray;'>"+categorias[k].nombre+":"+ subcategorias[j].nombre+"</p>";
                            }
                        }
                    }
                }
            }
        }else{
            document.getElementById("detalle_titulo_categorias").style.display="none";
            document.getElementById("pro-categorias").style.display="none";
        }   
        document.getElementById("pro-descripcion").innerHTML=prod.descripcion;

        if(window.innerWidth>990)
        {
            if(($("#detalle_info").height()+$("#detalle_header").innerHeight()+$("#detalle_footer").innerHeight()+40)<$("#detalle").height())
            {
                document.getElementById("detalle_div").style.height="";
                document.getElementById("detalle_body").style.height="";
            }else{
                document.getElementById("detalle_div").style.height="100%";
                document.getElementById("detalle_body").style.height=($("#detalle_div").height()-$("#detalle_header").innerHeight()-$("#detalle_footer").innerHeight());
            }
        }else{
            if(($("#detalle_info").height()+$("#pro-imagen").height()+$("#detalle_header").innerHeight()+$("#detalle_footer").innerHeight()+40)<$("#detalle").height())
            {
                document.getElementById("detalle_div").style.height="";
                document.getElementById("detalle_body").style.height="";
            }else{
                document.getElementById("detalle_div").style.height="100%";
                document.getElementById("detalle_body").style.height=($("#detalle_div").height()-$("#detalle_header").innerHeight()-$("#detalle_footer").innerHeight());
            }
        }
    }

    function cerrar_modal_detalle(cerrado_rapido)
    {

        document.body.style.overflow = 'auto';

        if(cerrado_rapido){
            document.getElementById("detalle").style.display= "none";
        }else{
            $("#detalle").fadeOut();
        }


    }

    function detalle_resta()
    {
       
        if(parseInt(document.getElementById("detalle_input").value)>1){
            document.getElementById("detalle_input").value--;
        }
    }

    function detalle_suma()
    {
        if(parseInt(document.getElementById("detalle_input").value)<parseInt(document.getElementById("detalle_input").name)){
            document.getElementById("detalle_input").value++;
        }
    }

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


        }else if(window.innerWidth<=1535 && window.innerWidth>1279){
            document.getElementById("icono_filtro").style.display="none";
            document.getElementById("ordenar_por").style.display="";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="476px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";


        }else if(window.innerWidth<=1279 && window.innerWidth>1023){
            document.getElementById("icono_filtro").style.display="none";
            document.getElementById("ordenar_por").style.display="";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="476px";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";
            

        }else if(window.innerWidth<=1023 && window.innerWidth>767){
            document.getElementById("icono_filtro").style.display="none";
            document.getElementById("ordenar_por").style.display="";
            document.getElementById("busqueda").style.display="";
            document.getElementById("busq").style.width="33%";
            document.getElementById("busq").style.marginLeft="24px";
            document.getElementById("icono_carro").style.marginLeft="24px";
            document.getElementById("barra").style.marginLeft="0";
            document.getElementById("barra").style.marginRight="0";


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

        }
    }

    function init_filtro_nav(){
        document.getElementById("input_min_nav").value="";
        document.getElementById("input_max_nav").value="";
        for(var i=0; i<document.getElementsByClassName("checkbox_nav").length; i++){ document.getElementsByClassName("checkbox_nav")[i].checked =false; }

        
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
                document.getElementsByClassName('precio-check_nav')[(i-1)].innerHTML="Menos de $"+parseInt(max/num_intervalo*i).toLocaleString('de-DE');
                document.getElementsByClassName('check-precio_nav')[(i-1)].setAttribute("data-precio_inicial",0);
                document.getElementsByClassName('check-precio_nav')[(i-1)].setAttribute("data-precio_final",max/num_intervalo*i);
            }else if(i==num_intervalo){
                document.getElementsByClassName('precio-check_nav')[(i-1)].innerHTML="Mas de $"+parseInt(max/num_intervalo*(i-1)).toLocaleString('de-DE');
                document.getElementsByClassName('check-precio_nav')[(i-1)].setAttribute("data-precio_inicial",parseInt(max/num_intervalo*(i-1)));
                document.getElementsByClassName('check-precio_nav')[(i-1)].setAttribute("data-precio_final",parseInt(max));
            }else{
                document.getElementsByClassName('precio-check_nav')[(i-1)].innerHTML="Entre $"+parseInt(max/num_intervalo*(i-1)).toLocaleString('de-DE')+" y $"+parseInt(max/num_intervalo*i).toLocaleString('de-DE');
                document.getElementsByClassName('check-precio_nav')[(i-1)].setAttribute("data-precio_inicial",max/num_intervalo*(i-1));
                document.getElementsByClassName('check-precio_nav')[(i-1)].setAttribute("data-precio_final",max/num_intervalo*i);
            }
        }
    }

    function init_filtro()
    {
        


        
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

    function init_barra_categorias()
    {
        var categorias =<?php echo $categorias ?>;
        var subcategorias =<?php echo $subcategorias ?>;

        
        for (let i = 0; i < categorias.length; i++) {
            document.getElementById("c"+categorias[i].id).innerHTML="";
            for(let j = 0; j < subcategorias.length; j++){
                if (subcategorias[j].id_categoria==categorias[i].id) {
                    document.getElementById("c"+categorias[i].id).innerHTML+=
                    '<div class="form-check mt-1">'+
                        '<input class="checkbox check-subcat form-check-input" type="checkbox" value='+subcategorias[j].id+' name='+subcategorias[j].nombre+' id='+subcategorias[j].id_categoria+'>'+
                        '<label class="form-check-label" for="flexCheckDefault">'+
                            subcategorias[j].nombre+
                        '</label>'+
                    '</div>';
                
                }    
            }
        }
        document.getElementsByClassName("accordionCat")[0].className += " show";

    }   

    function init_barra_categorias_nav()
    {
        var categorias =<?php echo $categorias ?>;
        var subcategorias =<?php echo $subcategorias ?>;
        
        for (let i = 0; i < categorias.length; i++) {
            document.getElementById("c_nav"+categorias[i].id).innerHTML="";
            for(let j = 0; j < subcategorias.length; j++){
                if (subcategorias[j].id_categoria==categorias[i].id) {
                    document.getElementById("c_nav"+categorias[i].id).innerHTML+=
                    '<div class="form-check mt-1">'+
                        '<input class="checkbox check-subcat_nav form-check-input" type="checkbox" value='+subcategorias[j].id+' name='+subcategorias[j].nombre+' id='+subcategorias[j].id_categoria+'>'+
                        '<label class="form-check-label" for="flexCheckDefault">'+
                            subcategorias[j].nombre+
                        '</label>'+
                    '</div>';
                }    
            }
        }
        document.getElementsByClassName("accordionCat_nav")[0].className += " show";

    } 

    // captura cambio de tamaño navegador
    window.addEventListener("resize", function()
    {
        cerrar_modal_detalle(true);
        init_barra();
        init_filtro();
        cerrar_carro_parcial(true);
        cerrar_catfil_parcial(true)
        document.getElementById("barra").style.top=(2+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().y);
        if(document.getElementById("toast-container")!=null){
            document.getElementById("toast-container").style.top=(window.scrollY+12);
        }
        
        if(document.getElementById("filtros").style.display==""){
            for(var i=0; i<document.getElementsByClassName("checkbox_filtro").length; i++){
                if(document.getElementsByClassName("checkbox_filtro")[i].checked){
                    document.getElementsByClassName("checkbox_nav")[i].checked=true;
                }else{
                    document.getElementsByClassName("checkbox_nav")[i].checked=false;
                }
            }
            for(var i=0; i<document.getElementsByClassName("check-subcat").length; i++){
                if(document.getElementsByClassName("check-subcat")[i].checked){
                    document.getElementsByClassName("check-subcat_nav")[i].checked=true;
                }else{
                    document.getElementsByClassName("check-subcat_nav")[i].checked=false;
                }
            }
        }else{
            for(var i=0; i<document.getElementsByClassName("checkbox_nav").length; i++){
                if(document.getElementsByClassName("checkbox_nav")[i].checked){
                    document.getElementsByClassName("checkbox_filtro")[i].checked=true;
                }else{
                    document.getElementsByClassName("checkbox_filtro")[i].checked=false;
                }
            }
            for(var i=0; i<document.getElementsByClassName("check-subcat_nav").length; i++){
                if(document.getElementsByClassName("check-subcat_nav")[i].checked){
                    document.getElementsByClassName("check-subcat")[i].checked=true;
                }else{
                    document.getElementsByClassName("check-subcat")[i].checked=false;
                }
            }
        }
        



    });

    window.onscroll = function() 
    {
        document.getElementById("barra").style.top=(2+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().y);
        if(document.getElementById("toast-container")!=null){
            document.getElementById("toast-container").style.top=(window.scrollY+12);
        }
    };
    
    function def()
    {
        
        document.getElementById("barra").style.top=(2+document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().y);
        if(document.getElementById("toast-container")!=null){
            document.getElementById("toast-container").style.top=(window.scrollY+12);
        }
        init_barra();
        init_filtro();
        init_filtro_nav();
        init_barra_categorias();
        init_barra_categorias_nav();
        $("#busqueda").val("");
        $("#selectOrden_barra").val("");
        $("#selectOrden_nav").val("");
        $('#vacio').hide();
        $('#loading').hide();
        $('#nav_carrito').hide();
        $('#nav_catfil').hide();
        $('#nv').hide();
        document.getElementById('cuerpo_resumen').style.display="none";
        for(var j=0;j<document.getElementsByClassName('producto').length;j++){ cards[j]=true;}
        for(var i=0; i<document.getElementsByClassName("checkbox_filtro").length; i++){ document.getElementsByClassName("checkbox_filtro")[i].checked =false; }
        for(var i=0; i<document.getElementsByClassName("checkbox_nav").length; i++){ document.getElementsByClassName("checkbox_nav")[i].checked =false; }

    }window.load = def();

    function aplicar_filtros_nav()
    {
        var marcas = [];
        var tipos = [];
        var especies = [];
        var precios_inicial = [];
        var precios_final = [];
        var precio = [];
        var aplicados = [];
        

        
        document.getElementById("categorias_aplicados").style.display="none";
        document.getElementById("categorias_aplicados_nav").style.display="none";
        for(var i=0; i<document.getElementsByClassName("check-subcat").length; i++){
            document.getElementsByClassName("check-subcat_nav")[i].checked =false;
        }

        document.getElementById("busqueda").value="";
        document.getElementById('error_rango_nav').style.display="none";

        document.getElementById('checks_nav').style.display="";
        document.getElementById('checks').style.display="";


        for(var i=0; i<document.getElementsByClassName("check-marca_nav").length; i++)
        {
            if(!document.getElementsByClassName("check-marca_nav")[i].checked){
                marcas.push(document.getElementsByClassName("check-marca_nav")[i].value.toLowerCase());
            }else{
                aplicados.push("Marca: "+document.getElementsByClassName("check-marca_nav")[i].name);
            }
        }

        for(var i=0; i<document.getElementsByClassName("check-tipo_nav").length; i++)
        {
            if(!document.getElementsByClassName("check-tipo_nav")[i].checked){
                tipos.push(document.getElementsByClassName("check-tipo_nav")[i].value.toLowerCase());
            }else{
                aplicados.push("Tipo: "+document.getElementsByClassName("check-tipo_nav")[i].name);
            }
        }

        for(var i=0; i<document.getElementsByClassName("check-especie_nav").length; i++)
        {
            if(!document.getElementsByClassName("check-especie_nav")[i].checked){
                especies.push(document.getElementsByClassName("check-especie_nav")[i].value.toLowerCase());
            }else{
                aplicados.push("Especie: "+document.getElementsByClassName("check-especie_nav")[i].name);
            }
        }

        for(var i=0; i<document.getElementsByClassName("check-precio_nav").length; i++)
        {
            if(document.getElementsByClassName("check-precio_nav")[i].checked){
                precios_inicial.push(document.getElementsByClassName("check-precio_nav")[i].getAttribute("data-precio_inicial"));
                precios_final.push(document.getElementsByClassName("check-precio_nav")[i].getAttribute("data-precio_final"));
                if(document.getElementById('input_min_nav').value===""&&document.getElementById('input_max_nav').value===""){
                    aplicados.push("precio: $"+parseInt(document.getElementsByClassName("check-precio_nav")[i].getAttribute("data-precio_inicial")).toLocaleString('de-DE')+" - $"+parseInt(document.getElementsByClassName("check-precio_nav")[i].getAttribute("data-precio_final")).toLocaleString('de-DE'));
                }
            }
        }
      
        if(document.getElementById('input_min_nav').value!=""&&document.getElementById('input_max_nav').value===""){
            if(parseInt(document.getElementById('input_min_nav').value)<=max){
                aplicados.push("precio: $"+parseInt(document.getElementById('input_min_nav').value).toLocaleString('de-DE')+" - $"+parseInt(max).toLocaleString('de-DE'));
            }else{
                document.getElementById('input_min_nav').value="";
                document.getElementById('input_max_nav').value="";
                document.getElementById('error_rango_nav').style.display="";
                document.getElementById('error_rango_nav').innerHTML="Valor minimo debe ser menor a $"+parseInt(max).toLocaleString('de-DE');
            }
        }else if(document.getElementById('input_min_nav').value===""&&document.getElementById('input_max_nav').value!=""){
            if(parseInt(document.getElementById('input_max_nav').value)>=min){
                aplicados.push("precio: $"+parseInt(min).toLocaleString('de-DE')+" - $"+parseInt(document.getElementById('input_max_nav').value).toLocaleString('de-DE'));
            }else{
                document.getElementById('input_min_nav').value="";
                document.getElementById('input_max_nav').value="";
                document.getElementById('error_rango_nav').style.display="";
                document.getElementById('error_rango_nav').innerHTML="Valor maximo debe ser mayor a $"+parseInt(min).toLocaleString('de-DE');
            }
        }else if(document.getElementById('input_min_nav').value!=""&&document.getElementById('input_max_nav').value!=""){
            if(parseInt(document.getElementById('input_max_nav').value)>=parseInt(document.getElementById('input_min_nav').value)){
                aplicados.push("precio: $"+parseInt(document.getElementById('input_min_nav').value).toLocaleString('de-DE')+" - $"+parseInt(document.getElementById('input_max_nav').value).toLocaleString('de-DE'));
            }else{
                document.getElementById('input_min_nav').value="";
                document.getElementById('input_max_nav').value="";
                document.getElementById('error_rango_nav').style.display="";
                document.getElementById('error_rango_nav').innerHTML="Valor maximo debe ser mayor a valor minino";

            }
        }
        
        for(var j=0;j<document.getElementsByClassName('producto').length;j++){
            document.getElementsByClassName('producto')[j].style.display="";
        }

        if(document.getElementsByClassName("check-marca_nav").length!=marcas.length){
            for(var i=0;i<marcas.length;i++){
                for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                    if(document.getElementsByClassName('producto')[j].getAttribute("data-marca").toLowerCase()===marcas[i]){
                        document.getElementsByClassName('producto')[j].style.display="none";
                    }
                }
            }
        }

        if(document.getElementsByClassName("check-tipo_nav").length!=tipos.length){
            for(var i=0;i<tipos.length;i++){
                for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                    if(document.getElementsByClassName('producto')[j].getAttribute("data-tipo_producto").toLowerCase()===tipos[i]){
                        document.getElementsByClassName('producto')[j].style.display="none";
                    }
                }
            }
        }

        if(document.getElementsByClassName("check-especie_nav").length!=especies.length){
            for(var i=0;i<especies.length;i++){
                for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                    if(document.getElementsByClassName('producto')[j].getAttribute("data-especie").toLowerCase()===especies[i]){
                        document.getElementsByClassName('producto')[j].style.display="none";
                    }
                }
            }
        }
        if(precios_inicial.length!=0||document.getElementById('input_min_nav').value!=""||document.getElementById('input_max_nav').value!=""){
        
            if(document.getElementById('input_min_nav').value===""&&document.getElementById('input_max_nav').value===""){
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
                
                if(document.getElementById('input_min_nav').value!=""&&document.getElementById('input_max_nav').value===""){
                    
                    for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                        if(parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))>=parseInt(document.getElementById("input_min_nav").value) && parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))<=max){
                            precio[j]=true;
                            
                        }
                    }
                    
                }else if(document.getElementById('input_min_nav').value===""&&document.getElementById('input_max_nav').value!=""){
                    for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                        if(parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))>=min && parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))<=parseInt(document.getElementById("input_max_nav").value)){
                            precio[j]=true;

                        }
                    }
                }else if(document.getElementById('input_min_nav').value!=""&&document.getElementById('input_max_nav').value!=""){
                    for(var j=0;j<document.getElementsByClassName('producto').length;j++){
                        if(parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))>=parseInt(document.getElementById("input_min_nav").value) && parseInt(document.getElementsByClassName('producto')[j].getAttribute("data-precio"))<=parseInt(document.getElementById("input_max_nav").value)){
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
            document.getElementById("filtros_aplicados_nav").style.display="";
            document.getElementById("filtros_aplicados").style.display="";
            document.getElementById("filtros_aplicados_nav").innerHTML="";
            document.getElementById("filtros_aplicados").innerHTML="";
            document.getElementById("filtros_aplicados_nav").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Filtros Aplicados</h1> <button onclick='borrar_filtros_nav()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            document.getElementById("filtros_aplicados").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Filtros Aplicados</h1> <button onclick='borrar_filtros()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            for(var i=0;i<aplicados.length;i++){
                document.getElementById("filtros_aplicados_nav").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados[i]+"</p>";
                document.getElementById("filtros_aplicados").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados[i]+"</p>";
            }
            document.getElementById("filtros_aplicados_nav").innerHTML+="<hr style='margin-top:16px;'>";
            document.getElementById("filtros_aplicados").innerHTML+="<hr style='margin-top:16px;'>";

        }else{
            document.getElementById("filtros_aplicados_nav").style.display="none";
            document.getElementById("filtros_aplicados").style.display="none";

        }
        document.getElementById('input_min_nav').value="";
        document.getElementById('input_min').value="";
        document.getElementById('input_max_nav').value="";
        document.getElementById('input_max').value="";
        var vacio=true;
        for(var i=0;i<cards.length;i++){
            if(cards[i]===true){
                vacio=false;
                break;
                
            }
        }

        for(var i=0; i<document.getElementsByClassName("checkbox_nav").length; i++){
            document.getElementsByClassName("checkbox_filtro")[i].checked=false;
            if(document.getElementsByClassName("checkbox_nav")[i].checked){
                document.getElementsByClassName("checkbox_filtro")[i].checked=true;
            } 
        }
        if(vacio){
            $('#vacio').show();

        }else{
            $('#vacio').hide();

        }
        
    }

    function borrar_filtros_nav()
    {
        document.getElementById('input_min_nav').value="";
        document.getElementById('input_max_nav').value="";
        document.getElementById('checks_nav').style.display="";
        document.getElementById('checks').style.display="";
        for(var i=0; i<document.getElementsByClassName("check-filtro_nav").length; i++){
            document.getElementsByClassName("check-filtro_nav")[i].checked =false; 
            document.getElementsByClassName("check-filtro")[i].checked =false; 
        }
        aplicar_filtros_nav();
    }

    function aplicar_filtros()
    {
        var marcas = [];
        var tipos = [];
        var especies = [];
        var precios_inicial = [];
        var precios_final = [];
        var precio = [];
        var aplicados = [];
        
        document.documentElement.style.scrollBehavior = "smooth";
        window.scrollTo(0, 0);

        
        document.getElementById("categorias_aplicados").style.display="none";
        document.getElementById("categorias_aplicados_nav").style.display="none";
        for(var i=0; i<document.getElementsByClassName("check-subcat").length; i++){
            document.getElementsByClassName("check-subcat")[i].checked =false;
            document.getElementsByClassName("check-subcat_nav")[i].checked =false;
        }



        document.getElementById("busqueda").value="";
        document.getElementById('error_rango').style.display="none";

        document.getElementById('checks').style.display="";
        document.getElementById('checks_nav').style.display="";


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
            document.getElementById("filtros_aplicados_nav").style.display="";
            document.getElementById("filtros_aplicados").innerHTML="";
            document.getElementById("filtros_aplicados_nav").innerHTML="";
            document.getElementById("filtros_aplicados").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Filtros Aplicados</h1> <button onclick='borrar_filtros()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            document.getElementById("filtros_aplicados_nav").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Filtros Aplicados</h1> <button onclick='borrar_filtros_nav()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            for(var i=0;i<aplicados.length;i++){
                document.getElementById("filtros_aplicados").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados[i]+"</p>";
                document.getElementById("filtros_aplicados_nav").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados[i]+"</p>";
            }
            document.getElementById("filtros_aplicados").innerHTML+="<hr style='margin-top:16px;'>";
            document.getElementById("filtros_aplicados_nav").innerHTML+="<hr style='margin-top:16px;'>";

        }else{
            document.getElementById("filtros_aplicados").style.display="none";
            document.getElementById("filtros_aplicados_nav").style.display="none";

        }
        document.getElementById('input_min').value="";
        document.getElementById('input_min_nav').value="";
        document.getElementById('input_max').value="";
        document.getElementById('input_max_nav').value="";
        var vacio=true;
        for(var i=0;i<cards.length;i++){
            if(cards[i]===true){
                vacio=false;
                break;
                
            }
        }

        
        for(var i=0; i<document.getElementsByClassName("checkbox_filtro").length; i++){
            document.getElementsByClassName("checkbox_nav")[i].checked=false;
            if(document.getElementsByClassName("checkbox_filtro")[i].checked){
                document.getElementsByClassName("checkbox_nav")[i].checked=true;
            } 
        }

        if(vacio){
            $('#vacio').show();

        }else{
            $('#vacio').hide();

        }
        
    }

    function borrar_filtros()
    {
        document.getElementById('input_min').value="";
        document.getElementById('input_max').value="";
        document.getElementById('checks').style.display="";
        for(var i=0; i<document.getElementsByClassName("check-filtro").length; i++){
            document.getElementsByClassName("check-filtro_nav")[i].checked =false;
            document.getElementsByClassName("check-filtro")[i].checked =false;
        }
        aplicar_filtros();
    }

    function aplicar_categorias_nav()
    {
        var cat=[];
        var aplicados_cat=[];
        var categorias =<?php echo $categorias ?>;

        document.getElementById("filtros_aplicados").style.display="none";
        document.getElementById("filtros_aplicados_nav").style.display="none";
        document.getElementById('input_min').value="";
        document.getElementById('input_min_nav').value="";
        document.getElementById('input_max').value="";
        document.getElementById('input_max_nav').value="";
        document.getElementById('checks').style.display="";
        document.getElementById('checks_nav').style.display="";
        for(var i=0; i<document.getElementsByClassName("check-filtro").length; i++){
            document.getElementsByClassName("check-filtro")[i].checked =false;
            document.getElementsByClassName("check-filtro_nav")[i].checked =false;
        }
        for(var j=0;j<document.getElementsByClassName('producto').length;j++){
            document.getElementsByClassName('producto')[j].style.display="";
        }
        for (let i = 0; i < document.getElementsByClassName("check-subcat_nav").length; i++) {
            if(document.getElementsByClassName("check-subcat_nav")[i].checked){
                for (let j = 0; j < categorias.length; j++) {
                    if(categorias[j].id==document.getElementsByClassName("check-subcat_nav")[i].id){
                        aplicados_cat.push(categorias[j].nombre+": "+document.getElementsByClassName("check-subcat_nav")[i].name);
                        break;
                    }
                    
                }
                cat.push(document.getElementsByClassName("check-subcat_nav")[i].value);
            }
            
        }
     
        if(aplicados_cat.length>0){
            document.getElementById("categorias_aplicados").style.display="";
            document.getElementById("categorias_aplicados_nav").style.display="";
            document.getElementById("categorias_aplicados").innerHTML="";
            document.getElementById("categorias_aplicados_nav").innerHTML="";
            document.getElementById("categorias_aplicados").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Categorias Aplicadas</h1> <button onclick='borrar_categorias()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            document.getElementById("categorias_aplicados_nav").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Categorias Aplicadas</h1> <button onclick='borrar_categorias_nav()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            for(var i=0;i<aplicados_cat.length;i++){
                document.getElementById("categorias_aplicados").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados_cat[i]+"</p>";
                document.getElementById("categorias_aplicados_nav").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados_cat[i]+"</p>";
            }
            document.getElementById("categorias_aplicados").innerHTML+="<hr style='margin-top:16px;'>";
            document.getElementById("categorias_aplicados_nav").innerHTML+="<hr style='margin-top:16px;'>";

        }else{
            document.getElementById("categorias_aplicados").style.display="none";
            document.getElementById("categorias_aplicados_nav").style.display="none";

        }
        let sentencias =document.getElementsByClassName('producto')[0].getAttribute("data-subcategoria").split("-");
        if(sentencias[(sentencias.length-1)]=="")
        {
            sentencias.pop();
        } 
    // aqui vaaaa
        for (let i = 0; i < cards.length; i++) {
            document.getElementsByClassName('producto')[i].style.display="none";
            let sentencias =document.getElementsByClassName('producto')[i].getAttribute("data-subcategoria").split("-");
            for (let j = 0; j < sentencias.length; j++) {
                if(cat.length!=0){
                    for (let k = 0; k < cat.length; k++) {
                        if(sentencias[j]==cat[k]){
                            document.getElementsByClassName('producto')[i].style.display="";
                            break;
                        }
                    }
                }else{
                    document.getElementsByClassName('producto')[i].style.display="";
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
        
    }

    function borrar_categorias_nav()
    {
        for(var i=0; i<document.getElementsByClassName("check-subcat_nav").length; i++){ document.getElementsByClassName("check-subcat_nav")[i].checked =false; }
        aplicar_categorias_nav();
    }

    function aplicar_categorias()
    {
        var cat=[];
        var aplicados_cat=[];
        var categorias =<?php echo $categorias ?>;


        document.getElementById("filtros_aplicados").style.display="none";
        document.getElementById("filtros_aplicados_nav").style.display="none";
        document.getElementById('input_min').value="";
        document.getElementById('input_min_nav').value="";
        document.getElementById('input_max').value="";
        document.getElementById('input_max_nav').value="";
        document.getElementById('checks').style.display="";
        document.getElementById('checks_nav').style.display="";
        for(var i=0; i<document.getElementsByClassName("check-filtro").length; i++){
            document.getElementsByClassName("check-filtro")[i].checked =false;
            document.getElementsByClassName("check-filtro_nav")[i].checked =false;
        }
        for(var j=0;j<document.getElementsByClassName('producto').length;j++){
            document.getElementsByClassName('producto')[j].style.display="";
        }
        for (let i = 0; i < document.getElementsByClassName("check-subcat").length; i++) {
            if(document.getElementsByClassName("check-subcat")[i].checked){
                for (let j = 0; j < categorias.length; j++) {
                    if(categorias[j].id==document.getElementsByClassName("check-subcat")[i].id){
                        aplicados_cat.push(categorias[j].nombre+": "+document.getElementsByClassName("check-subcat")[i].name);
                        break;
                    }
                    
                }
                cat.push(document.getElementsByClassName("check-subcat")[i].value);
            }
            
        }
     
        if(aplicados_cat.length>0){
            document.getElementById("categorias_aplicados").style.display="";
            document.getElementById("categorias_aplicados_nav").style.display="";
            document.getElementById("categorias_aplicados").innerHTML="";
            document.getElementById("categorias_aplicados_nav").innerHTML="";
            document.getElementById("categorias_aplicados").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Categorias Aplicadas</h1> <button onclick='borrar_categorias()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            document.getElementById("categorias_aplicados_nav").innerHTML="<div style='display:flex; justify-content:space-between; padding:0 0 20px 0;'><h1 class='font-weight-bold text-dark' style='padding-top:1px;'>Categorias Aplicadas</h1> <button onclick='borrar_categorias_nav()'><i class='bi bi-x' style='color:black; font-size:24px;margin-top: 0px;'></i></button></div>";
            for(var i=0;i<aplicados_cat.length;i++){
                document.getElementById("categorias_aplicados").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados_cat[i]+"</p>";
                document.getElementById("categorias_aplicados_nav").innerHTML+="<p style='font-size:10px; font-weight:bold; display:inline-block; background-color:white; padding:5px 10px 5px 10px; margin:0 5px 5px 0; border-radius:10px; border:2px solid gray;'>"+aplicados_cat[i]+"</p>";
            }
            document.getElementById("categorias_aplicados").innerHTML+="<hr style='margin-top:16px;'>";
            document.getElementById("categorias_aplicados_nav").innerHTML+="<hr style='margin-top:16px;'>";

        }else{
            document.getElementById("categorias_aplicados").style.display="none";
            document.getElementById("categorias_aplicados_nav").style.display="none";

        }
        let sentencias =document.getElementsByClassName('producto')[0].getAttribute("data-subcategoria").split("-");
        if(sentencias[(sentencias.length-1)]=="")
        {
            sentencias.pop();
        } 

        for (let i = 0; i < cards.length; i++) {
            document.getElementsByClassName('producto')[i].style.display="none";
            let sentencias =document.getElementsByClassName('producto')[i].getAttribute("data-subcategoria").split("-");
            for (let j = 0; j < sentencias.length; j++) {
                if(cat.length!=0){
                    for (let k = 0; k < cat.length; k++) {
                        if(sentencias[j]==cat[k]){
                            document.getElementsByClassName('producto')[i].style.display="";
                            break;
                        }
                    }
                }else{
                    document.getElementsByClassName('producto')[i].style.display="";
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

        var vacio=true;
        for(var i=0;i<cards.length;i++){
            if(cards[i]===true){
                vacio=false;
                console.log("vacio");
                break;
                
            }
        }
        if(vacio){
            $('#vacio').show();

        }else{
            $('#vacio').hide();

        }
        
    }

    function borrar_categorias()
    {
        for(var i=0; i<document.getElementsByClassName("check-subcat").length; i++){ document.getElementsByClassName("check-subcat")[i].checked =false; }
        aplicar_categorias();
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
    
    $("#selectOrden_nav").on('change', function()
    {
        var value=$("#selectOrden_nav").val();
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
        $("#selectOrden_barra").val(value);
        $("#productAvailable").html(divOrder);
    });

    $("#selectOrden_barra").on('change', function()
    {
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
        $("#selectOrden_nav").val(value);
        $("#productAvailable").html(divOrder);
    });

    function resta(that)
    {
        if(document.getElementById("input_sr"+that.id).value>1){
            document.getElementById("input_sr"+that.id).value--;
        }
    }

    function suma(that,modal)
    {
        if(parseInt(document.getElementById("input_sr"+that.id).value, 10)<parseInt(that.value, 10)){
            document.getElementById("input_sr"+that.id).value++;
        }
    }
    
    function agregar(that,modal)
    {
        var name=that.getAttribute("name");
        var price=that.getAttribute("min");
        var image=that.getAttribute("accept");
        var slug=that.getAttribute("alt"); 

        

        if(!modal)
        {
            var id=that.id;
            var quantity=document.getElementById("input_sr"+that.id).value;
            document.getElementById("loading").style.top=(document.getElementById("barra").getBoundingClientRect().top+window.scrollY);
            $("#loading").show();
            that.style.backgroundColor="#68c387";
            document.getElementById("productAvailable").style.opacity= 0.4;
            document.getElementById("productAvailable").style.pointerEvents = "none";
        }else{
            var id = document.getElementById("detalle_agregar").getAttribute("max");
            var quantity = document.getElementById("detalle_input").value;
        }

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
            document.getElementById("cantcart").innerHTML=response.data.cantcarro;
            
            if(!modal)
            {   
                that.style.backgroundColor="#19A448";
                $("#loading").hide();
                document.getElementById("input_sr"+that.id).value=1;
                document.getElementById("productAvailable").style.opacity= 1;
                document.getElementById("productAvailable").style.pointerEvents = "auto";
            }

            document.getElementById("subtotal").innerHTML="$"+response.data.total.toLocaleString('de-DE');
            document.getElementById("total").innerHTML="$"+response.data.total.toLocaleString('de-DE');

            if(response.data.tipo_mensaje=="warning"){
                toastr.remove();
                toastr.warning(response.data.mensaje,"Problemas",{"progressBar": true,"positionClass": "toast-top-right","timeOut": "5000","extendedTimeOut": "0"});
            }else if(response.data.tipo_mensaje=="danger"){
                toastr.remove();
                toastr.error(response.data.mensaje,"Error",{"progressBar": true,"positionClass": "toast-top-right","timeOut": "5000","extendedTimeOut": "0"});
            }else if(response.data.tipo_mensaje=="success"){
                toastr.remove();
                toastr.success(response.data.mensaje,"Éxito",{"progressBar": true,"positionClass": "toast-top-right","timeOut": "5000","extendedTimeOut": "0"});
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
            document.getElementById("toast-container").style.top=(window.scrollY+12);

        })
        .catch(function(error) {
            that.style.backgroundColor="#19A448";
                $("#loading").hide();
                document.getElementById("input_sr"+that.id).value=1;
                document.getElementById("productAvailable").style.opacity= 1;
                document.getElementById("productAvailable").style.pointerEvents = "auto";
            toastr.remove();
            toastr.error('La acción no se pudo realizar',"Eroor",{"progressBar": "true","positionClass": "toast-top-right","timeOut": "20000","extendedTimeOut": "0"});
            document.getElementById("toast-container").style.top=(window.scrollY+12);    
        });
    }

    function abrir_catfil_parcial()
    {
        document.body.style.overflow = 'hidden';
        document.getElementById("nav_catfil").style.top=(window.scrollY+document.getElementById("barra").getBoundingClientRect().top-2);
        document.getElementById("nav_catfil").style.height=(window.innerHeight-(document.getElementById("barra").getBoundingClientRect().top-2));
        document.getElementById("catfil").style.height=(window.innerHeight-(document.getElementById("head").getBoundingClientRect().height+document.getElementById("head").getBoundingClientRect().top)-107.2);
        $('#nav_catfil').show();
        document.getElementById("catfil").style.transition="1s";
        document.getElementById("catfil").style.width="360px";
        document.getElementById("titulo_catfil").style.transition="1s";
        document.getElementById("titulo_catfil").style.left="0";

    }

    function cerrar_catfil_parcial(cerado_rapido)
    {
        document.body.style.overflow = 'auto';

        if(cerado_rapido){
            document.getElementById("nav_catfil").style.display="none";
        }else{
            $("#nav_catfil").delay(500).fadeOut();
        }
        document.getElementById("catfil").style.width="0px";
        document.getElementById("titulo_catfil").style.left="-360px";
    }

    function abrir_carro_parcial()
    {
        document.body.style.overflow = 'hidden';
        
        document.getElementById("titulo").style.height="91.2px";
        document.getElementById("resumen").style.height="53.8px";
        document.getElementById('icono').innerHTML = '<i class="bi bi-chevron-up"></i>';
        document.getElementById("nav_carrito").style.top=(window.scrollY+document.getElementById("barra").getBoundingClientRect().top-2);
        document.getElementById("nav_carrito").style.height=(window.innerHeight-(document.getElementById("barra").getBoundingClientRect().top-2));
        document.getElementById("lista").style.height=(parseInt(document.getElementById("nav_carrito").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10)-2);
        $('#nav_carrito').show();
        document.getElementById("carrito").style.transition="1s";
        document.getElementById("carrito").style.width="360px";
    }

    function cerrar_carro_parcial(cerado_rapido)
    {
        document.body.style.overflow = 'auto';

        if(cerado_rapido){
            document.getElementById("nav_carrito").style.display="none";
        }else{
            $("#nav_carrito").delay(500).fadeOut();
        }
        $("#cuerpo_resumen").delay(500).fadeOut();
        document.getElementById("resumen").style.height="53.8px";
        document.getElementById("lista").style.height=(parseInt(document.getElementById("nav_carrito").style.height,10)-parseInt(document.getElementById("titulo").style.height,10)-parseInt(document.getElementById("resumen").style.height,10));
        document.getElementById("carrito").style.width="0px";
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
    
    
    .accordion-body{
        padding-top: 0 !important;
    }

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
            padding:0 0 15px 15px !important;
            width:50% !important;
        }
        
    }
    @media only screen and (min-width: 1024px) {
        .col_productos{
            padding:0 0 15px 15px !important;
            width:33.33333% !important;
        }
        
    }
    @media only screen and (min-width: 1280px) {
        .col_productos{
            padding:0 0 15px 15px !important;
            width:25% !important;
        }
        
    }
    
    

    body{

        background:url("/image/fondo-tienda.png");
        background-repeat: repeat;
        background-attachment: fixed;
        background-size:400px;
        backdrop-filter:blur(1px);

    }
</style>