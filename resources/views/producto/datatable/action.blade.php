<div class="btn-group d-flex justify-content-center">
    <td>
        <button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})">
        <span class="material-symbols-outlined">delete</span></button>
        <a id="editServicios" class="btn btn-outline-warning" href="{{ route('admin.productos.edit', $id) }}" class="btn btn-outline-primary"><span class="material-symbols-outlined">edit</span></a>
    </td>
</div>
