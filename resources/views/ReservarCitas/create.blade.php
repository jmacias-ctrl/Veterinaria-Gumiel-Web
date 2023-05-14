<?php
    use Illuminate\Support\Str;
?>
@extends('layouts.app')
<title>Agendar Horas</title>

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow p-5">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Agendar Hora</h3>
                    </div>
                    <div class="col text-right">
                        <a href="" class="btn btn-sm btn-success">
                            <i class="fas fa-chevron-left"></i>Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Por Favor!!</strong> {{ $error}}
                        </div>
                    @endforeach
                @endif

                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tiposervicio">Tipo servicio</label>
                        <select name=tiposervicio_id" id="tiposervicio" class="form-select" >
                            <option selected disabled>Seleccionar tipo de servicio</option>
                            @foreach ( $servicios as $servicio)
                                <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user">Funcionario</label>
                        <select name="user_id" id="user" class="form-select">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Seleccionar fecha" type="text" value="{{date('Y-m-d')}}" data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d')}}" 
                            data-date-end-date="+30d">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Hora de atención</label>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Tipo de servicio</label>
                        
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Guardar<</button>
                </form>
            </div>
        </div>
    </div>
</div>        
@endsection

@section('scripts')

<script src="{{asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $(function(){
        const $servicio = $('#servicio')    
        $servicio.change(()=>{
            const url = ``
        });
    });
</script>

@endsection