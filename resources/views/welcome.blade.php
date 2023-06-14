@extends('layouts.app')
@section('title')
    Inicio - Veterinaria Gumiel
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="es">

    <body>
        <!-- Header Start -->
        <div class="container-fluid bg-dark p-0 mb-5">
            <div class="row g-0 flex-column-reverse flex-lg-row">
                <div class="col-lg-6 p-0 wow fadeIn" data-wow-delay="0.1s">
                    <div class="header-bg h-100 d-flex flex-column justify-content-center p-5">
                        <h1 class="display-4 text-light mb-5">
                            {{ $data_index->titulo_bienvenida }}
                        </h1>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('images/carrousel/01.png') }}" alt="" />
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('images/carrousel/02.png') }}" alt="" />
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('images/carrousel/03.png') }}" alt="" />
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('images/carrousel/03.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="display-5 mb-4">
                            {{ $data_index->agenda_hora_titulo }}
                        </h1>
                        <p class="mb-4">
                            {{ $data_index->agenda_hora_texto }}
                        </p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="{{ route('agendar-horas.create') }}">Agenda
                            Ahora</a>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        @if (isset($data_index->agenda_hora_imagen))
                            <img class="img-fluid"
                                src="{{ asset('storage') . '/images/' . $data_index->agenda_hora_imagen }}"
                                alt="" />
                        @else
                            <img class="img-fluid" src="{{ asset('images/vet01.png') }}" alt="" />
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Servicios Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 mb-5 align-items-end wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-lg-6">
                        <p><span class="text-primary me-2">#</span>Servicios</p>
                        <h1 class="display-5 mb-0">
                            Nuestra <span class="text-primary">Veterinaria</span>
                            Ofrece los siguientes servicios:
                        </h1>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="membership-item position-relative">
                            <img class="img-fluid" src="{{ asset('images/veterinaria.png') }}" alt=""
                                style="opacity: 0.3" />
                            <h1 class="display-1">01</h1>
                            <h4 class="text-white mb-3">Veterinaria</h4>
                            <p>Realizamos consultas medicas para diagnosticar
                                y tratar cualquier problema de salud de tus mascotas. Tambien contamos con un amplio
                                catalogo de vacunas para prevenir diversas enfermedades.</p>
                            <a class="btn btn-outline-light px-4 mt-3" href="{{ route('agendar-horas.create') }}">Reserva
                                Aqui Tu Hora</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="membership-item position-relative">
                            <img class="img-fluid" src="{{ asset('images/peluqueria.png') }}" alt=""
                                style="opacity: 0.3" />
                            <h1 class="display-1">02</h1>
                            <h4 class="text-white mb-3">Peluqueria</h4>
                            <p>Ofrecemos servicios de peluquería para mantener a tus mascotas limpias y bien arregladas.</p>
                            <a class="btn btn-outline-light px-4 mt-3" href="{{ route('agendar-horas.create') }}">Reserva
                                Aqui Tu Hora</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="membership-item position-relative">
                            <img class="img-fluid" src="{{ asset('images/tienda.png') }}" alt=""
                                style="opacity: 0.3" />
                            <h1 class="display-1">03</h1>
                            <h4 class="text-white mb-3">Tienda</h4>
                            <p>Ofrecemos una amplia variedad de productos, como accesorios para mantener a tus mascotas
                                felices y cómodas, juguetes, correas, camas y casas para distintas especies.</p>
                            <a class="btn btn-outline-light px-4 mt-3" href="{{ route('shop.shop') }}">Ingresa Aqui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Membership End -->

        <!-- Animal Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 mb-5 align-items-end wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-lg-6">
                        <h1 class="display-5 mb-0">
                            Galeria
                        </h1>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row g-4">
                            @if (isset($gallery_index[0]))
                                <div class="col-12">
                                    <a class="animal-item"
                                        href="@if ($gallery_index[0]['id'] <= 6) {{ asset($gallery_index[0]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[0]['imagen'] }} @endif"
                                        data-lightbox="animal">
                                        <div class="position-relative">
                                            <img class="img-fluid"
                                                src="@if ($gallery_index[0]['id'] <= 6) {{ asset($gallery_index[0]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[0]['imagen'] }} @endif"
                                                alt="" />
                                            <div class="animal-text p-4">
                                                <p class="text-white small text-uppercase mb-0">
                                                    {{ $gallery_index[0]['titulo_imagen'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if (isset($gallery_index[1]))
                                <div class="col-12">
                                    <a class="animal-item"
                                        href="@if ($gallery_index[2]['id'] <= 6) {{ asset($gallery_index[1]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[1]['imagen'] }} @endif"
                                        data-lightbox="animal">
                                        <div class="position-relative">
                                            <img class="img-fluid"
                                                src="@if ($gallery_index[1]['id'] <= 6) {{ asset($gallery_index[1]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[1]['imagen'] }} @endif"
                                                alt="" />
                                            <div class="animal-text p-4">
                                                <p class="text-white small text-uppercase mb-0">
                                                    {{ $gallery_index[1]['titulo_imagen'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="row g-4">
                            @if (isset($gallery_index[2]))
                                <div class="col-12">
                                    <a class="animal-item"
                                        href="@if ($gallery_index[2]['id'] <= 6) {{ asset($gallery_index[2]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[2]['imagen'] }} @endif"
                                        data-lightbox="animal">
                                        <div class="position-relative">
                                            <img class="img-fluid"
                                                src="@if ($gallery_index[2]['id'] <= 6) {{ asset($gallery_index[2]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[2]['imagen'] }} @endif"
                                                alt="" />
                                            <div class="animal-text p-4">
                                                <p class="text-white small text-uppercase mb-0">
                                                    {{ $gallery_index[2]['titulo_imagen'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if (isset($gallery_index[3]))
                                <div class="col-12">
                                    <a class="animal-item"
                                        href="@if ($gallery_index[3]['id'] <= 6) {{ asset($gallery_index[3]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[3]['imagen'] }} @endif"
                                        data-lightbox="animal">
                                        <div class="position-relative">
                                            <img class="img-fluid"
                                                src="@if ($gallery_index[3]['id'] <= 6) {{ asset($gallery_index[3]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[3]['imagen'] }} @endif"
                                                alt="" />
                                            <div class="animal-text p-4">
                                                <p class="text-white small text-uppercase mb-0">
                                                    {{ $gallery_index[3]['titulo_imagen'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row g-4">
                            @if (isset($gallery_index[4]))
                                <div class="col-12">
                                    <a class="animal-item"
                                        href="@if ($gallery_index[4]['id'] <= 6) {{ asset($gallery_index[4]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[4]['imagen'] }} @endif"
                                        data-lightbox="animal">
                                        <div class="position-relative">
                                            <img class="img-fluid"
                                                src="@if ($gallery_index[4]['id'] <= 6) {{ asset($gallery_index[4]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[4]['imagen'] }} @endif"
                                                alt="" />
                                            <div class="animal-text p-4">
                                                <p class="text-white small text-uppercase mb-0">
                                                    {{ $gallery_index[4]['titulo_imagen'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if (isset($gallery_index[5]))
                                <div class="col-12">
                                    <a class="animal-item"
                                        href="@if ($gallery_index[5]['id'] <= 6) {{ asset($gallery_index[5]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[5]['imagen'] }} @endif"
                                        data-lightbox="animal">
                                        <div class="position-relative">
                                            <img class="img-fluid"
                                                src="@if ($gallery_index[5]['id'] <= 6) {{ asset($gallery_index[5]['imagen']) }} @else {{ asset('storage') . '/images/galeria/' . $gallery_index[5]['imagen'] }} @endif"
                                                alt="" />
                                            <div class="animal-text p-4">
                                                <p class="text-white small text-uppercase mb-0">
                                                    {{ $gallery_index[5]['titulo_imagen'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Animal End -->
        <!-- Visiting Hours Start -->
        <div class="container-xxl bg-primary visiting-hours my-5 py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
                        <h1 class="display-6 text-white mb-5">Horario</h1>
                        <ul class="list-group list-group-flush">
                            @foreach ($disponibilidad as $item)
                                @if ($item->active == 1)
                                    <li class="list-group-item">
                                        <span>{{ $item->day }}</span>
                                        <span>{{ $item->morning_start }} a {{ $item->morning_end }} -
                                            {{ $item->afternoon_start }} a {{ $item->afternoon_end }}</span>
                                    </li>
                                @else
                                    <li class="list-group-item">
                                        <span>{{ $item->day }}</span>
                                        <span>Cerrado</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 text-light wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="display-6 text-white mb-5">Infomacion</h1>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Direcion</td>
                                    <td>{{$landingMaps->direccion}}</td>
                                </tr>
                                <tr>
                                    <td>Numero de Contacto</td>
                                    <td>
                                        <p class="mb-2">+56{{$landingMaps->telefono}}</p>
                                        <p class="mb-0">{{$landingMaps->correo}}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Visiting Hours End -->

    </body>

    </html>
@endsection
