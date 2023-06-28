<div class="col-md-3">
    <div class="card m-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mi-perfil') }}" style="@if(Route::current()->getName()=='mi-perfil') color:black; @endif">
                    <span class="material-icons" style="position:relative; top:6px;">person</span>Mi Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mis-pedidos') }}" style="@if (request()->routeIs('mis-pedidos')) color:black; @endif">
                    <span class="material-icons" style="position:relative; top:6px">list_alt</span> Mis Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agendar-horas.create') }}" style="@if(Route::current()->getName()=='agendar-horas.create') color:black; @endif">
                    <span class="material-icons"style="position:relative; top:6px">schedule</span> Agendar hora</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Agendar') }}" style="@if (request()->routeIs('Agendar')) color:black; @endif">
                    <span class="material-icons" style="position:relative; top:6px">calendar_month</span> Mis citas</a>
            </li>
        </ul>
    </div>
</div>

