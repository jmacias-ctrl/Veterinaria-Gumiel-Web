@extends('layouts.panel_usuario')
<title>Agregar Producto - Veterinaria Gumiel</title>
@section('css-before')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
<a href="{{ route('productos.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
        arrow_back
    </span> </a>
@endsection
@section('header-title')
Agregar Producto
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
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('productos.index') }}" style="color:black;">Productos</a> </li>
        <li class="breadcrumb-item active" aria-current="page" style="color:white;">Agregar Producto</li>
</nav>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow p-4">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" id="codigo" name="codigo" class="form-control @error('codigo') is-invalid @enderror" placeholder="Ej. 84372721" aria-label="codigo" value="{{ old('codigo') }}" required>

                    @error('codigo')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Colonia para Perritas Aroma Berries 160 ml." required>
                    @error('nombre')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nombre">Slug:</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Ej. correa-perros-pequeño" required>
                    @error('slug')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <select class="form-select @error('marca') is-invalid @enderror" aria-label="Default select example" id="marca" name="marca" required>
                        <option @if (old('marca')) selected @endif disabled>Seleccione una Marca</option>
                        @foreach ($MarcaProductos as $MarcaProducto)
                        <option value="{{ $MarcaProducto->id }}" @if (old('marca')==$MarcaProducto->id) selected @endif>
                            {{ $MarcaProducto->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('marca')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Describa el producto en detalle o en resumen" required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select class="form-select @error('tipo') is-invalid @enderror" aria-label="Default select example" id="tipo" name="tipo" required>
                        <option @if (old('tipo')) selected @endif disabled>Seleccione un tipo</option>
                        @foreach ($TipoProductos as $item)
                        <option value="{{ $item->id }}" @if (old('tipo')==$item->id) selected @endif>
                            {{ $item->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('tipo')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" min="0" oninput="this.value = Math.abs(this.value)" value="{{ old('stock') }}" placeholder="Ej. 5 un" required>
                    @error('stock')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Minimo Stock:</label>
                    <input type="number" class="form-control @error('min_stock') is-invalid @enderror" id="min_stock" name="min_stock" min="0" oninput="this.value = Math.abs(this.value)" value="{{ old('min_stock') }}" placeholder="Ej. 2 un" required>
                    @error('min_stock')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="producto_enfocado">Producto enfocado:</label>
                    <select class="form-select @error('producto_enfocado') is-invalid @enderror" aria-label="Default select example" id="producto_enfocado" name="producto_enfocado" required>
                        <option @if (old('producto_enfocado')) selected @endif disabled>Seleccione una Marca
                        </option>
                        @foreach ($especies as $especie)
                        <option value="{{ $especie->id }}" @if (old('producto_enfocado')==$especie->id) selected @endif>
                            {{ $especie->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('producto_enfocado')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Subcategoria">Subcategoria:</label>
                    <div class="row justify-content-center align-items-center g-2">
                        @foreach ($subcategorias as $sub)
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{ $sub->id }}" name="subcategoria{{ $sub->id }}">
                                    <label class="form-check-label" for="">
                                        @foreach ($categorias as $cat)
                                            @if ($cat->id==$sub->id_categoria)
                                                {{$cat->nombre}}:{{ $sub->nombre }}
                                            @endif
                                        @endforeach                                        
                                        
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>

                    <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}" placeholder="Ej. 3200" min="1" oninput="this.value = Math.abs(this.value)" required>
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
                <button type="submit" id="btn-submit" class="btn btn-primary" style="background-color:#19A448; border-color:#19A448;">Agregar</button>
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
                title: 'Agregar Nuevo producto',
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