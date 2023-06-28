<div class="d-flex justify-content-center">
    <td>
        @if (request()->routeIs('pedidos_online.index') && $estado != 'entregado')
            <form action="{{route('pedidos_online.cambiar_estado')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                <div class="input-group mr-3">
                    <select class="form-select form-select-sm" name="estado" id="estado" required>
                        <option selected value="">Cambiar Estado</option>
                        <option value="pagado">Pagado</option>
                        <option value="listo para retirar">Listo Para Retirar</option>
                        <option value="entregado">Entregado</option>
                    </select>
                    <div class="input-group-append">
                        <input class="btn btn-outline-success btn-sm" type="submit" value="Cambiar">
                    </div>
                </div>
            </form>
        @endif
        <a name="" id="" class="btn btn-outline-danger" href="{{route('ventas.comprobante', ['ventaId'=>$id])}}" role="button"><span
            class="material-symbols-outlined">download</span></a>
        <button type="button" class="btn btn-sm btn-secondary @if(request()->routeIs('pedidos_online.index')) ml-3 @endif" onclick="verDetalle({{ $id }})"><span
                class="material-symbols-outlined">info</span></button>
    </td>
</div>
