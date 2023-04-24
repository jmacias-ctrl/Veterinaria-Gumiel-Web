@extends('layouts.layouts_users')
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection




@section('content')
    <div class="container">
        <h3>Horarios funcionarios</h3>
        <div class="col">
            <a href="{{route('admin.horario.add')}}" class="btn btn-primary btn-lg" tabindex="-1" style="background-color:#19A448; border-color:#19A448;"  role="button" aria-disabled="false">Agregar Horario</a>
        </div>
        <br>
        
        <div id="horarios">
        </div>      
    </div> 
@endsection
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Datos del horario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="" method="POST">
            @csrf
            <div id="">
                <h5 class="mt-4">Informacion Funcionarios</h5>
                <div class="row mt-3">
                <div class="col">
                    <input type="hidden" id="id" name="id" required>
                </div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <label for="title" class="title">Selecciona Funcionario</label>
                    <select class="form-select" name="title" for="title">
                    <option  selected disabled>Seleciona un funcionario</option>
                    @foreach ($users as $user)
                        <option type="text" id="title" name= "title" value="{{$user->name}}">{{$user->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <label for="id_usuario" class="form-label">Selecciona Funcionario</label>
                    <select class="form-select" name="id_usuario" for="title">
                    <option  selected disabled>Seleciona un funcionario</option>
                    @foreach ($users as $user)
                        <option type="unsignedBigInteger" id="id_usuario" name= "id_usuario" value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="start" class="form-label">Inicio turno: </label>
                        <input type="dateTime-local" id="start"
                            name="start" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="end" class="form-label">Termino turno: </label>
                        <input type="dateTime-local" id="end"
                            name="end" required>
                    </div>
                </div>
                <br>
            </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnModificar">Modificar</button>
            <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

