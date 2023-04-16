@extends('layouts.app')

@section('content')
    <div class="container-sm">
        <h2>Ingresar Nuevo Insumo Medico</h2>
        <hr>
        <form action="{{ route('admin.tipoinsumos.store') }}" method="POST">
            @csrf
            <div class="container">
                <h5 class="mt-4">Informacion del Insumo</h5>
                <div class="row mt-3">
                    <div class="col">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input minlength="4" type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Algodon"
                            aria-label="Nombre" required>
                    </div>
                <br>
                <div class="row">
                    <div class="col">
                        <br>
                        <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Rol">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection