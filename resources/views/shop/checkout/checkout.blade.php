@extends('layouts.app')
@section('content')

<script>

    $(function(){
            $('#registro_invitado').click(function(){
                $('#reg_invitado').toggle();
            
            });
        });
    
    </script>
{{dd(Auth::user())}}
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/shop">Tienda</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="/shop/cart">Carrito</a></li>
            <li class="breadcrumb-item active" aria-current="page">Resumen de Compra</li>
        </ol>
    </nav>

    
    <div class="row justify-content-center">
        <h4 style="margin-bottom:20px;">Resumen de Compra</h4>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">
                        <table class="table table-secondary shadow">
                            <thead>
                                <tr class="table-active border-0">
                                    <th scope="col" colspan="2" class="col-lg-10 border-0">Detalle</th>
                                    <th scope="col" class="col-lg-2 border-0">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartCollection as $item)
                                    <tr>
                                        <td style="border-bottom:0;"><img src="/image/productos/{{ $item->attributes->image }}" style="max-height: 50px; margin:auto;"></td>
                                        <td style="border-bottom:0;"><h5>{{$item->name}}</h5><small>cantidad: {{$item->quantity}}</small></td>
                                        <td style="vertical-align:middle; border-bottom:0;">${{number_format($item->price, 0, ',', '.')}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                    @if (!Auth::check())
                        <div class="shadow border-0 mb-3" style="background-color:#cbccce">
                            <div class="card-body p-4">
                                <div class="d-grid gap-3 mb-3 pr-5 pl-5">    
                                    <a class="btn btn-success" class="tooltip-test" href="{{ route('login') }}">Ir a Iniciar Sesion</a>
                                </div>
                                <div class="d-grid gap-3 mb-0 pr-5 pl-5">    
                                    <button type="submit" id="registro_invitado" name="registro_invitado" class="btn btn-success" >Registrate como Invitado</button>
                                </div>
                            </div> 
                            <div id="reg_invitado" style="display:none;">
                                <hr style="margin:0 24px 0 24px;">
                                <div class="card-body p-4">
                                    <div class="text-center text-muted mb-4">
                                        <h4>Registro Invitado</h4>
                                    </div>

<!-- INICIO formulario de ingreso de invitados -->

                                    <form id="forminvitado">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i class="ni ni-single-02"></i></span>
                                                </div>
                                                <input id="name" type="text"
                                                class="pl-2 form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                                placeholder="Juan Perez">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i class="ni ni-badge"></i></span>
                                                </div>
                                                <input type="text" class="pl-2 form-control @error('rut') is-invalid @enderror" id="rut"
                                                name="rut" placeholder="Ej. 12345678-9" value="{{ old('rut') }}" required>
                                            </div>
                                            @error('rut')
                                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group row">
                                                <div class="input-group">
                                                    <div style="width:50px; justify-content: center;" class="input-group-text">+56</div>
                                                    <input type="number" class="pl-2 form-control @error('telefono') is-invalid @enderror"
                                                        id="telefono" name="telefono" placeholder="954231232" maxlength="9" minlength="9"
                                                        value="{{ old('telefono') }}" >
                                                </div>
                                            
                                            @error('telefono')
                                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                </div>
                                                <input id="email" type="email" placeholder="juan.perez@gmail.com"
                                                    class="pl-2 form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email">
                                            </div>    
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input id="password" type="password" placeholder="Ingresar nueva contraseña"
                                                class="pl-2 form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input id="password_confirm" placeholder="Confirmar nueva contraseña" type="password" class="pl-2 form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">Registrarse</button>
                                        </div>
                                    </form>

<!-- FIN formulario de ingreso de invitados -->

                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="shadow border-0 mb-3" style="background-color:#cbccce">
                            <div class="card-body p-5">
                                <div style="text-align:end;" class="form-group">  
                                <a style="margin-right:10px" href="/shop">Volver a Tienda</a>
                                </div>
                                <div class="text-center text-muted mb-3">
                                    <h5>Sumario Compra</h5>
                                </div>
                                <div><hr class="mt-0 mb-3"></div>
                                <div class="form-group">
                                    <div class="row ">
                                        <div class="col-lg-5">
                                            <h6>SubTotal:</h6>
                                        </div>
                                        <div class="col-lg-7">
                                            <h6>${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h6>
                                        </div>
                                        
                                        <div class="col-lg-5">
                                            <h6>Total:</h6>
                                        </div>
                                        <div class="col-lg-7">
                                            <h6>${{ number_format(\Cart::getTotal(), 0, ',', '.') }}</h6>
                                        </div>
                                       

                                    </div> 
                                    <div><hr class="mt-2 mb-4"></div>
                                    <div class="text-center text-muted mb-3">
                                    <h5>Metodo de Pago</h5>
                                </div>
                                <input type="radio" name="seleccionar" onchange="radioChange(this);" id="pago" value="webpayplus">webpay plus<br>

                                    <form id="url_check" name="url_check" method="post" action="Inserta aquí la url entregada">
                                        
                                        <input type="submit" hidden class="btn btn-success mt-4" value="Ir a pagar" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkByDefault(){
        document.getElementById("pago").checked = false;        
    }window.load = checkByDefault();
    
    function radioChange( that ){ 
        alert(that.value);
        $.ajax({
            type:'POST',
            url:'/'+that.value, 
            data:{

                '_token': $('input[name=_token]').val()
            },
            success:function(data) {
                $('#token_check').val(data.token);
                var url = document.forms['url_check'];
                url.action = data.url+"?token_ws="+data.token;
                url.submit();
                
                alert(data.url);
                alert(data.token);
            }
        });
    }
</script>
      


<!-- <script> 
// function radioChange( that ){
//     let val = that.value;
//     if( that.id != '' ){
//         let nombre = document.getElementById('Nombre').value;
//         alert( that.id);
//     }else{
//         alert( val ); 
//     }
// }
// </script>-->



<script>//scriptt de login invitado

    document.getElementById("registro_invitado").disabled = true; 
    $('#forminvitado').submit(function(e){
        e.preventDefault();

        var name=$('#name').val();
        var email=$('#email').val();
        var password=$('#password').val();
        var password_confirmation=$('#password_confirmation').val();
        
        alert("paso a ajax");


        $.ajax({
            url: "{{ route('register') }}",
            type: "POST",
            dataType: 'JSON',
            data:{
                name: name,
                email: email,
                password: password,
                password_confirmation:password_confirmation,
                _token: '{{csrf_token()}}'
            },
            success:function(response){
                if(response){
                    alert("PASSSO");
                    $('#form_invitado')[0].reset(0);
                }
            },
            error: function () {
                alert("ERRORRRRR");
            }
        });
        
    });
    



</script>
@endsection