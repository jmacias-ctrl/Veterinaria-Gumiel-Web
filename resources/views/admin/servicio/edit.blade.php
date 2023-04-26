@extends('layouts.layouts_users')
<title>Modificar Tipo Servicio</title>
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
        <h2>Modificar Tipos de Servico</h2>
        <hr>
            <form action="{{route('admin.servicios.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$servicios->id}}">
                <div id="tipoWindow">
                    <label for="nombre">Nombre Tipo de servcio</label>
                    <input type="text" name="nombre" value="{{$servicios->nombre}}" id="nombre" checked>

                    <input name="" id="" class="btn btn-primary" type="submit" value="Modificar">
                
            </form>
        </div>
    </div>
    div class="container-sm">
        <h2>Modificar Precios de Servico</h2>
        <hr>
            <form action="{{route('admin.servicios.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$servicios->id}}">
                <div id="tipoWindow">
                    <label for="precio">Precio de servcio</label>
                    <input type="text" name="precio" value="{{$servicios->precio}}" id="precio" checked>

                    <input name="" id="" class="btn btn-primary" type="submit" value="Modificar">
                
            </form>
        </div>
    </div>
@endsection