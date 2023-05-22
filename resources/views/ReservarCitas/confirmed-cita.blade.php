<div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Tipo Servicio</th>
                        <th scope="col">Funcionario</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>       
                </thead> 
            <tbody>
                @foreach ($confirmedCita as $cita )
                <tr>
                    <th scope="row">
                        {{ $cita->id }}
                    </th>
                    <td>{{ $cita->description }}</td>
                    <td>{{ $cita->tiposervicio->nombre }}</td>
                    <td>{{ $cita->funcionario->name }}</td>
                    <td>{{ $cita->scheduled_date }}</td>
                    <td>{{ $cita->sheduled_time }}</td>
                    <td>{{ $cita->type }}</td>
                    <td>{{ $cita->status }}</td>
                    <td>
                        <form action="{{ url('/miscitas/'.$cita->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Cancelar cita">Cancelar cita</button>  

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>