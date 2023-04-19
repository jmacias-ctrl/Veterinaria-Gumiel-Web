@extends('layout.layout')
@section("body")

<div class="d-flex justify-content-end">
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsert">
    Añadir Producto
</button>
</div>
<div class="table-responsive mt-2">
    <table class="table" id="tb-productos">
      <thead>
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Descripcion</th>
            <th>Tipo</th>
            <th>Stock</th>
            <th>Producto enfocado</th>
            <th>Precio</th>
        </tr>
      </thead>
@foreach ($productos as $producto )
<tr>
    <td>{{$producto->nombre}}</td>
    <td>{{$producto->marca}}</td>
    <td>{{$producto->descripcion}}</td>
    <td>{{$producto->tipo}}</td>
    <td>{{$producto->stock}}</td>
    <td>{{$producto->producto_enfocado}}</td>
    <td>{{$producto->precio}}</td>
    <td class="d-flex justify-content-evenly">
        <form method="POST" action="{{ url("productos/{$producto->id}") }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mx-1">Eliminar</button>
      </form>
      <button type="button" class="btn btn-sm btn-success btn-update mx-1" data-object='@json($producto)' data-toggle="modal" data-target="#modalUpdate">
        Actualizar
    </button>
    </td>
</tr>

@endforeach
    </table>
  </div>
<div class="modal" id="modalInsert">
    <form action="{{ route('productos.post') }}" method="post" enctype="multipart/form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                <label for="nombre">nombre producto:</label>
                <input type="text" class="form-control" placeholder="" id="nombre" name="nombre">
                <label for="marca">marca</label>
                <textarea type="text" class="form-control"  id="marca" name="marca"></textarea>
                <label for="precio">descripccion producto:</label>
                <input type="number" class="form-control" placeholder=""  id="descripcion" name="descripcion">
                <label for="descripccion">tipo:</label>
                <input type="text" class="form-control" placeholder="" id="tipo" name="tipo"/>
                <label for="cantidad">Stock:</label>
                <input type="number" class="form-control" placeholder=""  id="stock" name="stock">
                <label for="cantidad">producto enfocado:</label>
                <input type="number" class="form-control" placeholder="15"  id="producto_enfocado" name="producto_enfocado">
                <label for="cantidad">Precio:</label>
                <input type="number" class="form-control" placeholder="15"  id="precio" name="precio">
                <input type="file" class="form-control" id="formFile" name="image">
                <label class="input-group-text" for="inputGroupFile02">JPG</label>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
        @csrf
    </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modalUpdate">
    <form action="{{ route('productos.put') }}" method="post" id="form-update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Actualizar producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <label for="nombre">nombre producto:</label>
                <input type="text" class="form-control" placeholder="Coca Cola" id="nombre" name="nombre">
                <label for="marca">marca</label>
                <textarea type="text" class="form-control"  id="marca" name="marca"></textarea>
                <label for="precio">descripccion producto:</label>
                <input type="number" class="form-control" placeholder="15"  id="descripcion" name="descripcion">
                <label for="descripccion">tipo:</label>
                <input type="text" class="form-control" placeholder="" id="tipo" name="tipo"/>
                <label for="cantidad">Stock:</label>
                <input type="number" class="form-control" placeholder="15"  id="stock" name="stock">
                <label for="cantidad">producto enfocado:</label>
                <input type="number" class="form-control" placeholder="15"  id="producto_enfocado" name="producto_enfocado">
                <label for="cantidad">Precio:</label>
                <input type="number" class="form-control" placeholder="15"  id="precio" name="precio">


            </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
        @csrf
        @method('PUT')
    </form>
      </div>
    </div>
  </div>

  @endsection
@section('Scripts')
<script src="{{asset('Scripts/Productos/producto-1.0.js')}}"></script>
@endsection