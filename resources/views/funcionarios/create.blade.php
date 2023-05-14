@extends('layouts.panel_usuario')
<title>Ingresar Funcionario - Veterinaria Gumiel</title>
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
    <a href="{{ route('funcionarios.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Crear Tipo de Servicio
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('funcionarios.index')}}" style="color:black;">Funcionarios</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Crear Funcionarios</li>
    </nav>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo Funcionario</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor!</strong>{{ $error }}
                    </div>
                @endforeach
            @endif

            <form action="{{ url('/funcionarios') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="tiposervicios">Tipo Servicios</label>
                    <select name="tiposervicios[]" id="tiposervicios" class="form-control" title="Seleccionar Tipo servicio" required>
                        @foreach ($tiposervicios as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rut">Rut</label>
                    <input type="text" name="rut" class="form-control" value="{{ old('rut') }}">
                </div>
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <div class="input-group">
                        <div class="input-group-text">+56</div>
                        <input type="number" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>
                
                <h5 class='my-4'>La contraseña sera por defecto el rut sin el digito verificador</h5>

                <h5 class="mt-4">Roles</h5>
                    @foreach ($roles as $rol)
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" value="{{ $rol->name }}" @if (old('roles') == $rol->name) checked @endif>
                            <label class="form-check-label" for="inlineRadio">{{ $rol->name }}</label>
                        </div>  
                    </div>
                    @endforeach
                <br>
                <button type="submit" class="btn btn-sm btn-primary" style="background-color:#19A448; border-color:#19A448;">Crear funcionario</button>
            </form>
        </div>
    </div>
@endsection

