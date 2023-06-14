<div class="bg-white">
  <section class="d-flex justify-content-center align-items-center p-4">
    <div class="container bg-darkgreen rounded-50 w-100 p-4">
      <div class="imagen-check">
        <img style="width:25%; opacity:1;" class="float-right" src="{{ asset('images/doc-check.png') }}">
      </div>
      <div>
        <h2 class="text-white">Agenda tu hora!</h2>
        <p class="lead text-white">
        ¿Tu mascota necesita una consulta veterinaria o un corte de pelo? ¡Estás en el lugar correcto! Puedes solicitar una hora con nuestros expertos de manera fácil y rápida. Simplemente haz clic en el botón "Agendar horas"
        </p>
        <div class="">
          <a href="{{route('agendar-horas.create') }}" class="btn btn-success btn-lg">Agendar hora</a>
        </div>
      </div>
    </div>
  </section>
</div>