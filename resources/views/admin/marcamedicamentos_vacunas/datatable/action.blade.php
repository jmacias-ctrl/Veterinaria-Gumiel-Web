<div class="btn-group d-flex justify-content-center">
    <td>
        <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span
                                    class="material-symbols-outlined">delete</span></button>
                            <a id="editMarcas"
                                class="btn btn-outline-warning"
                                href="{{ route('admin.marcamedicamentos_vacunas.edit', ['id' => "$id"]) }}" role="button"><span
                                    class="material-symbols-outlined">edit</span></a>
    </td>
</div>