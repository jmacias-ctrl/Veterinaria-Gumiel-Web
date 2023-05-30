<div class="btn-group d-flex justify-content-center">
    <td>
        @can('eliminar productos')
            <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span
                    class="material-symbols-outlined">delete</span></button>
        @endcan
        @can('modificar productos')
            <a id="editMarcas" class="btn btn-outline-warning" href="{{ route('admin.marcaproductos.edit', ['id' => "$id"]) }}"
                role="button"><span class="material-symbols-outlined">edit</span></a>
        @endcan

    </td>
</div>
