@extends('layouts.layouts_users')
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        #RoleWindow {
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
        <h2>Modificar Roles Usuarios</h2>
        <hr>
        <form action="{{route('admin.usuarios.update.roles')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <div id="RoleWindow">
                <h4>Usuario: {{ $user->name }}</h4>
                <h5 class="mt-4">Roles</h5>
                <div class="row justify-content-center align-items-center g-2">
                    @foreach ($user->nombre_roles as $rol)
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $rol }}" checked>
                                <label class="form-check-label" for="">
                                    {{ $rol }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($roles as $rol)
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $rol->name }}">
                                <label class="form-check-label">
                                    {{ $rol->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>

                <input name="" id="" class="btn btn-primary" type="submit" value="Modificar Roles">
            </div>
        </form>
    </div>
@endsection
