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
                    <select class="form-select" aria-label="Default select example" name="marca" id="marca">
                        @foreach ($marcasInsumos as $marca )
                            @if($marca->id == $insumos_medicos->id_marca)
                            <option selected type="unsignedBigInteger" id="id_marca" name= "marca" value="{{$marca -> id}}">{{$marca->nombre}}</option> 
                            @else
                            <option type="unsignedBigInteger" id="id_marca" name= "marca" value="{{$marca -> id}}">{{$marca->nombre}}</option> 
                            @endif
                           
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-2">
                    <label for="id_tipo" class="form-label">Tipo insumo</label>
                    <select class="form-select" name="id_tipo" for="id_tipo">
                    <option disabled>Selecciona una opción</option>
                        @foreach ($tipoinsumos as $tipos )
                            @if($tipos->id == $insumos_medicos->id_tipo)
                                <option selected type="unsignedBigInteger" id="id_tipo" name= "id_tipo" value="{{$tipos -> id}}">{{$tipos->nombre}}</option> 
                            @else
                                <option type="unsignedBigInteger" id="id_tipo" name= "id_tipo" value="{{$tipos -> id}}">{{$tipos->nombre}}</option> 
                            @endif
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
                                <input name="" id="btn-submit" class="btn btn-primary" style="background-color:#19A448; border-color:#19A448;" type="submit" value="Modificar">
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
                    title: 'Modificar Insumo Medico',
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

