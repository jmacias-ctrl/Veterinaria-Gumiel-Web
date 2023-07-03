@extends('layouts.panel_usuario')
<title>Modificación Landing Page - Veterinaria Gumiel</title>
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
    Modificación Landing Page
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Landing Page</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                @include('landingpage.ubication.botones')
                <form action="{{ route('landing.website.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- <input type="hidden" name="id" value="{{ Auth::user()->id }}"> -->
                    
                    <h2>Informacion</h2>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="titulo_bienvenida" class="form-label">Titulo de Bienvenida</label>
                            <input type="text" id="titulo_bienvenida" name="titulo_bienvenida"
                                class="form-control @error('titulo_bienvenida') is-invalid @enderror"
                                placeholder="Servicio de Veterinaria y Peluqueria" aria-label="titulo_bienvenida"
                                value="{{ $data_index->titulo_bienvenida }}" required>
                            @error('titulo_bienvenida')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="agenda_hora_titulo" class="form-label">Agenda tu Hora Titulo</label>
                            <input type="text" id="agenda_hora_titulo" name="agenda_hora_titulo"
                                class="form-control @error('agenda_hora_titulo') is-invalid @enderror"
                                placeholder="Aqui! Agenda tu Hora!" aria-label="agenda_hora_titulo"
                                value="{{ $data_index->agenda_hora_titulo }}" required>
                            @error('agenda_hora_titulo')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="agenda_hora_texto" class="form-label">Agenda tu Hora Texto</label>
                            <textarea class="form-control @error('agenda_hora_texto') is-invalid @enderror" id="agenda_hora_texto"
                                name="agenda_hora_texto" rows="4">{{ $data_index->agenda_hora_texto }}</textarea>
                            @error('agenda_hora_texto')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2 mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="agenda_hora_imagen">Imagen de Agenda tu Hora</label>
                                <input type="file" class="form-control-file" id="agenda_hora_imagen"
                                    name="agenda_hora_imagen">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                @if (isset($data_index->agenda_hora_imagen))
                                    <img class="img-thumbnail"
                                        src="{{ asset('storage') . '/images/' . $data_index->agenda_hora_imagen }}"
                                        alt="" style="width: auto; height:150px;" />
                                @else
                                    <img class="img-thumbnail" src="{{ asset('images/vet01.png') }}"
                                        alt="" style="width: 150px; height:auto;" />
                                @endif

                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Logos</h2>
                    <div class="row justify-content-center align-items-center g-2 mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="image_2">Logo Landing Page</label>
                                <input type="file" class="form-control-file" id="logo_1" name="logo_1">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                @if (isset($data_index->logo_1))
                                    <img class="img-thumbnail"
                                        src="{{ asset('storage') . '/images/logos/' . $data_index->logo_1 }}"
                                        alt="" style="width: auto; height:150px;" />
                                @else
                                    <img class="img-thumbnail" src="{{ asset('image/logo.png') }}"
                                        alt="" style="width: 150px; height:auto;" />
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2 mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="image_2">Logo Panel de Usuario</label>
                                <input type="file" class="form-control-file" id="logo_2" name="logo_2">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                @if (isset($data_index->logo_2))
                                    <img class="img-thumbnail"
                                        src="{{ asset('storage') . '/images/logos/' . $data_index->logo_2 }}"
                                        alt="" style="width: auto; height:150px;" />
                                @else
                                    <img class="img-thumbnail" src="{{ asset('image/logo2.jpg') }}"
                                        alt="" style="width: 150px; height:auto;" />
                                @endif

                            </div>
                        </div>
                    </div>
                    @error('nombre')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                    <hr>
                    <div class="d-flex justify-content-center mt-4">
                        <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Modificar"
                            style="background-color:#19A448; border-color:#19A448;">
                    </div>
                </form>
                <h2>Galeria</h2>
                @if (sizeof($gallery_index) < 6)
                <p>Maximo de imagenes: 6</p>
                    <form action="{{ route('landing.gallery.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-1">
                            <div class="col">
                                <label for="titulo_imagen" class="form-label">Titulo de la imagen</label>
                                <input type="text" id="titulo_imagen" name="titulo_imagen"
                                    class="form-control @error('titulo_imagen') is-invalid @enderror"
                                    placeholder="Operacion a un paciente perro" aria-label="titulo_imagen" required>
                                @error('titulo_imagen')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group my-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen" name="imagen"
                                    aria-describedby="imagen" required>
                                <label class="custom-file-label" for="imagen">Escoga una imagen</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Subir Imagen"
                                style="background-color:#19A448; border-color:#19A448;">
                        </div>
                    </form>
                    <hr>
                @else
                <p>Limite de Imagenes Superado</p>
                @endif

                <div class="row">
                    @foreach ($gallery_index as $item)
                        <div class="col d-flex align-items-stretch">
                            <div class="card mb-5" style="width: 18rem;">
                                <img src="@if ($item->id <= 6) {{ asset($item->imagen) }} @else {{ asset('storage') . '/images/galeria/' . $item->imagen }} @endif"
                                    class="card-img-top shadow" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->titulo_imagen }}</h5>
                                    <a href="{{ route('landing.gallery.delete', ['id' => $item->id]) }}"
                                        class="btn btn-outline-danger">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
