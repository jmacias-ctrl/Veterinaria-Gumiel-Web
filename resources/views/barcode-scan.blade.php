<div class="modal fade" id="barcodeScan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escaner de Codigo de Barras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Acerca el Codigo de Barra hacia la Camara</p>
                <div id="reader" width="100%"></div>
                <p id="scannedItem">Codigo Escaneado: </p>
                <input type="text">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            $('#scannedItem').html('Codigo Escaneado: '+decodedText);
            currentPath = window.location.pathname;
            console.log(currentPath);
            if(currentPath=="/administracion-stock"){
                
            }else if(currentPath == "/inventario/punto_de_venta"){

            }
        }

        function onScanFailure(error) {
        }


        $('#barcodeScan').on('show.bs.modal', function(event) {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            $('#barcodeScan').modal('show');
        });
        $('#barcodeScan').on('hide.bs.modal', function(event) {
            html5QrcodeScanner.clear();
        })
    </script>
@endsection
