@extends('layouts.app')
@section('title')
    Acerca de Nosotros - Veterinaria Gumiel
@endsection
@section('css')
    <style>
        .com-text {
            word-wrap: break-word;
        }
    </style>
@endsection
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid header-bg py-5 mb-5 wow fadeIn" data-wow-delay="0.1s"
        style="opacity: 1; background-color:black;">
        <div class="container py-5">
            <h1 class="display-4 text-white mb-3 animated slideInDown">Acerca de Nosotros</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0" style="background-color:black;">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{ route('inicio') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">
                        Acerca de Nosotros
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-5 mb-5">
                        {{ $aboutUs->title1 }}
                    </h1>
                    <p class="mb-4 com-text">
                        {{ $aboutUs->paragraph1 }}
                    </p>
                    <h1 class="display-5 mt-3 mb-4">
                        {{ $aboutUs->title2 }}
                    </h1>
                    <p class="mb-4 com-text">
                        {{ $aboutUs->paragraph2 }}
                    </p>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    @if (isset($aboutUs->image_1))
                        <img class="img-fluid" src="{{ asset('storage') . '/images/aboutus/' . $aboutUs->image_1 }}"
                            alt="" />
                    @else
                        <img class="img-fluid" src="{{ asset('images/aboutus/dummytest2.jpg') }}" alt="" />
                    @endif

                </div>
            </div>
            <div class="row g-5 mt-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    @if (isset($aboutUs->image_1))
                        <img class="img-fluid" src="{{ asset('storage') . '/images/aboutus/' . $aboutUs->image_2 }}"
                            alt="" />
                    @else
                        <img class="img-fluid" src="{{ asset('images/aboutus/dummytest1.png') }}" alt="" />
                    @endif
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">

                    <h1 class="display-5 mb-5">
                        {{ $aboutUs->title3 }}
                    </h1>
                    <p class="mb-4 com-text">
                        {{ $aboutUs->paragraph3 }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
