<div class="btn-group d-flex justify-content-center">
    <td>
        @can('eliminar proveedores')
            <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})">
                <span class="material-symbols-outlined">delete</span></button>
        @endcan
        @can('modificar proveedores')
            <a id="editServicios" class="btn btn-outline-warning" href="{{ route('proveedores.edit', $id) }}"
                class="btn btn-outline-primary"><span class="material-symbols-outlined">edit</span></a>
        @endcan

    </td>
</div>
