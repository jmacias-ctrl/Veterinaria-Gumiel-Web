@extends('layouts.app')
@section('title')
Inicio - Veterinaria Gumiel
@endsection

@section('content')

<!DOCTYPE html>
<html lang="es">

@include('landing-page-header')
@include('landing-page-floatIcons')
<body>

<section id="nosotros">
  <div class="container">
    <h1>Nosotros</h1>
    <img src="{{ asset('images/carrousel/01.png') }}" alt="gumiel-01">

    <br>
    <h3>¿Quiénes somos?</h3>
    <p>Somos un equipo de profesionales veterinarios altamente capacitados y apasionados por nuestro trabajo, comprometidos con la salud y el bienestar de tus mascotas. Nuestra veterinaria está lista para atender a tu amigo peludo con los cuidados que merece, proporcionando un servicio excepcional y una experiencia única para ti y tus animales.</p>
    <h3>¿Qué estamos haciendo? </h3>
    <p>Ofrecemos servicios de Consultas Médicas, Vacunaciones, Cirugías y Exámenes de Laboratorio, todos diseñados para mantener a sus mascotas felices, saludables y activas. Nos enorgullece ofrecer una amplia variedad de opciones de tratamiento y atención para asegurarnos de que su mascota reciba la atención que se merece.</p>
    <h3>¿Hacia dónde apuntamos?</h3>
    <p>En nuestra veterinaria, apuntamos a ser líderes en el cuidado y atención de las mascotas y animales en nuestra comunidad. Nos esforzamos por estar a la vanguardia de la tecnología y la investigación para ofrecer los mejores tratamientos y opciones de cuidado para nuestros clientes y sus animales.</p>
    <p>Estamos comprometidos con el bienestar de sus mascotas y animales, y estamos aquí para brindarles el mejor servicio y atención posible. ¡Gracias por confiar en nosotros para el cuidado de sus seres queridos peludos!</p>
  </div>
</section>

<style>
  #nosotros {
    background-color: #f9f9f9;
    padding: 50px;
  }
  
  #nosotros h2 {
    font-size: 36px;
    color: #333;
    margin-bottom: 20px;
  }
  
  #nosotros p {
    font-size: 18px;
    line-height: 1.5;
    color: #666;
    margin-bottom: 30px;
  }
  
  #nosotros h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
  }
  
  #nosotros ul {
    list-style: none;
    margin-left: 0;
    padding-left: 0;
  }
  
  #nosotros li {
    font-size: 18px;
    color: #666;
    margin-bottom: 10px;
  }
</style>


</body>

</html>

@endsection