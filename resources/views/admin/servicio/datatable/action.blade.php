<td>
    <div class="btn-group d-flex justify-content-center">
        @can('eliminar servicios')
            <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})">
                <span class="material-symbols-outlined">delete</span></button>
        @endcan
        @can('modificar servicios')
            <a id="editServicios" class="btn btn-outline-warning" href="{{ route('admin.servicio.edit', ['id' => "$id"]) }}"
                role="button"><span class="material-symbols-outlined">edit</span></a>
        @endcan
    </div>
</td>
