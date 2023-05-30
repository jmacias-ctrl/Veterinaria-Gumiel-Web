<style>
  .bg-darkgreen {
    background-color: #2e7646;
  }

  .rounded-50 {
    border-radius: 20px;
  }

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

  .datos {
    align-content: initial;
    color: #fff;
    padding-top: 30px;
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

  .center {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .contacto {
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