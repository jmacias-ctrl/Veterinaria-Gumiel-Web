@extends('layouts.appshop')
@section('title')
LOGIN SHOP | Veterinaria Gumiel
@endsection
@section('content')

<div class="container">
    <div class="row"  style="height:100%; justify-content:center; align-items: center;">
        <div class="col-lg-5 p-0 m-0">
            <div class="card p-5 shadow">
                <div class="text-center text-muted mb-4">
                    <h3>Inicio de Sesion</h3>
                </div>
                <form method="POST" action="{{ route('login_shop') }}">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input id="email" type="text" placeholder="Correo"
                                class="p-2 form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email">
                        </div>
                        @error('email')
                            <span class="text-warning" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input id="password" placeholder="Contraseña" type="password"
                                class="p-2 form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="current-password pl-5">
                        </div>
                            @error('password')
                                <span class="text-warning" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                    </div>
                    @error('message')
                            <span class="text-warning" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-success my-4" style="background-color:#19A448; border-color:#19A448">Iniciar Sesion</button>
                    </div>
                </form>

                <div>
                    <form class="m-0" action="{{route('shop.checkout.registro_invitado')}}" method="get">
                        {{csrf_field()}}
                        <button class="a-dec font-weight-bold ">Borrar Carrito</button>
                    </form>
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
        background-size:450px;
        backdrop-filter:blur(1px);
        background-color:white;
        height: 100%;
    }
</style>