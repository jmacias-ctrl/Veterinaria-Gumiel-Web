<div class="d-flex justify-content-center">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group">
            <a class="btn btn-outline-success @if (Route::current()->getName() == 'landing.ubication.edit') active @endif"
                href="{{ route('landing.ubication.edit') }}" role="button">Información</a>
            <a class="btn btn-outline-success @if (Route::current()->getName() == 'landing.nosotros.edit') active @endif"
                href="{{ route('landing.nosotros.edit') }}" role="button">Sección Nosotros</a>
        </div>
        <div class="btn-group" role="group">
            <a class="btn btn-outline-success @if (Route::current()->getName() == 'landing.website.edit') active @endif"
                href="{{ route('landing.website.edit') }}" role="button">Landing Page</a>
            <a class="btn btn-outline-success @if (Route::current()->getName() == 'landing.horario.edit') active @endif"
                href="{{ route('landing.horario.edit') }}" role="button">Horario</a>
        </div>
    </div>
</div>
