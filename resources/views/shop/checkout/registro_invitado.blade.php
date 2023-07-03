@extends('layouts.appshop')
@section('title')
    LOGIN SHOP | Veterinaria Gumiel
@endsection
@section('content')
    <div class="container">
        <div class="row" style="height:100%; justify-content:center; align-items: center;">
            <div class="col-lg-6 p-0 m-0">
                <div class="card p-5 shadow">
                    <form id="forminvitado" method="POST" action="{{ route('register_invitado') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-1">
                                <div class="input-group-prepend">
                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i
                                            class="ni ni-single-02"></i></span>
                                </div>
                                <input id="nombre" type="text"
                                    class="pl-2 form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Juan Perez">
                            </div>
                            @error('nombre')
                                <span class="text-warning" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-1">
                                <div class="input-group-prepend">
                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i
                                            class="ni ni-badge"></i></span>
                                </div>
                                <input type="text" class="pl-2 form-control @error('rut') is-invalid @enderror"
                                    id="rut" name="rut" placeholder="Ej. 12345678-9" maxlength="10" oninput="checkRut(this)" value="{{ old('rut') }}">
                            </div>
                            @error('rut')
                                <span class="text-warning" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                            <span class="text-warning"><small id="id_rut"></small></span>

                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-1">
                                <div class="input-group-prepend w-100">
                                    <div style="width:60px; justify-content: center;" class="input-group-text">+56</div>
                                    <input type="text" class="pl-2 form-control @error('telefono') is-invalid @enderror"
                                        id="telefono" name="telefono" minlength="9" maxlength="9" placeholder="954231232"
                                        value="{{ old('telefono') }}">
                                </div>
                            </div>

                            @error('telefono')
                                <span class="text-warning" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-1">
                                <div class="input-group-prepend">
                                    <span style="width:50px; justify-content: center;" class="input-group-text"><i
                                            class="ni ni-email-83"></i></span>
                                </div>
                                <input id="email_register" type="text" placeholder="juan.perez@gmail.com"
                                    class="pl-2 form-control @error('email_register') is-invalid @enderror"
                                    name="email_register" value="{{ old('email_register') }}" autocomplete="email_register">
                            </div>
                            @error('email_register')
                                <span class="text-warning" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        {{ session()->get('$message') }}
                        <div class="text-center">
                            <button type="submit" id="btn-submit" class=" btn-block btn btn-success mt-4"
                                style="background-color:#19A448; border-color:#19A448">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- FIN formulario de ingreso de invitados -->
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
        $(document).ready(function() {
            $('#btn-submit').on('click', function(e) {
                var rut = document.getElementById('rut').value;
                e.preventDefault();
                if (!Fn.validaRut(rut)) {
                    document.getElementById("id_rut").innerHTML =
                        "Rut invalido, ingrese Rut nuevamente. 11111111-1";
                    return;
                } else {
                    var form = $(this).parents(form);
                    form.submit();

                }

            });
        })
    </script>
@endsection
