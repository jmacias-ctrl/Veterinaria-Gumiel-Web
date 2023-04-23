@extends('layouts.layouts_users')
<title>{{Auth::user()->name}} Perfil - Veterinaria Gumiel</title>
@section('css-after')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .imageProfile{
            width: 150px;
        }
        .circle {
        border-radius: 100%;
        height: 200px;
        width: 200px;
        object-fit: cover;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        }
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="breadcrumb mb-1 mx-2 opacity-50">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="text-decoration:none;">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
        </nav>
    </div>
    <hr>
    <h3 class="mb-4">Perfil de Usuario</h3>
    <div class="container-sm border border-rounded shadow p-5" style="background:white;">
        <div class="d-flex justify-content-center">
            @if(isset(Auth::user()->image))
                <img src="{{ asset('storage').'/'.Auth::user()->image}}" alt="" class="imageProfile">
                
            @else
                <img src="{{ asset('image/default-user-image.png') }}" alt="" class="imageProfile">
            @endif
        </div>
        <div class="d-flex justify-content-center mt-4">
            <h3>{{Auth::user()->name}}</h3>
        </div>
        <div>
            <div class="w-100">
                <ul class="list-group">
                    <li class="list-group-item"> <p class="fs-5">Rut: {{Auth::user()->rut}}</p> </li>
                    <li class="list-group-item"> <p class="fs-5">Telefono: {{Auth::user()->phone}}</p> </li>
                    <li class="list-group-item"> <p class="fs-5">Correo: {{Auth::user()->email}}</p> </li>
                    <li class="list-group-item"> <p class="fs-5">Roles: 
                    @for ($i =0; $i<sizeof(Auth::user()->getRoleNames());$i++)
                        @if (Auth::user()->getRoleNames()[$i]==sizeof(Auth::user()->getRoleNames())-1)
                             {{Auth::user()->getRoleNames()[$i]}}
                        @else
                            {{Auth::user()->getRoleNames()[$i] ,}}
                        @endif
                    @endfor
                    </p> </li>
                  </ul>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a name="editProfile" id="editProfile" class="btn btn-primary btn-lg" href="{{route('user.profile.modify')}}" role="button">Editar Perfil</a>
            </div>
        </div>
    </div>
@endsection
@section('js-after')
@endsection
