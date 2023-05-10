@extends('layouts.panel_usuario')
<title>Horarios Funcionarios - Veterinaria Gumiel</title>
@section('css-after')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Gestion de Servicios
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Horario Funcionarios</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <form action="{{route('admin.horariofuncionarios.store')}}" method="POST">
        @csrf
        <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-sm-9">
                            <h1>Horarios</h1>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary ms-5"  style="background-color:#19A448; border-color:#19A448;" role="button"> Guardar Cambios</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive ">
                <table class="datatable display responsive nowrap table table-sm table-hover table-striped table-bordered w-100 shadow-sm" id="table">
                    <thead>
                        <tr>
                            <th scope="col">Día</th>
                            <th scope="col">Activo</th>
                            <th scope="col">Turno mañana</th>
                            <th scope="col">Turno tarde</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horarios as $key => $HorarioFuncionarios)
                            <tr>
                                <th>{{ $days[$key] }}</th>
                                <td>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="active[]" value="{{ $key }}" @if($HorarioFuncionarios->active) checked @endif>
                                        <span class="custom-toggle-slider rounded-circle" style="border:1px solid #19A448"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-control" name="morning_start[]">
                                                @for ($i=9;$i<=14;$i++)
                                                    <option value="{{$i}}:00" {{ ($i.':00' == $HorarioFuncionarios->morning_start)?"selected":null}}>{{$i}}:00</option>
                                                    <option value="{{$i}}:30" {{ ($i.':30' == $HorarioFuncionarios->morning_start)?"selected":null}}>{{$i}}:30</option>
                                                @endfor

                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="morning_end[]">
                                                @for ($i=9;$i<=14;$i++)
                                                    <option value="{{$i}}:00" {{ ($i.':00' == $HorarioFuncionarios->morning_end)?"selected":null}}>{{$i}}:00</option>
                                                    <option value="{{$i}}:30" {{ ($i.':30' == $HorarioFuncionarios->morning_end)?"selected":null}}>{{$i}}:30</option>
                                                @endfor

                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-control" name="afternoon_start[]">
                                                @for ($i=15;$i<=19;$i++)
                                                    <option value="{{$i}}:00"@if ($i.':00' == $HorarioFuncionarios->afternoon_start) selected @endif>{{$i}}:00</option>
                                                    <option value="{{$i}}:30"@if ($i.':30' == $HorarioFuncionarios->afternoon_start) selected @endif>{{$i}}:30</option>
                                                @endfor

                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="afternoon_end[]">
                                                @for ($i=15;$i<=19;$i++)
                                                    <option value="{{$i}}:00"@if ($i.':00' == $HorarioFuncionarios->afternoon_end) selected @endif>{{$i}}:00</option>
                                                    <option value="{{$i}}:30"@if ($i.':30' == $HorarioFuncionarios->afternoon_end) selected @endif>{{$i}}:30</option>
                                                @endfor

                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
                </div>
            </div>
        </div>
    </div>
    </form>
    
@endsection