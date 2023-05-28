@extends('layouts.app')
@section('title')
{{ $producto->nombre }} - Veterinaria Gumiel
@endsection
@section('content')
<div class="container" style="margin-top: 30px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item" ><a href="/shop">Tienda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Producto</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                        <h4>Producto</h4>
                        <div class="row"  style="margin:0; background-color:white;">
                            <div class="col-lg-4">
                                <img src="/image/productos/{{ $producto->imagen_path }}"
                                            class="card-img-top mx-auto"
                                            style="height: 300px; width: 300px; "
                                            alt="{{ $producto->imagen_path }}"
                                        >
                            </div>
                            <div class="col-lg-8" style="padding:10px;" >
                                <h5>{{ $producto->marca}}</h5>
                                <h4 class="card-title">{{ $producto->nombre }}</h4>
                                <h5>Precio: ${{ $producto->precio}}</h5>
                                <h6>Stock: {{ $producto->stock}}</h6><br>
                                <h5>Descripcion:</h5>
                                <h5>{{ $producto->descripcion}}</h5><br>
                                <div >
                                    <div class="row" style="display:inline;">
                                <form action="{{ route('shop.cart.store') }}" method="POST"  class="card-footer">
                                
                                        
                                    
                                    
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $producto->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $producto->nombre }}" id="name" name="name">
                                        <input type="hidden" value="{{ $producto->precio }}" id="price" name="price">
                                        <input type="hidden" value="{{ $producto->imagen_path }}" id="img" name="img">
                                        <input type="hidden" value="{{ $producto->nombre }}" id="slug" name="slug">
                                        <div style="display:flex;">
                                            <div style="margin: 0 10px 0 0;">
                                                <input type="number" class="form-control form-control-sm" value="1"
                                                id="quantity" name="quantity" style="width: 80px; height:40px;" min="1" max="{{ $producto->stock }}">
                                            </div>   
                                            <div style="margin: 0 10px 0 0;"> 
                                                <button style=" height:40px;" class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                        <i class="fa fa-shopping-cart"></i> Agregar al Carrito
                                                </button>
                                            </div>   
                                            <div style="margin: 0 10px 0 0;">
                                                <a style=" height:40px;" class="btn btn-success" class="tooltip-test" title="checkout" href="/shop">Volver a Tienda</a>
                                            </div>   
                                        </div>  
                                                 
                                        
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    }
</style>