<td>
    <div class="btn-group d-flex justify-content-center">
        @can('eliminar roles')
            <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span
                    class="material-symbols-outlined">delete</span></button>
        @endcan
        @can('modificar roles')
            <a id="modifyRoles" class="btn btn-outline-warning" href="{{ route('admin.roles.modify', ['id' => "$id"]) }}"
                role="button"><span class="material-symbols-outlined">edit</span></a>
        @endcan
    </div>
</td>
