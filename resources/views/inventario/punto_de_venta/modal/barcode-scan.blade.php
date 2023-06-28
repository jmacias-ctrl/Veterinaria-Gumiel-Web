<div class="modal fade" id="barcodeScan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escaner de Codigo de Barras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Acerca el Codigo de Barra hacia la Camara</p>
                <div id="reader" width="300px;"></div>
                <p id="scannedItem">Codigo Escaneado: Ninguno</p>
                <p id="errorScan" class="d-none text-danger">Item escaneado no se encuentra en la base de datos</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
            },
            /* verbose= */
            false);

        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.pause();
            $('#scannedItem').html('Codigo Escaneado: ' + decodedText);
            var cantProducto = 1;
            axios.get(" {{ route('point_sale.addProduct') }}", {
                    params: {
                        codigo: decodedText,
                        cantProduct: cantProducto,
                    }
                })
                .then(res => {
                    if (res.data.success == true) {
                        updateTable(res.data.cartItems, res.data.total, res.data.subTotal);
                        $('#barcodeScan').modal('toggle');
                    } else {
                        $("#errorScan").html('Codigo escaneado no se encuentra en la base de datos');
                        $("#errorScan").removeClass('d-none');
                        html5QrcodeScanner.resume();
                    }

                })

                .catch(err => {
                    console.error(err);
                    $("#errorScan").html('Codigo escaneado no se encuentra en la base de datos');
                    $("#errorScan").removeClass('d-none');
                    html5QrcodeScanner.resume();
                })

        }

        function onScanFailure(error) {}


        $('#barcodeScan').on('show.bs.modal', function(event) {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            $('#scannedItem').html('Codigo Escaneado: Ninguno');
            $("#errorScan").addClass('d-none');
            $('#barcodeScan').modal('show');
        });
        $('#barcodeScan').on('hide.bs.modal', function(event) {
            html5QrcodeScanner.clear();
        })
    </script>
@endsection
