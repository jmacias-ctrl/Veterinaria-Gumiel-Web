<div class="modal fade" id="comprobanteModal" data-backdrop="static" data-keyboard="false" aria-labelledby="comprobanteModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comprobante de Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item" id="numVenta">Num. Venta:</li>
                    <li class="list-group-item" id="fecha">Fecha:</li>
                    <li class="list-group-item" id="hora">Hora:</li>
                    <li class="list-group-item" id="nombreClienteShow">Nombre del Cliente: </li>
                    <li class="list-group-item" id="metodoPagoShow">Metodo de Pago: </li>
                </ul>
                </ul>
                <h3 class="mt-2">Productos</h3>
                <table class="table">
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
                <hr>
                
                <div class="d-flex justify-content-center d-none">
                    
                    <form class="form-inline">
                        <label for="email_cliente" class="form-label mr-4">Enviar comprobante por correo</label>
                        <div class="form-group mb-2">
                            <input type="email" class="form-control" id="email_cliente" name="email_cliente"
                                value="email@example.com">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
