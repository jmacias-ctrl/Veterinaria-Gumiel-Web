@extends('layouts.layouts_users')
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
@section('content')
    <div class="d-inline-flex">

        <a href="{{ route('user.profile.index') }}"> <span class="material-symbols-outlined" style="font-size:40px;">
                arrow_back
            </span> </a>
        <h2 class="mx-5">Modificar Perfil de Usuario</h2>
    </div>

    <hr>
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        <div id="RoleWindow">
            <div class="d-flex justify-content-center">
                <h4 class="mt-4">Imagen de Perfil</h4>
            </div>
            <div class="d-flex justify-content-center">
                @if (isset(Auth::user()->image))
                    <img src="{{ asset('storage') . '/' . Auth::user()->image }}" alt="" class="imageProfile">
                @else
                    <img src="{{ asset('image/default-user-image.png') }}" alt="" class="imageProfile">
                @endif

            </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="mb-3">
                    <input type="file" class="form-control" aria-label="file example" name="image">
                    @error('image')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <h4 class="mt-4">Informacion Personal</h4>
            <hr>
            <div class="row mt-3">
                <div class="col">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" id="name" name="name"
                        class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Pedro" aria-label="name"
                        value="{{ Auth::user()->name }}" required>
                    @error('name')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="rut" class="form-label">Rut</label>
                    <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut"
                        name="rut" placeholder="Ej. 12345678-9" value="{{ Auth::user()->rut }}" required>
                    @error('rut')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Ej. email@gmail.com" value="{{ Auth::user()->email }}" required>
                    @error('email')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="telefono" class="form-label">Telefono</label>
                    <div class="input-group">
                        <div class="input-group-text">+56</div>
                        <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                            name="telefono" placeholder="954231232" maxlength="9" minlength="9"
                            value="{{ Auth::user()->phone }}">
                    </div>
                    @error('telefono')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <hr>
            <h4>Cambiar Contraseña</h4>
            <div class="row mt-3">
                <div class="col">
                    <label for="passActual" class="form-label">Contraseña Actual</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="passActual"
                        name="old_password">
                    @error('old_password')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="passNueva" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="passNueva"
                        name="new_password">
                    @error('new_password')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="passwordConfirmation" class="form-label">Confirmacion Nueva Contraseña</label>
                    <input type="password" class="form-control @error('passNueva') is-invalid @enderror" id="passwordConfirmation"
                        name="new_password_confirmation">
                    @error('passNueva')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <hr>
            <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Modificar datos">
        </div>
    </form>
@endsection

@section('js-after')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#btn-submit').on('click', function(e) {
                e.preventDefault();
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
            });
        })
    </script>
@endsection
