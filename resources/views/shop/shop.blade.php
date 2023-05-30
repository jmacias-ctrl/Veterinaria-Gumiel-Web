@extends('layouts.app')
@section('title')
Tienda - Veterinaria Gumiel
@endsection
@section('content')

<div class="container" style="margin-top: 20px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tienda</li>
        </ol>
    </nav>


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
                    <div class="col-lg-7" style="margin-bottom: 20px">
                        <h4>Productos</h4>
                    </div>
                </div>
                
                <div class="row">
                    @foreach($products as $pro)
                        <div class="col-lg-3">
                            <div class="card" style="background-color:light-gray; margin-bottom: 20px; height: auto;">
                                <img src="/image/productos/{{ $pro->imagen_path }}"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt="{{ $pro->imagen_path }}"
                                >
                                        
                                <div class="card-body">
                                <p>{{ $pro->marca }}</p>
                                    <h6 class="card-title">{{ $pro->nombre }}</h6>
                                    <form action="{{ route('shop.cart.store') }}" method="POST">
                                    <div style="display:flex;">
                                        <p>$ {{ $pro->precio }}</p>
                                        <input type="number" class="form-control form-control-sm" value="1"
                                               id="quantity" name="quantity" style="margin-left: auto; width: 70px; margin-right:15px;" min="1" max="{{ $pro->stock }}">
                                    </div>
                                    
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $pro->nombre }}" id="name" name="name">
                                        <input type="hidden" value="{{ $pro->precio }}" id="price" name="price">
                                        <input type="hidden" value="{{ $pro->imagen_path }}" id="img" name="img">
                                        <input type="hidden" value="{{ $pro->nombre }}" id="slug" name="slug">
                                        
                                        <div class="card-footer" style="background-color: white;">
                                              <div class="row">
                                                <button style="margin: 0 auto;" class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> Agregar al Carrito
                                                </button>
                                                <a style="margin: 6px auto;" class="btn btn-success" class="tooltip-test" title="checkout" href="{{ route('shop.show' ,['id'=>$pro->id]) }}">Detalles</a>
                                                
                                            </div>
                                        </div>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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