<div class="btn-group d-flex justify-content-center">
    <td>
        @can('eliminar categorias')
            <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span
                    class="material-symbols-outlined">delete</span></button>
        @endcan

        @can('modificar categorias')
            <a id="editInsumos" class="btn btn-outline-warning"
                href="{{ route('admin.categorias.edit', ['id' => "$id"]) }}" role="button"><span
                    class="material-symbols-outlined">edit</span></a>
        @endcan

    </td>
</div>
