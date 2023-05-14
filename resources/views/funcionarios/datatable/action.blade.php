<div class="btn-group d-flex justify-content-center">
    <td><button type="button" class="btn btn-outline-danger" onclick="deleted({{ $id }})"><span class="material-symbols-outlined">delete</span></button>
    <a href="{{url('/funcionarios/'.$id.'/edit')}}"  class="btn btn-outline-warning" ><span class="material-symbols-outlined">edit</span></a>
    </td>
</div>

