@extends('layouts.app')
@section('title')
    Acerca de Nosotros - Veterinaria Gumiel
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid header-bg py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="opacity: 1; background-color:black;">
        <div class="container py-5">
            <h1 class="display-4 text-white mb-3 animated slideInDown">Acerca de Nosotros</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{route('inicio')}}">Inicio</a>
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
                        ¿Quiénes somos?
                    </h1>
                    <p class="mb-4">
                        Somos un equipo de profesionales veterinarios altamente capacitados y apasionados por nuestro
                        trabajo, comprometidos con la salud y el bienestar de tus mascotas. Nuestra veterinaria está lista
                        para atender a tu amigo peludo con los cuidados que merece, proporcionando un servicio excepcional y
                        una experiencia única para ti y tus animales.
                    </p>
                    <h1 class="display-5 mt-3 mb-4">
                        ¿Qué estamos haciendo?
                    </h1>
                    <p class="mb-4">
                        Ofrecemos servicios de Consultas Médicas, Vacunaciones, Cirugías y Exámenes de Laboratorio, todos
                        diseñados para mantener a sus mascotas felices, saludables y activas. Nos enorgullece ofrecer una
                        amplia variedad de opciones de tratamiento y atención para asegurarnos de que su mascota reciba la
                        atención que se merece.
                    </p>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid" src="{{ asset('images/vetgum.jpg') }}" alt="" />
                </div>
            </div>
            <div class="row g-5 mt-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid" src="{{ asset('images/vet05.png') }}" alt="" />
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">

                    <h1 class="display-5 mb-5">
                        ¿Hacia dónde apuntamos?
                    </h1>
                    <p class="mb-4">
                        En nuestra veterinaria, apuntamos a ser líderes en el cuidado y atención de las mascotas y animales
                        en nuestra comunidad. Nos esforzamos por estar a la vanguardia de la tecnología y la investigación
                        para ofrecer los mejores tratamientos y opciones de cuidado para nuestros clientes y sus animales.

                        Estamos comprometidos con el bienestar de sus mascotas y animales, y estamos aquí para brindarles el
                        mejor servicio y atención posible. ¡Gracias por confiar en nosotros para el cuidado de sus seres
                        queridos peludos!
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
