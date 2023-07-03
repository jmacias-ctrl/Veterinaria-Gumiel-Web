@extends('layouts.app')
@section('title')
    Inicio - Veterinaria Gumiel
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid header-bg py-5 mb-5 wow fadeIn" data-wow-delay="0.1s"
        style="opacity: 1; background-color:black;">
        <div class="container py-5">
            <h1 class="display-4 text-white mb-3 animated slideInDown">Servicios</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0" style="background-color:black;">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{ route('inicio') }}">Inicio</a>
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
                        Nuestra <span class="text-primary">veterinaria</span> ofrece los siguientes servicios
                    </h1>
                </div>
            </div>
            <div class="row gy-5 gx-4">

                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="{{route('shop.shop')}}" style="text-decoration:none;">
                        <img class="img-fluid mb-3" src="{{ asset('images/tienda.png') }}" alt="Icon" />
                        <h5 class="mb-3">Tienda</h5>
                        <span>Ofrecemos una amplia variedad de productos, como accesorios para mantener a tus mascotas
                            felices y cómodas, juguetes, correas, camas y casas para distintas especies.</span>
                    </a>
                </div>


                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="{{route('agendar-horas.create')}}" style="text-decoration:none;">
                        <img class="img-fluid mb-3" src="{{ asset('images/veterinaria.png') }}" alt="Icon" />
                        <h5 class="mb-3">Veterinaria</h5>
                        <span>Realizamos consultas medicas para diagnosticar
                            y tratar cualquier problema de salud de tus mascotas. Tambien contamos con un amplio
                            catalogo de vacunas para prevenir diversas enfermedades.</span>
                    </a>
                </div>


                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a href="{{route('agendar-horas.create')}}" style="text-decoration:none;">
                        <img class="img-fluid mb-3" src="{{ asset('images/peluqueria.png') }}" alt="Icon" />
                        <h5 class="mb-3">Peluquería</h5>
                        <span>Ofrecemos servicios de peluquería para mantener a tus mascotas limpias y bien
                            arregladas.</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
