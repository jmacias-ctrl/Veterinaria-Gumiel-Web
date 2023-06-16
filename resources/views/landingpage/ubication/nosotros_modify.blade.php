@extends('layouts.panel_usuario')
<title>Modificación Seccion Nosotros - Veterinaria Gumiel</title>
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
    Modificación Seccion Nosotros
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Seccion Nosotros</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('landing.nosotros.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('landingpage.ubication.botones')

                    <h2 class="mt-4">Información</h2>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="title1" class="form-label">Titulo 1</label>
                            <input type="text" id="title1" name="title1"
                                class="form-control @error('title1') is-invalid @enderror" placeholder="¿Quiénes Somos?"
                                aria-label="title1" value="{{ $aboutUs->title1 }}" required>
                            @error('title1')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="paragraph1" class="form-label">Parrafo 1</label>
                            <textarea class="form-control @error('paragraph1') is-invalid @enderror" id="paragraph1" name="paragraph1"
                                rows="4">{{ $aboutUs->paragraph1 }}</textarea>
                            @error('paragraph1')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="title2" class="form-label">Titulo 2</label>
                            <input type="text" id="title2" name="title2"
                                class="form-control @error('title2') is-invalid @enderror"
                                placeholder="¿Qué estamos haciendo?" aria-label="title2" value="{{ $aboutUs->title2 }}"
                                required>
                            @error('title2')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="paragraph2" class="form-label">Parrafo 2</label>
                            <textarea class="form-control @error('paragraph2') is-invalid @enderror" id="paragraph2" name="paragraph2"
                                rows="4">{{ $aboutUs->paragraph2 }}</textarea>
                            @error('paragraph2')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="title3" class="form-label">Titulo 3</label>
                            <input type="text" id="title3" name="title3"
                                class="form-control @error('title3') is-invalid @enderror"
                                placeholder="¿Hacia dónde apuntamos?" aria-label="title3" value="{{ $aboutUs->title2 }}"
                                required>
                            @error('title3')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="paragraph3" class="form-label">Parrafo 3</label>
                            <textarea class="form-control @error('paragraph3') is-invalid @enderror" id="paragraph3" name="paragraph3"
                                rows="4">{{ $aboutUs->paragraph3 }}</textarea>
                            @error('paragraph3')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="image_1">Imagen 1</label>
                                <input id="image_1" name="image_1" type="file" class="form-control-file">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                @if (isset($aboutUs->image_1))
                                    <img class="img-thumbnail"
                                        src="{{ asset('storage') . '/images/aboutus/' . $aboutUs->image_1 }}" alt=""
                                        style="width: 150px; height:auto;" />
                                @else
                                    <img class="img-thumbnail" src="{{ asset('images/aboutus/dummytest1.png') }}"
                                        alt="" style="width: 150px; height:auto;" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="image_2">Imagen 2</label>
                                <input type="file" class="form-control-file" id="image_2" name="image_2">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                @if (isset($aboutUs->image_2))
                                    <img class="img-thumbnail"
                                        src="{{ asset('storage') . '/images/aboutus/' . $aboutUs->image_2 }}" alt=""
                                        style="width: 150px; height:auto;" />
                                @else
                                    <img class="img-thumbnail" src="{{ asset('images/aboutus/dummytest2.jpg') }}"
                                        alt="" style="width: 150px; height:auto;" />
                                @endif

                            </div>
                        </div>
                    </div>


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
