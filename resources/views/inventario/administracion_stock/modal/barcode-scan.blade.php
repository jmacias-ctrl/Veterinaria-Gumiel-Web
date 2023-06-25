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
                <p id="scannedItem">Codigo Escaneado: Ninguno</p>
                <p id="errorScan" class="d-none">Item escaneado no se encuentra en la base de datos</p>
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
                    width: 350,
                    height: 350
                }
            },
            /* verbose= */
            false);

        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.pause();
            $('#scannedItem').html('Codigo Escaneado: '+decodedText);
            currentPath = window.location.pathname;
            
            axios.get("{{ route('administracion_inventario.scan') }}", {
                    params: {
                        codigo: decodedText,
                    }
                })
                .then(function(response) {
                    if(response.data.success==true){
                        cleanAdmin_ProductModal();
                        setAdmin_ProductModal(response.data.itemGet['id'], response.data.itemGet['nombre'], response.data.tipo_item, response.data.itemGet['stock']);
                        $('#barcodeScan').modal('toggle');
                    }else{
                        $("#errorScan").html('Item escaneado no se encuentra en la base de datos');
                        $("#errorScan").removeClass('d-none');
                        html5QrcodeScanner.resume();
                    }
                    
                })
                .catch(function(error) {
                    $("#errorScan").html('Error al buscar el item escaneado');
                });
        }

        function onScanFailure(error) {
        }


        $('#barcodeScan').on('show.bs.modal', function(event) {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            $('#errorScan').html("");
            $('#scannedItem').html('Codigo Escaneado: Ninguno');
            $('#barcodeScan').modal('show');
        });
        $('#barcodeScan').on('hide.bs.modal', function(event) {
            html5QrcodeScanner.clear();
        })
    </script>
@endsection
