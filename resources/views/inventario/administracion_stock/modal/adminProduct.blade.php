<div class="modal fade" id="adminProductoModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Administración del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('administracion_inventario.realizar_admin')}}" method="POST" id="adminForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_item" id="id_item">
                    <input type="hidden" name="tipo_item" id="tipo_item">
                    <input type="hidden" name="getStock" id="getStock">
                    <div class="d-flex">
                        <p class="font-weight-bold">Item:&nbsp</p>
                        <p id="nombre_item"></p>
                    </div>
                    <div class="d-flex">
                        <p class="font-weight-bold">Stock Actual:&nbsp</p>
                        <p id="statusStock"></p>
                    </div>
                    <hr class="p-0 mx-0 my-2">
                    <div class="form-group">
                        <label for="adminOption">Opcion</label>
                        <select class="form-control" id="adminOption" name="adminOption" required>
                            <option value="Agregar">Agregar</option>
                            <option value="Restar">Restar</option>
                        </select>
                    </div>
                    <label for="newStock">Stock a Agregar/Restar</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Ej. 3" min="0" id="newStock"
                            name="newStock" aria-label="newStock" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Unidades</span>
                        </div>

                    </div>
                    <hr class="p-0">
                    <h4 id="info">Información y Opciones</h4>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-6" id="costoDiv">
                            <label for="costoStockAgregado">Costo por Unidad</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                </div>
                                <input type="number" class="form-control" id="costoStockAgregado"
                                    name="costoStockAgregado" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="proveedorId">
                            <label for="proveedor">Proveedor</label>
                            <select class="form-control" id="proveedor" name="proveedor" required>
                                <option value="">Seleccione un Proveedor</option>
                                <option value="new">Crear nuevo Proveedor</option>
                                @foreach ($proveedores as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group proveedorForm d-none">
                        <label for="nuevoProveedor">Nombre del Proveedor*</label>
                        <input type="text" class="form-control proveedorInput" id="nuevoProveedor" name="nuevoProveedor">
                    </div>
                    <div class="form-group proveedorForm d-none">
                        <label for="rutProveedor">Rut del Proveedor*</label>
                        <input type="text" class="form-control proveedorInput" id="nuevoRutProveedor" oninput="checkRut(this)" max="10" name="nuevoRutProveedor">
                    </div>
                    <div class="form-group proveedorForm d-none">
                        <label for="telefonoProveedor">Telefono del Proveedor</label>
                        <input type="integer" class="form-control proveedorInput" id="telefonoProveedor" name="telefonoProveedor">
                    </div>
                    <div class="form-group" id="adjuntarFactura">
                        <label for="factura">Adjuntar Factura</label>
                        <input type="file" class="form-control-file" id="factura" name="factura" required>
                    </div>
                    <div class="form-check d-none" id="checkStock">
                        <input class="form-check-input" type="checkbox" value="true" name="checkStockComprados"
                            id="checkStockComprados">
                        <label class="form-check-label" for="defaultCheck1">
                            Contar resta de stock como stock comprados
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" id="btn-submit">Realizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
