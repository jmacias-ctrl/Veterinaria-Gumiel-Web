<div class="modal fade" id="pagoVenta" aria-labelledby="pagoVenta" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Realizar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('point_sale.venta')}}" method="POST" id="metodoPagoForm">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ auth()->user()->id }}">
                    <input type="hidden" id="monto" name="monto">
                    <input type="hidden" id="vuelto" name="vuelto">
                    <h3>Metodo de Pago</h3>
                    <select class="form-control" id="metodoPago" name="metodoPago" onchange="cambioMetodoPago()">
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                    <hr>
                    <div class="form-group">
                        <label for="nombreCliente">Nombre del Cliente:</label>
                        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"
                            placeholder="Ej. Juan" required>
                    </div>
                    <div class="form-group d-none" id="numOperacionDiv">
                        <label for="numOperacion">Numero de Operacion:</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" id="numOperacion" name="numOperacion"
                                placeholder="">
                        </div>
                    </div>
                    <div class="form-group d-none" id="bancoDiv">
                        <label for="banco">Banco</label>
                        <select class="form-control" id="banco" name="banco">
                            <option value="bancoestado">Banco Estado</option>
                            <option value="bancofalabella">Banco Falabella</option>
                            <option value="bancosantander">Banco Santander</option>
                            <option value="bancobci">Banco BCI</option>
                            <option value="bancochile">Banco de Chile</option>
                            <option value="bancoscotiabank">Banco Scotiabank</option>
                        </select>
                    </div>
                    <div class="form-group" id="montoEfectivoDiv">
                        <label for="montoEfectivo">Efectivo:</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" id="montoEfectivo" name="montoEfectivo"
                                placeholder="" required>
                        </div>
                    </div>
                    <hr>
                    <h3 id="totalPagarModal">Total a Pagar: $0</h3>
                    <h3 id="vueltoHtml">Vuelto: $0</h3>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Pagar">
            </div>
            </form>
        </div>
    </div>
</div>