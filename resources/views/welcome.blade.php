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
                            Servicios de Veterinaria y Peluqueria
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
                            Agenda Tu Hora
                        </h1>
                        <p class="mb-4">
                            ¿Tu mascota necesita una consulta veterinaria o un corte de pelo? ¡Estás en el lugar correcto!
                            Puedes solicitar una hora con nuestros expertos de manera fácil y rápida.
                        </p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Agenda Ahora</a>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <img class="img-fluid" src="{{ asset('images/vet01.png') }}" alt="" />
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
                    <div class="col-lg-6 text-lg-end">
                        <a class="btn btn-primary py-3 px-5" href="">Ver Más</a>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row g-4">
                            <div class="col-12">
                                <a class="animal-item" href="{{ asset('images/vet03.png') }}" data-lightbox="animal">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ asset('images/vet03.png') }}" alt="" />
                                        <div class="animal-text p-4">
                                            <p class="text-white small text-uppercase mb-0">Pacientes</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a class="animal-item" href="{{ asset('images/vet04.png') }}" data-lightbox="animal">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ asset('images/vet04.png') }}" alt="" />
                                        <div class="animal-text p-4">
                                            <p class="text-white small text-uppercase mb-0">Animal</p>
                                            <h5 class="text-white mb-0">Elephant</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="row g-4">
                            <div class="col-12">
                                <a class="animal-item" href="{{ asset('images/vet05.png') }}" data-lightbox="animal">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ asset('images/vet05.png') }}" alt="" />
                                        <div class="animal-text p-4">
                                            <p class="text-white small text-uppercase mb-0">Animal</p>
                                            <h5 class="text-white mb-0">Elephant</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a class="animal-item" href="{{ asset('images/vet06.png') }}" data-lightbox="animal">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ asset('images/vet06.png') }}" alt="" />
                                        <div class="animal-text p-4">
                                            <p class="text-white small text-uppercase mb-0">Animal</p>
                                            <h5 class="text-white mb-0">Elephant</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row g-4">
                            <div class="col-12">
                                <a class="animal-item" href="{{ asset('images/vet07.png') }}" data-lightbox="animal">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ asset('images/vet07.png') }}" alt="" />
                                        <div class="animal-text p-4">
                                            <p class="text-white small text-uppercase mb-0">Animal</p>
                                            <h5 class="text-white mb-0">Elephant</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a class="animal-item" href="{{ asset('images/vet08.png') }}" data-lightbox="animal">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ asset('images/vet08.png') }}" alt="" />
                                        <div class="animal-text p-4">
                                            <p class="text-white small text-uppercase mb-0">Animal</p>
                                            <h5 class="text-white mb-0">Elephant</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
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
                            <li class="list-group-item">
                                <span>Lunes</span>
                                <span>9:00 a 14:00 - 15:00 a 19:00</span>
                            </li>
                            <li class="list-group-item">
                                <span>Martes</span>
                                <span>9:00 a 14:00 - 15:00 a 19:00</span>
                            </li>
                            <li class="list-group-item">
                                <span>Miercoles</span>
                                <span>9:00 a 14:00 - 15:00 a 19:00</span>
                            </li>
                            <li class="list-group-item">
                                <span>Jueves</span>
                                <span>9:00 a 14:00 - 15:00 a 19:00</span>
                            </li>
                            <li class="list-group-item">
                                <span>Viernes</span>
                                <span>9:00 a 14:00 - 15:00 a 19:00</span>
                            </li>
                            <li class="list-group-item">
                                <span>Sabado</span>
                                <span>9:00 a 14:00 - 15:00 a 19:00</span>
                            </li>
                            <li class="list-group-item">
                                <span>Domingo</span>
                                <span>Cerrado</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-light wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="display-6 text-white mb-5">Infomacion</h1>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Direcion</td>
                                    <td>Villagran 437, Cañete, Chile</td>
                                </tr>
                                <tr>
                                    <td>Numero de Contacto</td>
                                    <td>
                                        <p class="mb-2">+56977088874</p>
                                        <p class="mb-0">veterinariagumiel@gmail.com</p>
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
