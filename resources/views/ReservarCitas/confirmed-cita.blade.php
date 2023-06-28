<div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Tipo Servicio</th>
                        @if (auth()->user()->hasRole('Cliente'))
                        <th scope="col">Funcionario</th>
                        @elseif(auth()->user()->hasRole('Veterinario'))
                        <th scope="col">Paciente</th>
                        @elseif (auth()->user()->hasRole('Peluquero'))
                        <th scope="col">Paciente</th>
                        @endif
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        @if (auth()->user()->hasRole('Veterinario'))
                        <th scope="col">Tipo</th>
                        @elseif (auth()->user()->hasRole('Cliente'))
                        <th scope="col">Tipo / Tamaño</th>
                        @elseif (auth()->user()->hasRole('Peluquero'))
                        <th scope="col">Tamaño</th>
                        @endif
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
                    @if (auth()->user()->hasRole('Cliente'))
                    <td>{{ $cita->funcionario->name }}</td>
                    @elseif (auth()->user()->hasRole('Veterinario'))
                    <td>{{ $cita->paciente->name }}</td>
                    @elseif (auth()->user()->hasRole('Peluquero'))
                    <td>{{ $cita->paciente->name }}</td>
                    @endif
                    <td>{{ $cita->scheduled_date }}</td>
                    <td>{{ $cita->sheduled_time }}</td>
                    <td>{{ $cita->type }}</td>
                    <td>{{ $cita->status }}</td>
                    <td>
                        @if (auth()->user()->hasRole('Admin'))
                            <a href="{{ url('/miscitas/'.$cita->id) }}" class="btn btn-sm btn-outline-primary" title="Ver cita">Ver</button>
                        @endif
                        <a href="{{ url('/miscitas/'.$cita->id.'/generar-ficha-medica') }}" class="btn btn-sm btn-outline-primary" title="Cancelar cita">Generar ficha medica</button>
                        <a href="{{ url('/miscitas/'.$cita->id.'/cancel') }}" class="btn btn-sm btn-outline-danger" title="Cancelar cita">Cancelar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
