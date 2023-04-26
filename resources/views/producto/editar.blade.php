@extends('layouts.layouts_users')
<title>Modificar Producto - Veterinaria Gumiel</title>
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
        <div class="d-inline-flex">

            <a href="{{ route('productos.index') }}"> <span class="material-symbols-outlined" style="font-size:40px;">
                    arrow_back
                </span> </a>
            <h2 class="mx-5">Modificar Producto</h2>
        </div>
        <hr>
        <form method="POST" action="{{ route('productos.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$producto->id}}">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"  value="{{ $producto->nombre }}" required>
                @error('nombre')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <select class="form-select @error('marca') is-invalid @enderror" aria-label="Default select example" id="marca" name="id_marca" required>
                    @foreach ($MarcaProductos as $MarcaProducto)
                        <option value="{{ $MarcaProducto->id }}" @if( $producto->id_marca==$MarcaProducto->id) selected @endif>{{ $MarcaProducto->nombre }}</option>
                    @endforeach
                </select>
                @error('marca')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"  required>{{ $producto->descripcion }}</textarea>
                @error('descripcion')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select class="form-select @error('tipo') is-invalid @enderror" aria-label="Default select example" id="tipo" name="tipo" required>
                    <option value="alimento" @if( $producto->tipo=='alimento') selected @endif>Alimento</option>
                    <option value="accesorio" @if( $producto->tipo=='accesorio') selected @endif>Accesorio</option>
                </select>
                @error('tipo')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"  value="{{ $producto->stock }}" required>
                @error('stock')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
            </div>
            <div class="form-group">
                <label for="producto_enfocado">Producto enfocado:</label>
                <select class="form-select @error('producto_enfocado') is-invalid @enderror" aria-label="Default select example" id="producto_enfocado" name="producto_enfocado"
                    required>
                    <option value="gato" @if( $producto->producto_enfocado=='gato') selected @endif>Gato</option>
                    <option value="perro" @if( $producto->producto_enfocado=='perro') selected @endif>Perro</option>
                    <option value="ambos" @if( $producto->producto_enfocado=='ambos') selected @endif>Ambos</option>
                </select>
                @error('producto_enfocado')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ $producto->precio }}" required>
                @error('precio')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
            </div>
            <h6>Imagen</h6>
            <div class="form-group">
                @if ($producto->imagen_path)
                    <img src="{{ asset('image/productos/' . $producto->imagen_path) }}" alt="{{ $producto->imagen_path }}"
                        width="150px">
                @else
                    <p>No hay imagen para este producto</p>
                @endif
                <input type="file" class="form-control @error('imagen_path') is-invalid @enderror" id="imagen_path" name="imagen_path" @if(!isset($producto->imagen_path)) required @endif>
            </div>



            <!-- Resto de los campos del formulario -->

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>

    </div>
    </div>
@endsection