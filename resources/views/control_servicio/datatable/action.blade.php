<div class="d-flex justify-content-center">
    @if ($pagado=="No")
    <td>
        <button type="button" class="btn btn-sm btn-secondary"><span class="material-symbols-outlined" onclick="prepararPago({{$id}},{{$monto}})">payments</span></button>
    </td>
    @endif
</div>
