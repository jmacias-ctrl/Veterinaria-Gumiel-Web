<button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span
    class="material-symbols-outlined">delete</span></button>
<a id="modifyRoles" class="btn btn-outline-warning"
href="{{ route('admin.roles.modify', ['id' => "$id"]) }}" role="button"><span
    class="material-symbols-outlined">edit</span></a>