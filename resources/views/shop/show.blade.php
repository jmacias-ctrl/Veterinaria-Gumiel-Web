@extends('layouts.app')
@section('title')
{{ $producto->nombre }} | Veterinaria Gumiel
@endsection
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
                    @if (!$producto->stock)
                        <div class="w-100 h-100" style="position:absolute;">
                            <img src="/image/agotado.png" style="margin:auto; width: 50%; margin-top: 20%;">
                        </div>
                    @endif
                    <img src="/image/productos/{{ $producto->imagen_path }}"
                                class=" card-img-top mx-auto mt-3"
                                style="height: 300px; width: 300px; margin-top: 10px;"
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
                                            <div style="margin: 0;">
                                                @if (!$producto->stock)
                                                    <input type="number" class="h-100 form-control form-control-sm" value="1"
                                                        id="quantity" name="quantity" style="margin-left: auto; width: 70px; margin-right:15px;" min="1" max="{{ $producto->stock }}">
                                                @else
                                                    <input type="number" disabled class="h-100 form-control form-control-sm" value="1"
                                                        id="quantity" name="quantity" style="margin-left: auto; width: 70px; margin-right:15px;" min="1" max="{{ $producto->stock }}">
                                                @endif
                                            </div>   
                                            <div style="margin: 0 10px 0 0;"> 
                                                    @if (!$producto->stock)
                                                            <input type="submit"  value="Agregar al carrito" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                                                            
                                                            @else
                                                            <div id="submitButton">
                                                        <input type="submit" disabled  value="Agregar al carrito" class="btn btn-block font-weight-bold" style="color:white; background-color:#19A448; border-color:#19A448;"/>
                                                        </div>
                                                    
                                                        @endif
                                            </div>   
                                            <div style="margin: 0 10px 0 0;">
                                                <a  class="btn  bg-secondary text-white" class="tooltip-test" title="checkout" href="/shop">Volver a Tienda</a>
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
    
        <script>
    $(document).ready(function() {
        $("#submitButton").on('click', function(event) {
            toastr.remove();
            toastr.error('Producto agotado, vuelve mas tarde','Agotado');
            event.preventDefault();
        });
    });
</script>
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