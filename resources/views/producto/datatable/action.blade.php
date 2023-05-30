<div class="btn-group d-flex justify-content-center">
    <td>
        @can('eliminar productos')
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleted({{ $id }})">
                <span class="material-symbols-outlined">delete</span></button>
        @endcan
        @can('modificar productos')
            <a id="editServicios" class="btn btn-outline-warning btn-sm" href="{{ route('productos.edit', $id) }}"
                class="btn btn-outline-primary"><span class="material-symbols-outlined">edit</span></a>
        @endcan

    </td>
</div>
