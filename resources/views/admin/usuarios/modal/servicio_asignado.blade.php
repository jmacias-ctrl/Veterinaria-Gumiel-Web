<div class="modal fade" id="tipoServicioAsignado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usuarioAsignar">Asignar tipo de servicio a Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.usuarios.asignar_servicio')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <p id="tipoServicioUsuarioAsignado">Tipo de servicio asignado: </p>
                    <input type="hidden" id="id_user" name="id_user">
                    <div class="mb-3">
                        <label for="tipoServicio" class="form-label">Tipo de Servicio</label>
                        <select class="form-select" name="tipoServicio" id="tipoServicio" required>
                            <option selected val="">Seleccione un Tipo de Servicio</option>
                            @foreach ($tipo_servicio as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input class="btn btn-primary" type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
