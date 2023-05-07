@extends('layouts.panel_usuario')
<title>{{ Auth::user()->name }} Perfil - Veterinaria Gumiel</title>
@section('css-after')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .imageProfile {
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
@section('header-title')
    Perfil de {{ auth()->user()->name }}
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Perfil de Usuario</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}
    <div class="container-sm mt-5">
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <a href="#">
                            @if (isset(Auth::user()->image))
                                <img src="{{ asset('storage') . '/' . Auth::user()->image }}" alt=""
                                    class="imageProfile">
                            @else
                                <img src="{{ asset('image/default-user-image.png') }}" alt="" class="imageProfile">
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            </div>
            <div class="card-body pt-0 pt-md-4">
                <div class="text-center mt-5">
                    <h3>
                        {{Auth::user()->name}}
                    </h3>
                    <div class="h5 font-weight-300">
                        <i class="ni location_pin mr-2"></i>@for ($i =0; $i<sizeof(Auth::user()->getRoleNames());$i++)
                            @if (Auth::user()->getRoleNames()[$i]==sizeof(Auth::user()->getRoleNames())-1)
                                 {{Auth::user()->getRoleNames()[$i]}}
                            @else
                                {{Auth::user()->getRoleNames()[$i] ,}}
                            @endif
                        @endfor
                    </div>
                    <div class="h3 mt-4">
                        <i class="ni business_briefcase-24 mr-2"></i>Rut: @if (isset(Auth::user()->rut))
                        {{Auth::user()->rut}}
                        @else
                            No definido
                        @endif
                    </div>
                    <hr>
                    <div class="h3 mt-2">
                        <i class="ni business_briefcase-24 mr-2"></i>Telefono: @if (isset(Auth::user()->phone))
                            {{Auth::user()->phone}}
                        @else
                            No definido
                        @endif
                    </div>
                    <hr>
                    <div class="h3 mt-2">
                        <i class="ni business_briefcase-24 mr-2"></i>Correo: @if (isset(Auth::user()->email))
                            {{Auth::user()->email}}
                        @else
                            No definido
                        @endif
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center mt-4">
                        <a name="editProfile" id="editProfile" class="btn btn-primary btn-lg" href="{{route('user.profile.modify')}}" role="button" style="background-color:#19A448; border-color:#19A448;">Editar Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-after')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif
@endsection
