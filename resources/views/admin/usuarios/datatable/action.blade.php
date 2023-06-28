<div class="btn-group d-flex justify-content-center">
    <td>
        @if ($gestionvet || $gestionpeluq)
            <button type="button" class="btn btn-outline-success" onclick="asignar_tipo_servicio({{$id}},'{{$name}}','{{$nombre}}')"><span class="material-symbols-outlined">medical_information</span></button>
        @endif
        @can('eliminar usuario')
            <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span
                    class="material-symbols-outlined">delete</span></button>
        @endcan
        @can('asignar roles usuario')
            <a id="modifyRoles" class="btn btn-outline-primary" href="{{ route('admin.usuarios.roles', ['id' => "$id"]) }}"
                role="button"><span class="material-symbols-outlined">manage_accounts</span></a>
        @endcan
    </td>
</div>
