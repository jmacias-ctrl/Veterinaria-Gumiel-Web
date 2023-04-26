@extends('layouts.layouts_users')
<title>Crear Producto - Veterinaria Gumiel</title>
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

        <a href="{{ route('productos.index') }}"> <span class="material-symbols-outlined" style="font-size:40px;">
                arrow_back
            </span> </a>
        <h2 class="mx-5">Ingresar Nuevo producto</h2>
    </div>

    <hr>
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <div class="form-group">
            <label for="marca">Marca:</label>
            <select class="form-select @error('marca') is-invalid @enderror" aria-label="Default select example" id="marca" name="marca" required>
                <option @if(old('marca')) selected @endif disabled>Seleccione una Marca</option>
                @foreach ($MarcaProductos as $MarcaProducto)
                    <option value="{{ $MarcaProducto->id }}" @if( old('marca')==$MarcaProducto->id) selected @endif>{{ $MarcaProducto->nombre }}</option>
                @endforeach
            </select>
            @error('marca')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"  required>{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select class="form-select @error('tipo') is-invalid @enderror" aria-label="Default select example" id="tipo" name="tipo" required>
                <option @if(old('tipo'))selected @endif disabled>Seleccione un tipo</option>
                <option value="alimento" @if( old('tipo')=='alimento') selected @endif>Alimento</option>
                <option value="accesorio" @if( old('tipo')=='accesorio') selected @endif>Accesorio</option>
            </select>
            @error('tipo')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}"  required>
            @error('stock')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <div class="form-group">
            <label for="producto_enfocado">Producto enfocado:</label>
            <select class="form-select @error('producto_enfocado') is-invalid @enderror" aria-label="Default select example" id="producto_enfocado" name="producto_enfocado"
                required>
                <option @if(old('producto_enfocado'))selected @endif disabled>Seleccione una opcion</option>
                <option value="gato" @if( old('producto_enfocado')=='gato') selected @endif>Gato</option>
                <option value="perro" @if( old('producto_enfocado')=='perro') selected @endif>Perro</option>
                <option value="ambos" @if( old('producto_enfocado')=='ambos') selected @endif>Ambos</option>
            </select>
            @error('producto_enfocado')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}"  required>
            @error('precio')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <div class="form-group">
            <label for="imagen_path">Imagen:</label>
            <input type="file" class="form-control @error('imagen_path') is-invalid @enderror" id="imagen_path" name="imagen_path" required>
            @error('imagen_path')
                <div class="text-danger"><span><small>{{ $message }}</small></span></div>
            @enderror
        </div>
        <hr class="my-3">
        <button type="submit" id="btn-submit" class="btn btn-primary">Agregar producto</button>
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
                    title: 'Agregar Nuevo producto',
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
