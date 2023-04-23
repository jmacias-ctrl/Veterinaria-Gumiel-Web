@extends('layouts.layouts_users')
@section('content')
    <div class="container">
        <h3>Horarios funcionarios</h3>
        <a href="{{route('admin.horario.add')}}" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="false">Agregar Horario</a>
        <br>
        <br>
        <div id="horarios">
            
        </div>
    </div>

    

    
   

@endsection