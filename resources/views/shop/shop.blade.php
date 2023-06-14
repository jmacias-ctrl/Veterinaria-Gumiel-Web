@extends('layouts.app')
@section('title')
Tienda - Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')
<style>
        .fc:focus{
          outline: none;
        }
      </style>



<div class="container mt-2">
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 bg-white shadow p-4" style="margin-bottom: 20px; display:flex; justify-content:space-between">
                        <h2 class=" text-dark font-weight-bold">Productos</h2>
                    
                        <form action="{{route('shop.shop')}}" method="get" class="mt-auto mb-auto">
                            <div class="input-group input-group-alternative" style="border: 2px solid gray; border-radius:10px;">
                                <input type="text" class="pt-2 pr-3 pb-2 pl-3 fc bg-transparent text-dark border-0" name="texto" id="texto" placeholder="Buscar" value="{{$texto}}">
                                <div class="input-group-prepend">
                                <button type="submit" class="input-group-text bg-transparent border-0 pr-3"><i class="bg-transparent text-dark bi bi-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="row m-0 p-0">
                    @if(count($products)>0)
                        @foreach($products as $pro)
                            <div class="col-lg-3 p-1">
                                
                                <div class="card pt-3" style="background-color:light-gray; margin-bottom: 20px; height: auto;">
                                    @if (!$pro->stock)
                                        <div class="w-100" style="position:absolute;">
                                            <img src="/image/agotado.png" style="margin:auto; width: 150px;">
                                        </div>
                                    @endif
                                    <img src="/image/productos/{{ $pro->imagen_path }}"
                                    class="card-img-top mx-auto"
                                    style="height: 150px; width: 150px;display: block;"
                                    alt="{{ $pro->imagen_path }}">
                                            
                                    <div class="card-body">
                                        <h6 class="card-title overflow-ellipsis " style=" white-space: nowrap; overflow: hidden;">{{ $pro->slug }}</h6>
                                        <form class="m-0" action="{{ route('shop.cart.store') }}" method="POST">
                                        <div class="mb-2" style="display:flex;">
                                            <p class="mt-2 mb-2">${{number_format($pro->precio, 0, ',', '.')}}</p>
                                            @if (!$pro->stock)
                                            <input type="number" class="form-control form-control-sm" value="1"
                                                id="quantity" name="quantity" style="margin: auto 0 auto auto; width: 70px;" min="1" max="{{ $pro->stock }}">
                                            @else
                                            <input type="number" diasbled class="form-control form-control-sm" value="1"
                                                id="quantity" name="quantity" style="margin: auto 0 auto auto; width: 70px;" min="1" max="{{ $pro->stock }}">
                                            @endif
                                            
                                        </div>
                                        
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                            <input type="hidden" value="{{ $pro->nombre }}" id="name" name="name">
                                            <input type="hidden" value="{{ $pro->precio }}" id="price" name="price">
                                            <input type="hidden" value="{{ $pro->imagen_path }}" id="img" name="img">
                                            <input type="hidden" value="{{ $pro->nombre }}" id="slug" name="slug">
                                            
                                            <div class=" p-0 pt-2" style="background-color: white;">
                                                <div class="row m-0">
                                                    @if ($pro->stock)
                                                        <input type="submit" value="Agregar al carrito" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                                                    @else
                                                        <input type="submit" disabled value="Agregar al carrito" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                                                       
                                                    @endif
                                                    <a style="margin: 6px auto;" class="btn btn-secondary" class="tooltip-test" title="checkout" href="{{ route('shop.show' ,['id'=>$pro->id]) }}">Detalles</a>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="row justify-content-center shadow m-0 p-0">
                        <div class="col-lg-6 bg-white m-0 p-5" style="text-align: center;">
                            <h3>No se encontraron productos</h3>
                            <span>para tu busqueda "{{$texto}}"</span>
                                <div class="pt-3">
                                    <a href="/shop" class="btn font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;">Volver</a>
                                </div>
                        </div>
                    </div>

                    @endif
                </div>
                {{$products->links()}}
            </div>
        </div>
    </div>


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