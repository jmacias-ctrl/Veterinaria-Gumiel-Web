@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrusel Bootstrap</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <div id="carouselExampleControls" class="carousel slide w-50 col-md-6 mx-auto" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/carrousel/01.png') }}" class="d-block w-100" alt="First slide">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/carrousel/02.png') }}" class="d-block w-100" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/carrousel/03.png') }}" class="d-block w-100" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="bg-white">
    <section class="d-flex justify-content-center align-items-center p-4">
      <div class="container bg-darkgreen rounded-50 w-50 p-4">
        <img class="float-right" src="{{ asset('images/agenda.png') }}">

        <h2 class="text-white">Agendar horas</h2>
        <p class="lead text-white">
          Puedes solicitar tu hora con el veterinario o a servicios de peluquería.
        </p>
        <div class="">
          <a href="#" class="btn btn-success btn-lg">Agendar hora</a>
        </div>
      </div>


    </section>
  </div>

  <style>
    .bg-darkgreen {
      background-color: #2e7646;
    }

    .rounded-50 {
      border-radius: 20px;
    }
  </style>

  <section class="fondoRandom">
    <div class="container">
      <div class="row">

        <div>
          <h2 class="text-white text-center mb-5">Nuestros servicios disponibles</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  mb-4 p-4">
          <div class="p-4  cuadro-servicio">
            <div class="text-center">
              <img src="{{ asset('images/peluqueria.png') }}" style="width:50%;" alt="Imagen servicio 1" class="img-fluid rounded-circle mb-3" />
            </div>
            <h3 class="text-center font-weight-bold mb-3">Peluquería</h3>
            <p class="text-center">
              Ofrecemos servicios de peluquería para mantener a tus mascotas
              limpias y bien arregladas.
            </p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-4 p-4">
          <div class="p-4 cuadro-servicio">
            <div class="text-center">
              <img src="{{ asset('images/veterinaria.png') }}" style="width:50%;" alt="Imagen servicio 2" class="img-fluid rounded-circle mb-3" />
            </div>
            <h3 class="text-center font-weight-bold mb-3">Veterinaria</h3>
            <p class="text-center">
              Realizamos consultas medicas para diagnosticar y tratar
              cualquier problema de salud de tus mascotas. Tambien contamos
              con un amplio catalogo de vacunas para prevenir diversas
              enfermedades.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="contacto" style="background-color: white;">
    <div class="container p-4">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-center">Contáctanos</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="#" method="POST" style="background-color: #6A6767; color: white; border-radius: 10px; padding: 20px;">
            <div class="form-group">
              <label for="name">Nombre completo</label>
              <input type="text" class="form-control" id="name" name="name" required style="margin-bottom: 10px;" />
            </div>
            <div class="form-group">
              <label for="email">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="email" required style="margin-bottom: 10px;" />
            </div>
            <div class="form-group">
              <label for="phone">Teléfono</label>
              <input type="text" class="form-control" id="phone" name="phone" required style="margin-bottom: 10px;" />
            </div>
            <div class="form-group">
              <label for="message">Mensaje</label>
              <textarea class="form-control" id="message" name="message" rows="5" required style="margin-bottom: 10px;"></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="fondoGumiel">
    <div class="container">
      <div class="row">
        <h2 class="text-white text-center pb-5">Donde puedes encontrarnos</h2>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6 ">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3152.442873327544!2d-73.40212952459001!3d-37.803094333427644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x966a74cb799f78ed%3A0x4e32e96ea2b1070b!2sCl%C3%ADnica%20y%20Farmacia%20Veterinaria%20Gumiel!5e0!3m2!1ses!2scl!4v1682454729998!5m2!1ses!2scl" width="600" height="450" style="border-radius:25px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <h2 style="color:#fff">asdasfd</h2>
        </div>
      </div>
    </div>
  </section>

  <footer style="background-color: #333; color: #fff; padding: 20px">
    <p style="text-align: center">
      © 2023 VeterinariaGumiel. Todos los derechos reservados.
    </p>
  </footer>

  <style>
    .fondoRandom {
      /* height: 900px; */
      background-color: rgba(25, 60, 37, .70);
      background-blend-mode: overlay;
      background-image: url("{{ asset('images/common_01.jpg') }}");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      padding-top: 90px;
      padding-bottom: 90px;
    }

    .cuadro-servicio {
      background-color: rgba(255, 255, 255, .75);
      border-radius: 5%;
      width: 500px;
      height: 550px;
    }

    @media screen and (max-width: 480px) {
      .cuadro-servicio {
        width: 100%;
      }
    }

    .contacto{
      padding-top: 90px;
      padding-bottom: 90px;
    }

    .fondoGumiel {
      padding-top: 90px;
      padding-bottom: 90px;
      background-color: rgba(25, 60, 37, .70);
      background-blend-mode: overlay;
      background-image: url("{{ asset('images/vetgum.jpg') }}");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    .opacity-50 {
      background-color: rgba(255, 255, 255, 0.5);
    }

    .opacity-100 {
      background-color: rgba(255, 255, 255, 1);
    }
  </style>
</body>

</html>


@endsection