<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Descripción</th>
                <th scope="col">Tipo Servicio</th>
                @if (auth()->user()->hasRole('Veterinario'))
                    <th scope="col">Paciente</th>
                @elseif (auth()->user()->hasRole('Peluquero'))
                    <th scope="col">Paciente</th>
                @else
                    <th scope="col">Funcionario</th>
                @endif
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                @if (auth()->user()->hasRole('Veterinario'))
                    <th scope="col">Tipo</th>
                @elseif (auth()->user()->hasRole('Peluquero'))
                    <th scope="col">Tamaño</th>
                @else
                    <th scope="col">Tipo / Tamaño</th>
                @endif
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingCita as $cita)
                <tr>
                    <th scope="row">
                        {{ $cita->id }}
                    </th>
                    <td>{{ $cita->description }}</td>
                    <td>{{ $cita->tiposervicio->nombre }}</td>
                    @if (auth()->user()->hasRole('Veterinario'))
                        <td>{{ $cita->paciente->name }}</td>
                    @elseif (auth()->user()->hasRole('Peluquero'))
                        <td>{{ $cita->paciente->name }}</td>
                    @else
                        <td>{{ $cita->funcionario->name }}</td>
                    @endif
                    <td>{{ $cita->scheduled_date }}</td>
                    <td>{{ $cita->sheduled_time }}</td>
                    <td>{{ $cita->type }}</td>

                    <td>
                        @if (auth()->user()->hasRole('Admin'))
                            <a href="{{ url('/miscitas/' . $cita->id) }}" class="btn btn-sm btn-outline-primary"
                                title="Ver cita">
                                <i class="ni far fa-eye"></i>
                            </a>
                        @endif
                        @if (auth()->user()->hasRole('Veterinario') ||
                                auth()->user()->hasRole('Peluquero') ||
                                auth()->user()->hasRole('Admin'))
                            <form action="{{ url('/miscitas/' . $cita->id . '/confirm') }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Confirmar cita">
                                    <i class="ni ni-check-bold"></i>
                                </button>
                            </form>
                        @endif
                        <form action="{{ url('/miscitas/' . $cita->id . '/cancel') }}" method="POST"
                            class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Cancelar cita">
                                <i class="ni ni-fat-remove"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
