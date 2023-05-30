<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center">
                    <div class="col-6">
                        <div class="d-flex">
                            <p class="font-weight-bold">Item:&nbsp</p>
                            <p id="nombre"> Colonia</p>
                        </div>
                        <div class="d-flex" id="descripcionDiv">
                            <p class="font-weight-bold">Descripción:&nbsp</p>
                            <p id="descripcion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum eius
                                recusandae eveniet
                                atque suscipit harum, dolorem eum libero maxime eligendi! Eos nulla totam eligendi
                                dolores voluptatibus ipsum sunt, quidem maiores.</p>
                        </div>
                        <div class="d-flex">
                            <p class="font-weight-bold">Tipo:&nbsp</p>
                            <p id="tipo">Accesorio</p>
                        </div>
                        <div class="d-flex">
                            <p class="font-weight-bold">Marca:&nbsp</p>
                            <p id="marca">Generico</p>
                        </div>
                        <div class="d-flex" id="enfocadoDiv">
                            <p class="font-weight-bold">Producto enfocado para:&nbsp</p>
                            <p id="enfocado">Perros</p>
                        </div>
                        <div class="d-flex" id="stockDiv">
                            <p class="font-weight-bold">Stock:&nbsp</p>
                            <p id="stock">15 unidades</p>
                        </div>
                        <div class="d-flex" id="precioDiv">
                            <p class="font-weight-bold">Precio:&nbsp</p>
                            <p id="precio">$2.000</p>
                        </div>
                        <hr class="mx-0 my-1 p-0"
                            style="border: none;
                        height: 1px;
                        /* Set the hr color */
                        color: #333;  /* old IE */
                        background-color: #333;">
                        <div class="d-block" id="ultimaReposicionDiv">
                            <p class="font-weight-bold">Última Reposición:&nbsp</p>
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col">
                                    <p id="proveedorUlt">ProveedorX</p>
                                </div>
                                <div class="col">
                                    <p id="costoUlt">$2.000</p>
                                </div>
                                <div class="col">
                                    <p id="stockUlt">10 un</p>
                                </div>
                            </div>

                        </div>
                        <div class="d-block" id="proveedorMenorCostoDiv">
                            <p class="font-weight-bold">Proveedor de menor costo:&nbsp</p>
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col">
                                    <p id="proveedorLow">ProveedorX</p>
                                </div>
                                <div class="col">
                                    <p id="costoLow">$2.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <img src="/image/productos/colonia-amarilla.png" class="img-thumbnail" alt="..."
                            id="imagen_item">
                        <div class="d-flex justify-content-center">
                            <img id="barcode"style="width:150px" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
