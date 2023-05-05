<div class="btn-group d-flex justify-content-center">
    <td><button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span class="material-symbols-outlined">delete</span></button>
        <a id="modifyRoles" class="btn btn-outline-primary" href="{{ route('admin.usuarios.roles', ['id' => "$id"]) }}" role="button"><span class="material-symbols-outlined">manage_accounts</span></a>
    </td>
</div>