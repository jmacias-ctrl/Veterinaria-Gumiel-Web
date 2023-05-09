@extends('layouts.app')
@section('title')
Carro de Compras - Veterinaria Gumiel
@endsection
@section('content')
    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/shop">Tienda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito</li>
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
        @if(count($errors) > 0)
            @foreach($errors0>all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <br>

                @if(\Cart::getTotalQuantity()>0)

                    <h4>{{ \Cart::getTotalQuantity()}} Producto(s) en el carrito</h4><br>
                @else
                    <h4>Carrito vacio</h4><br>
                    <a href="/shop" class="btn btn-dark">Continue en la tienda</a>
                @endif

                @foreach($cartCollection as $item)

                    <div class="row">
                        <div class="col-lg-2">
                            <img src="/image/productos/{{ $item->attributes->image }}" class="img-thumbnail" >
                        </div>
                        <div class="col-lg-6">
                            <p>
                                <b><a href="/shop/show/{{ $item->id }}">{{ $item->name }}</a></b><br>
                                <b>Precio: </b>${{ $item->price }}<br>
                                <b>Sub Total: </b>${{ \Cart::get($item->id)->getPriceSum() }}<br>
                                {{--<b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                            </p>
                        </div>
                        
                        <div class="col-lg-4" style="display:flex;">
                            <div>
                                <form style="display:flex;" action="{{ route('shop.cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    
                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}"
                                               id="quantity" name="quantity" style="margin:0 10px 0 0; width: 70px;" min="1" max="{{ $item->stock }}">
                                        
                                        <button class="btn btn-secondary btn-sm" style="margin:0 10px 0 0; height:30px; width: 33px;"><i class="fa fa-edit"></i></button>
                                    

                                </form>
                            </div>
                            <div>
                                <form action="{{ route('shop.cart.remove') }}" method="POST" >
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right:5px; width: 33px;"><i class="fa fa-trash" style="width: 14px; heigth: 14px; "></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                
            </div>
            

                <div class="col-lg-4">
                <br>
                    <div class="card" style="margin: 0 10px 0 0;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b>${{ \Cart::getTotal() }}</li>
                        </ul>
                    </div>
                    <br>
                    <div style="display:flex;">
                        <div style="margin: 0 10px 0 0;">
                            <a href="/shop" class="btn btn-dark">Ir a tienda</a>
                        </div>    
                        <div style="margin: 0 10px 0 0;">
                            <a href="/checkout" class="btn btn-success">Comprar</a>
                        </div>
                        <div style="margin: 0 10px 0 0;">
                            <form action="{{route('shop.cart.clear')}}" method="POST">
                                {{csrf_field()}}
                                <button class="btn btn-secondary btn-md">Borrar Carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            
        </div>
        <br><br>
    </div>
@endsection
