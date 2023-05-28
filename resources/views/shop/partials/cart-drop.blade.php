@if(count(\Cart::getContent()) > 0)
    @foreach(\Cart::getContent() as $item)
        <li class="list-group-item">
            <div class="row">
                <div class="col-lg-3">
                    <img src="/image/productos/{{ $item->attributes->image }}"
                         style="width: 50px; height: 50px;"
                    >
                </div>
                <div class="col-lg-6">
                    <b>{{$item->name}}</b>
                    <br><small>cant: {{$item->quantity}}</small>
                </div>
                <div class="col-lg-3">
                <b>Precio: </b>${{ $item->price }}<br>
                <b>SubTotal: </b>${{ \Cart::get($item->id)->getPriceSum() }}
                </div>
                <hr>
            </div>
        </li>
    @endforeach
    <br>
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-10">
                <b>Total: </b>${{ \Cart::getTotal() }}
            </div>
            <div class="col-lg-2">
                <form action="{{ route('shop.cart.clear') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </li>
    <br>
    <div class="row" style="margin: 0px;">
        <a class="btn btn-dark btn-sm btn-block" href="{{ route('shop.cart.index') }}">
            CARRITO <i class="fa fa-arrow-right"></i>
        </a>
        <a class="btn btn-dark btn-sm btn-block" href="{{ route('shop.checkout.checkout') }}">
            COMPRAR <i class="fa fa-arrow-right"></i>
        </a>
    </div>
@else 
    <li class="list-group-item">Tu carrito esta vacío</li>
@endif
