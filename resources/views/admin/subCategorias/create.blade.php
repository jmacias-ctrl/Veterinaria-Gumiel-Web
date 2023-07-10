@extends('layouts.panel_usuario')
<title>Agregar Subcategoria - Veterinaria Gumiel</title>
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
    <a href="{{ route('admin.subcategorias.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('header-title')
    Agregar Subcategoria
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.subcategorias.index') }}"
                    style="color:black;">Subcategoria</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Agregar Subcategoria</li>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{ route('admin.subcategorias.store') }}" method="POST">
                    @csrf
                    <div id="RoleWindow">
                        <h5 class="mt-4">Información de la Subcategoria:</h5>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="nombre" class="form-label">Nombre del Subcategoria *</label>
                                <input type="text" id="nombre" name="nombre"
                                    class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Cachorro"
                                    aria-label="Nombre" required>

                                @error('nombre')
                                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="Categoria">Categoria *</label>
                            <select class="form-select @error('categoria') is-invalid @enderror" aria-label="Default select example" id="categoria" name="categoria" required>
                                <option @if (old('categoria')) selected @endif disabled>Seleccione una Categoria</option>
                                @foreach ($Categorias as $Categoria)
                                <option value="{{ $Categoria->id }}" @if (old('categoria')==$Categoria->id) selected @endif>
                                    {{ $Categoria->nombre }}
                                </option>
                                @endforeach
                            </select>
                            @error('categoria')
                            <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                            @enderror
                        </div>
                        <input class="btn btn-primary" id="btn-submit"
                            style="background-color:#19A448; border-color:#19A448;" type="submit" value="Agregar">

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
                e.preventDefault();
                var form = $(this).parents(form);
                Swal.fire({
                    title: 'Agregar Nueva Subcategoria',
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
            });
        })
    </script>
@endsection
