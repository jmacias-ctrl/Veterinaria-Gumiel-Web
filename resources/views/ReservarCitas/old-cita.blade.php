<div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo Servicio</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>       
                </thead> 
            <tbody>
                @foreach ($oldCita as $cita )
                <tr>
                    <th scope="row">
                        {{ $cita->id }}
                    </th>
                    <td>{{ $cita->tiposervicio->nombre }}</td>
                    <td>{{ $cita->scheduled_date }}</td>
                    <td>{{ $cita->status }}</td>
                    <td>
                        <a href="{{ url('/miscitas/'.$cita->id) }}" class="btn btn-outline-primary btn-sm"> Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>