<div class="btn-group d-flex justify-content-center">
    <td>
        @can('eliminar insumos medicos')
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleted({{ $id }})"><span
                    class="material-symbols-outlined">delete</span></button>
        @endcan

        @can('modificar insumos medicos')
            <a id="editInsumos" class="btn btn-outline-warning btn-sm"
                href="{{ route('admin.insumos_medicos.edit', ['id' => "$id"]) }}" role="button"><span
                    class="material-symbols-outlined">edit</span></a>
        @endcan

    </td>
</div>
