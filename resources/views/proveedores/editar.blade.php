@extends('layouts.panel_usuario')
<title>Modificar Proveedor - Veterinaria Gumiel</title>
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
@section('back-arrow')
    <a href="{{ route('proveedores.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Modificar Proveedor
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('proveedores.index') }}"
                    style="color:black;">Proveedores</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Proveedor</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('proveedores.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $proveedor->id }}">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                            name="nombre" value="{{ $proveedor->nombre }}" placeholder="Ej. Chile Compra" required>
                        @error('nombre')
                            <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nombre">Rut:</label>
                        <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut"
                            name="rut" value="{{ $proveedor->rut }}" placeholder="Ej. 11111111-1" maxlength="10"
                            oninput="checkRut(this)" required>
                        @error('rut')
                            <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="correo"
                                name="correo" placeholder="Ej. email@gmail.com" value="{{ $proveedor->correo }}">
                            @error('correo')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <div class="input-group-text">+56</div>
                                <input type="number" class="form-control @error('telefono') is-invalid @enderror"
                                    id="telefono" name="telefono" placeholder="954231232" maxlength="9" minlength="9"
                                    value="{{ $proveedor->telefono }}">
                            </div>
                            @error('telefono')
                                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                    </div>
                    <hr class="my-3">
                    <button type="submit" id="btn-submit" class="btn btn-primary"
                        style="background-color:#19A448; border-color:#19A448;">Modificar</button>
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
                e.preventDefault();
                var form = $(this).parents(form);
                var rut = document.getElementById('rut').value;
                if (!Fn.validaRut(rut)) {
                    Swal.fire(
                        'Error',
                        'Rut ingresado es invalido',
                        'error'
                    )
                    return;
                } else {
                    Swal.fire({
                        title: 'Modificar Proveedor',
                        text: "¿Estás seguro de que todos los datos están correctos?",
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
                }
                
            });
        })
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
    </script>
@endsection
