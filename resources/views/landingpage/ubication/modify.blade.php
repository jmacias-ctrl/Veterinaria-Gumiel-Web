@extends('layouts.panel_usuario')
<title>Modificacion de Ubicacion - Veterinaria Gumiel</title>
@section('css-before')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .imageProfile {
        width: 150px;

    }
</style>
@endsection
@section('js-before')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('back-arrow')
<a href="{{ route('user.profile.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
        arrow_back
    </span> </a>
@endsection
@section('header-title')
Modificacion del Perfil {{ Auth::user()->name }}
@endsection
@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            @if (auth()->user()->hasRole('Admin'))
            <a href="{{ route('admin') }}" style="color:black;">
                @elseif(auth()->user()->hasRole('Veterinario'))
                <a href="{{ route('veterinario') }}">
                    @elseif (auth()->user()->hasRole('Peluquero'))
                    <a href="{{ route('peluquero') }}">
                        @elseif (auth()->user()->hasRole('Inventario'))
                        <a href="{{ route('inventario') }}">
                            @endif
                            Inicio</a>
        </li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.profile.index') }}" style="color:black;">Perfil de {{ auth()->user()->name }}</a> </li>
        <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Landing Page</li>
</nav>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow p-4">
            <form action="{{ route('landing.ubication.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- <input type="hidden" name="id" value="{{ Auth::user()->id }}"> -->

                <h4 class="mt-4">Informacion de Ubicacion</h4>
                <hr>
                <div class="row mt-3">
                    <div class="col">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Ej. Villagran 437,Cañete,Chile." aria-label="direccion" value="{{$landingMaps->direccion}}" required>
                        @error('direccion')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="telefono" class="form-label">Telefono</label>
                        <div class="input-group">
                            <div class="input-group-text">+56</div>
                            <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" placeholder="954231232" maxlength="9" minlength="9" value="{{ $landingMaps->telefono }}">
                        </div>
                        @error('telefono')
                        <div class="text-danger"><span><small>{{ "Numero invalido" }}</small></span></div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="horarios" class="form-label">Horarios</label>

                        <textarea class="form-control @error('horarios') is-invalid @enderror" id="horarios" name="horarios" placeholder="insta_link" rows="3" required>{{ $landingMaps->horarios }}</textarea>

                        @error('horarios')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col">
                        <label for="wsp" class="form-label">Whatsapp</label>

                        <input type="text" class="form-control @error('wsp') is-invalid @enderror" id="whatsapp" name="whatsapp" placeholder="wsp_link" value="{{ $landingMaps->whatsapp }}" required>

                        @error('wsp')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="facebook" class="form-label">Facebook</label>

                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="wsp" name="facebook" placeholder="face_link" value="{{ $landingMaps->facebook }}" required>

                        @error('wsp')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="instagram" class="form-label">Instagram</label>

                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="wsp" name="instagram" placeholder="insta_link" value="{{ $landingMaps->instagram }}" required>

                        @error('wsp')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-center mt-4">
                    <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Modificar datos" style="background-color:#19A448; border-color:#19A448;">
                </div>


            </form>

            <form action="{{ route('landing.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h4 class="mt-4">Informacion de Nosotros</h4>
                <hr>

                <div class="row mt-3">
                    <div class="col">
                        <label for="nosotros" class="form-label">Nosotros</label>

                        <textarea class="form-control @error('nosotros') is-invalid @enderror" id="nosotros" name="nosotros" placeholder="nosotros" rows="20" required>{{ $landingpage_config->aboutUs }}</textarea>

                        @error('nosotros')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-center mt-4">
                    <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Modificar datos" style="background-color:#19A448; border-color:#19A448;">
                </div>

            </form>
            
        </div>
    </div>
</div>
@endsection

@section('js-after')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var Fn = {
        validaRut: function(rutCompleto) {
            if (!/^[0-9]+-[0-9kK]{1}$/.test(rutCompleto))
                return false;
            var tmp = rutCompleto.split('-');
            var digv = tmp[1];
            var rut = tmp[0];
            if (digv == 'K') digv = 'k';
            return (Fn.dv(rut) == digv);
        },
        dv: function(T) {
            var M = 0,
                S = 1;
            for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11;
            return S ? S - 1 : 'k';
        }
    }
    $(document).ready(function() {
        $('#btn-submit').on('click', function(e) {
            var rut = document.getElementById('rut').value;
            e.preventDefault();
            if (!Fn.validaRut(rut)) {
                Swal.fire(
                    'Error',
                    'Rut ingresado no sigue el formato, debe ser xxxxxxxx-x',
                    'error'
                )
                return;
            } else {
                var form = $(this).parents(form);
                Swal.fire({
                    title: 'Modificar tu Perfil de Usuario',
                    text: "¿Estás seguro de que todos los datos estan correctos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, modificar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

        });
    })
</script>
@endsection