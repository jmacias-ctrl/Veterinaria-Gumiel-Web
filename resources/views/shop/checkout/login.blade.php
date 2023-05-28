@extends('layouts.appshop')
@section('title')
CHECKOUT - Veterinaria Gumiel
@endsection
@section('content')
<!-- INICIO formulario de ingreso de invitados -->
 
<div class="container" style="height:100%">
    <div class="row justify-content-center" style="height:100%">
        <div class="col-lg-6 p-0" style="display: flex; flex-direction: column; justify-content: center;">
            <div class=" p-5 bg-white shadow border">
            <div class="card bg-secondary shadow border-0">

                    
                        <div class="text-center text-muted mb-4">
                            <h3>Inicio de Sesion</h3>

                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" type="email" placeholder="Correo"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" placeholder="Contraseña" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">
                                    <span class="text-muted">Recuerdame</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success my-4" style="background-color:#19A448; border-color:#19A448">Iniciar Sesion</button>
                            </div>
                        </form>
                    </div>
                </div>
          

        </div>
        <div class="col-lg-6 p-0"  style="display: flex; flex-direction: column; justify-content: center;">
            <div class=" p-5 justify-content-start align-items-center bg-white shadow border">    
            caca
            </div>
        </div> 

    <!-- <form id="forminvitado">
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
    </div>
    </div> -->
<!-- FIN formulario de ingreso de invitados -->

@endsection
<style> 
    body{
        background:url("/image/fondo-tienda.png");
        background-repeat: repeat;
        background-attachment: fixed;
        background-size:450px;
        backdrop-filter:blur(1px);
        height: 100%;
    }
</style>