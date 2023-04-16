@extends('layouts.app')
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container">
        <h3>Ingresar insumos medicos</h3>
        <div class="row">
            <form action="{{route('admin.insumos_medicos.store')}}" method="POST">
                @csrf
                <h5>Ingresar informacion</h5>
                <br>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej. Lorenzo" maxlength="255" minlength="8" required>
                </div>
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <select class="form-select" aria-label="Default select example" name="marca">
                        <option selected disabled>Elige una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <h5>Tipo insumo medico</h5>
                    <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Tipoinsumos[]" value="{{ $tipo->nombre }}">
                                    <label class="form-check-label" for="">
                                        {{ $tipo->nombre }}
                                    </label>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stock">Stock</label>
                    <input type="integer" name="stock" id="stock">
                </div>
                <br>

                <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Insumo">
                <br>
            </form>
        </div>
    </div>
@endsection