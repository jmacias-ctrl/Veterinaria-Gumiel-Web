@extends('layouts.app')
<title>Mi Perfil - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    <div class="form-row px-5 py-2">
        @include('layouts.panel_cliente')
        <div class="col-md-9 mt-3">
            <div class="card shadow me-3">
                <div class="card-header border-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Mi Perfil</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <label for="name" class="form-label @error('name') is-invalid @enderror">Nombre y
                            Apellido</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Ej. Juan Perez" aria-label="name" value="{{ Auth::user()->name }}" required>
                            @error('name')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <label for="email" class="form-label @error('email') is-invalid @enderror">Correo</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Ej. test@gmail.com" id="email"
                                name="email" value="{{ Auth::user()->email }}" required>
                            @error('email')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>

                        <label for="rut" class="form-label">Rut</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('rut') is-invalid @enderror" placeholder="Ej. 11111111-1" id="rut"
                                name="rut" value="{{ Auth::user()->rut }}" maxlength="10" oninput="checkRut(this)" required>
                            @error('rut')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>

                        <label for="telefono" class="form-label">Telefono</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+56</span>
                            <input type="number" class="form-control @error('telefono') is-invalid @enderror" placeholder="Ej. 986919671" id="telefono"
                                name="telefono" value="{{ Auth::user()->phone }}" maxlength="9" minlength="9" required>
                            @error('telefono')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <hr>
                        <h4 class="my-3">Cambiar Contraseña</h4>
                        <label for="passActual" class="form-label">Contraseña Actual</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                id="passActual" placeholder="Introduzca su contraseña actual" name="old_password">
                            @error('old_password')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <label for="passNueva" class="form-label">Nueva Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" placeholder="Introduzca su nueva contraseña"
                                class="form-control @error('new_password') is-invalid @enderror" id="passNueva"
                                name="new_password">
                            @error('new_password')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <label for="passwordConfirmation" class="form-label">Confirmación Nueva Contraseña</label>
                        <div class="input-group mb-3">

                            <input type="password" class="form-control @error('passNueva') is-invalid @enderror"
                                id="passwordConfirmation" placeholder="Introduzca nuevamente su nueva contraseña"
                                name="new_password_confirmation">
                            @error('passNueva')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center mt-4">
                            <input class="btn btn-primary mb-5" id="btn-submit" type="submit" value="Modificar datos"
                                style="background-color:#19A448; border-color:#19A448;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkRut(rut) {
            var valor = rut.value.replace('.', '');
            valor = valor.replace('-', '');

            cuerpo = valor.slice(0, -1);
            dv = valor.slice(-1).toUpperCase();

            rut.value = cuerpo + '-' + dv

            if (cuerpo.length < 7) {
                rut.setCustomValidity("RUT Incompleto");
                return false;
            }

            suma = 0;
            multiplo = 2;

            for (i = 1; i <= cuerpo.length; i++) {

                index = multiplo * valor.charAt(cuerpo.length - i);

                suma = suma + index;

                if (multiplo < 7) {
                    multiplo = multiplo + 1;
                } else {
                    multiplo = 2;
                }

            }

            dvEsperado = 11 - (suma % 11);

            dv = (dv == 'K') ? 10 : dv;
            dv = (dv == 0) ? 11 : dv;

            if (dvEsperado != dv) {
                rut.setCustomValidity("RUT Inválido");
                return false;
            }

            rut.setCustomValidity('');
        }
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
                        'Rut ingresado no sigue el formato xxxxxxxx-x',
                        'error'
                    )
                    return;
                } else {
                    var form = $(this).parents(form);
                    Swal.fire({
                        title: 'Modificar tu Perfil de Usuario',
                        text: "¿Estás seguro de que todos los datos están correctos?",
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
