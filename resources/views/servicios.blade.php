@extends('layouts.app')
@section('title')
    Inicio - Veterinaria Gumiel
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid header-bg py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="opacity: 1; background-color:black;">
        <div class="container py-5">
            <h1 class="display-4 text-white mb-3 animated slideInDown">Servicios</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0" style="background-color:black;">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{route('inicio')}}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">
                        Servicios
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <h1 class="display-5 mb-0">
                        La <span class="text-primary">Veterinaria Gumiel</span> Ofrece los siguientes servicios
                    </h1>
                </div>
            </div>
            <div class="row gy-5 gx-4">
                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid mb-3" src="{{asset('images/tienda.png')}}" alt="Icon" />
                    <h5 class="mb-3">Tienda</h5>
                    <span>Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem
                        sed diam stet diam sed stet.</span>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <img class="img-fluid mb-3" src="{{asset('images/veterinaria.png')}}" alt="Icon" />
                    <h5 class="mb-3">Veterinaria</h5>
                    <span>Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem
                        sed diam stet diam sed stet.</span>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid mb-3" src="{{asset('images/peluqueria.png')}}" alt="Icon" />
                    <h5 class="mb-3">Peluqueria</h5>
                    <span>Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem
                        sed diam stet diam sed stet.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
