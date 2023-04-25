@extends('layouts.layouts_users')
<title>Modificar  Producto</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        #tipoWindow {
            border: 1px solid;
            padding: 15px;
            border-radius: 25px;
        }
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container-sm">
        <h2>Modificar  Producto</h2>
        <hr>
        <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    
    <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}">
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" value="{{ $producto->marca }}">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="Perro" {{ $producto->tipo == 'perro' ? 'selected' : '' }}>perro</option>
                <option value="Gato" {{ $producto->tipo == 'gato' ? 'selected' : '' }}>gato</option>
                <option value="Ambos" {{ $producto->tipo == 'ambos' ? 'selected' : '' }}>Ambos</option>
                
            </select>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $producto->stock }}">
        </div>

        <div class="form-group">
            <label for="producto_enfocado">Producto enfocado</label>
            <input type="text" name="producto_enfocado" id="producto_enfocado" class="form-control" value="{{ $producto->producto_enfocado }}">
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ $producto->precio}}">
    </div>
    <div class="form-group">
    <label for="imagen">Imagen</label>
    @if ($producto->imagen_path)
    <img src="{{ asset('imagen/' . $producto->imagen_path) }}" alt="{{ $producto->imagen_path }}" width="500">

    @else
        <p>No hay imagen para este producto</p>
    @endif
    <input type="file" name="imagen" id="imagen" class="form-control-file">
</div>

    

    <!-- Resto de los campos del formulario -->

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

        </div>
    </div>
@endsection