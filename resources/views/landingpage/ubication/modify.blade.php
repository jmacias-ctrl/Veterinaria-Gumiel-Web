@extends('layouts.panel_usuario')
<title>Modificación Información General - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
    Modificación Información General
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Información General </li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('landing.ubication.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- <input type="hidden" name="id" value="{{ Auth::user()->id }}"> -->
                    <div class="d-flex justify-content-center">
                        <div class="btn-group btn-group-lg" role="group">
                            <a class="btn btn-outline-success active" href="{{ route('landing.ubication.edit') }}"
                                role="button">Información</a>
                            <a class="btn btn-outline-success" href="{{ route('landing.nosotros.edit') }}"
                                role="button">Sección Nosotros</a>
                            <a class="btn btn-outline-success" href="{{route('landing.website.edit')}}" role="button">Landing Page</a>
                            <a class="btn btn-outline-success" href="" role="button">Horario</a>
                        </div>
                    </div>

                    <h2 class="mt-4">Información</h2>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="nombre" class="form-label">Nombre</label>
                            <p>Nombre que identifica su centro veterinario</p>
                            <input type="text" id="nombre" name="nombre"
                                class="form-control @error('nombre') is-invalid @enderror"
                                placeholder="Ej. Veterinaria Test" aria-label="nombre" value="{{ $landingMaps->nombre }}"
                                required>
                            @error('nombre')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col">
                            <label for="horario_header" class="form-label">Horario del Encabezado</label>
                            <p>Este se ubica al comienzo del inicio del sitio web, en el encabezado.</p>
                            <input type="text" id="horario_header" name="horario_header"
                                class="form-control @error('horario_header') is-invalid @enderror"
                                placeholder="Ej. Lunes a Viernes : 09:30 AM a 14:00 PM - 15:00 PM - 19:00 PM" aria-label="horario encabezado"
                                value="{{ $landingMaps->horario_header }}" required>
                            @error('horario_header')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <label for="direccion" class="form-label">Dirección</label>
                            <p>Dirección en donde se encuentra su centro veterinario</p>
                            <input type="text" id="direccion" name="direccion"
                                class="form-control @error('direccion') is-invalid @enderror"
                                placeholder="Ej. Villagran 437,Cañete,Chile." aria-label="direccion"
                                value="{{ $landingMaps->direccion }}" required>
                            @error('direccion')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <label for="correo" class="form-label">Correo</label>
                            <p>Correo que utilizen como empresa para que clientes puedan estar en contacto</p>
                            <div class="input-group">
                                <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                    id="correo" name="correo" placeholder="veterinariatest@gmail.com"
                                    value="{{ $landingMaps->correo }}">
                            </div>
                            @error('correo')
                                <div class="text-danger"><span><small>{{ 'Correo Invalido' }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <p>Teléfono de contacto para que los clientes pueda contactarlos</p>
                            <div class="input-group">
                                <div class="input-group-text">+56</div>
                                <input type="number" class="form-control @error('telefono') is-invalid @enderror"
                                    id="telefono" name="telefono" placeholder="954231232" maxlength="9" minlength="9"
                                    value="{{ $landingMaps->telefono }}">
                            </div>
                            @error('telefono')
                                <div class="text-danger"><span><small>{{ 'Numero invalido' }}</small></span></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col">
                            <label for="wsp" class="form-label">WhatsApp</label>
                            <p>Link de acceso al chat su WhatsApp</p>
                            <input type="text" class="form-control @error('wsp') is-invalid @enderror" id="whatsapp"
                                name="whatsapp" placeholder="Link para Chat de WhatsApp"
                                value="{{ $landingMaps->whatsapp }}" required>

                            @error('wsp')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col">
                            <label for="facebook" class="form-label">Facebook</label>
                            <p>Link de acceso a su página de Facebook</p>
                            <input type="text" class="form-control @error('facebook') is-invalid @enderror"
                                id="facebook" name="facebook" placeholder="Link para Pagina de Facebook"
                                value="{{ $landingMaps->facebook }}" required>

                            @error('facebook')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col">
                            <label for="instagram" class="form-label">Instagram</label>
                            <p>Link de acceso a su página de Instragram</p>
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                id="instagram" name="instagram" placeholder="Link para perfil de Instragram"
                                value="{{ $landingMaps->instagram }}" required>

                            @error('instagram')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <label for="twitter" class="form-label">Twitter</label>
                            <p>Link de acceso a su página de Twitter</p>
                            <input type="text" class="form-control @error('twitter') is-invalid @enderror"
                                id="twitter" name="twitter" placeholder="Link para perfil de Instragram"
                                value="{{ $landingMaps->twitter }}" required>

                            @error('twitter')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-center mt-4">
                        <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Modificar"
                            style="background-color:#19A448; border-color:#19A448;">
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
