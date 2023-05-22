@extends('layouts.panel_usuario')
<title>Modificar Medicamento - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('title')
    Modificar Medicamentos - Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('header-title')
    Modificacion de Medicamento {{ $medicamentos->nombre }}
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.medicamentos_vacunas.index')}}" style="color:black;">Medicamento</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Medicamento</li>
    </nav>
@endsection
@section('back-arrow')
    <a href="{{ route('admin.medicamentos_vacunas.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
            <form action="{{ route('admin.medicamentos_vacunas.update') }}" method="POST">
            @csrf
            <div class="row mt-3">
                <div class="col">
                    <input type="hidden" name="id" value="{{ $medicamentos->id }}">
                    <label for="nombre"class="form-label">Nombre Medicamento</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                        value="{{ $medicamentos->nombre }}" id="nombre" checked>
                    @error('nombre')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="nombre" class="form-label">Marca</label>
                    <select class="form-select @error('marca') is-invalid @enderror" aria-label="Default select example"
                        name="marca" id="marca">
                        @foreach ($marcasMedicamento as $marca)
                            @if ($marca->id == $medicamentos->id_marca)
                                <option selected type="unsignedBigInteger" id="id_marca" name="marca"
                                    value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @else
                                <option type="unsignedBigInteger" id="id_marca" name="marca" value="{{ $marca->id }}">
                                    {{ $marca->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('marca')
                        <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                    @enderror
                </div>

            </div>
            <div class="row mt-3">
                <div class="col">
                <label for="id_tipo" class="form-label">Tipo insumo</label>
                <select class="form-select @error('id_tipo') is-invalid @enderror" name="id_tipo" for="id_tipo">
                    <option disabled>Selecciona una opción</option>
                    @foreach ($tipomedicamentos as $tipos)
                        @if ($tipos->id == $medicamentos->id_tipo)
                            <option selected type="unsignedBigInteger" id="id_tipo" name="id_tipo"
                                value="{{ $tipos->id }}">{{ $tipos->nombre }}</option>
                        @else
                            <option type="unsignedBigInteger" id="id_tipo" name="id_tipo" value="{{ $tipos->id }}">
                                {{ $tipos->nombre }}</option>
                        @endif
                    @endforeach

                </select>
                @error('id_tipo')
                    <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                @enderror
                </div>
            </div>
                
            
            <div class="row mt-3">
                <div class="col">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="int" class="form-control  @error('stock') is-invalid @enderror" name="stock" value="{{ $medicamentos->stock }}"
                        id="stock" checked>
                        @error('stock')
                            <div class="text-danger"><span><small>{{ $message }}</small></span></div>
                        @enderror
                </div>
                
            </div>
            <div class="container">
                <br>
                <div class="row row-cols-auto">
                    <div class="col">
                        <input name="" id="btn-submit" class="btn btn-primary"
                            style="background-color:#19A448; border-color:#19A448;" type="submit" value="Modificar">
                    </div>
                </div>
            </div>
    </div>
    </form>
            </div>
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
                    title: 'Modificar Medicamento',
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
