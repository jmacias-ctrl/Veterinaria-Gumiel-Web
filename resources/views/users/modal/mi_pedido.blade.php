<div class="modal fade" id="detalleVenta" style="z-index: 999999;" aria-labelledby="detalleVenta" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle de la Venta</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item" id="numVenta">Num. Venta:</li>
                    <li class="list-group-item" id="fecha">Fecha:</li>
                    <li class="list-group-item" id="hora">Hora:</li>
                    <li class="list-group-item" id="metodoPagoShow">Metodo de Pago: </li>
                </ul>
                </ul>
                <h3 class="mt-4 mb-3">Productos</h3>
                <table class="table dt-responsive" style="width:100%;" id="detalleTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody id="productosVendidos">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col" id="totalVentaShow">Total de la venta:</th>
                        </tr>
                    </tfoot>
                </table>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
