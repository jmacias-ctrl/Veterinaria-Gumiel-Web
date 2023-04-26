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
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="d-inline-flex">

        <a href="{{ route('admin.usuarios.index') }}"> <span class="material-symbols-outlined" style="font-size:40px;">
                arrow_back
            </span> </a>
        <h2 class="mx-5">Ingresar Nuevo Usuario</h2>
    </div>

    <hr>
    <form action="{{ route('admin.usuarios.store') }}" method="POST">
        @csrf
        <div id="RoleWindow">
            <h5 class="mt-4">Informacion Personal</h5>
            <div class="row mt-3">
                <div class="col">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Pedro"
                        aria-label="Nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="col">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido"
                        class="form-control @error('apellido') is-invalid @enderror" placeholder="Ej. Ignacio"
                        aria-label="Apellido" value="{{ old('apellido') }}" required>
                    @error('apellido')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="rut" class="form-label">Rut</label>
                    <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut"
                        name="rut" placeholder="Ej. 12345678-9" value="{{ old('rut') }}" required>
                    @error('rut')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Ej. email@gmail.com" value="{{ old('email') }}" required>
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
                            value="{{ old('telefono') }}">
                    </div>
                    @error('telefono')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <h6 class='my-4'>La contraseña sera por defecto el rut sin el digito verificador.</h6>
            <hr class="mt-4">
            <h5 class="mt-4">Roles</h5>
            <div class="row justify-content-center align-items-center g-2">
                @error('roles[]')
                    <div class="text-danger"><span><small>{{ _('Debes seleccionar al menos un rol') }}</small></span></div>
                @enderror

                @foreach ($roles as $rol)
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[{{ $rol->id }}]"
                                value="{{ $rol->name }}" @if (old('roles[' . $rol->id . ']') == $rol->name) checked @endif>
                            <label class="form-check-label" for="">
                                {{ $rol->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>

            <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Usuario">
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
                    title: 'Agregar Nuevo usuario',
                    text: "¿Estás seguro de que todos los datos estan correctos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, agregar',
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