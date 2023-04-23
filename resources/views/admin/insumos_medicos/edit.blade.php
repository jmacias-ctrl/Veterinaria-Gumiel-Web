@extends('layouts.layouts_users')
<title>Modificar Insumo Medico</title>
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
    <div class="container-sm">
        <h2>Modificar Insumos Médico</h2>
        <hr>
            <form action="{{route('admin.insumos_medicos.update')}}" method="POST">
                @csrf
                <div class="row mt-3">
                    <div class="col">
                    <input type="hidden" name="id" value="{{$insumos_medicos->id}}">
                    <label for="nombre"class="form-label">Nombre Insumo Médico</label>
                    <input type="text" class="form-control" name="nombre" value="{{$insumos_medicos->nombre}}" id="nombre" checked>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                    <label for="nombre" class="form-label">Marca</label>
                    <input type="text" class="form-control" name="marca" value="{{$insumos_medicos->marca}}" id="marca" checked>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <label for="id_tipo" class="form-label">Tipo insumo</label>
                    <select class="form-select" name="id_tipo" for="id_tipo">
                    <option  selected disabled>Seleciona una opción</option>
                        @foreach ( as )
                           <option type="unsignedBigInteger" id="id_tipo" name= "id_tipo" value="{{$insumos_medicos->id_tipo}}">{{$insumos_medicos->tipoinsumos->nombre}}</option> 
                        @endforeach
                        
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="col">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="int" class="form-control" name="stock" value="{{$insumos_medicos->stock}}" id="stock" checked>
                    </div>
                </div>
                    <div class="container">
                        <br>
                        <div class="row row-cols-auto">
                            <div class="col">
                                <input name="" id="" class="btn btn-primary" style="background-color:#19A448; border-color:#19A448;" type="submit" value="Modificar">
                            </div>
                            <div class="col">
                                <a class="btn btn-primary ms-5" href="{{ route('admin.insumos_medicos.index') }}" style="background-color:#6A6767; border-color:#6A6767;" role="button">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>

@endsection

