<div class="btn-group">
    @php
        $id_item = null;
        if(isset($id_producto)){
            $id_item = $id_producto;
        }else if(isset($id_insumo)){
            $id_item = $id_insumo;
        }else if(isset($id_medicina)){
            $id_item = $id_medicina;
        }
        $tipoI = null;
        if($tipo_item == "Producto"){
            $tipoI = "producto";
        }else if($tipo_item == "Insumo Medico"){
            $tipoI = "insumo";
        }else{
            $tipoI = "medicamento";
        }
    @endphp
    <td><button type="button" class="btn btn-outline-primary btn-sm"
            onclick="showProduct({{$id_item}},'{{ $tipoI }}')"><span
                class="material-symbols-outlined">visibility</span></button>
        @if (isset($factura))
    <td><a type="button" class="btn btn-outline-primary btn-sm"
            href="{{ route('administracion_inventario.descargarFactura', ['id' => $id]) }}">Factura</a></td>
    @endif

</div>
