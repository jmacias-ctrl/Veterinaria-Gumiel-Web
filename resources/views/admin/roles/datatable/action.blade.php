<button type="button" class="btn btn-danger" onclick="deleted({{ $id }})"><span
    class="material-symbols-outlined">delete</span></button>
<a id="modifyRoles" class="btn btn-warning"
href="{{ route('admin.roles.modify', ['id' => "$id"]) }}" role="button"><span
    class="material-symbols-outlined">edit</span></a>
<a id="EditPermissions" class="btn btn-primary"
href="{{ route('admin.roles.permission', ['id' => "$id"]) }}" role="button"><span
    class="material-symbols-outlined">settings</span></a>