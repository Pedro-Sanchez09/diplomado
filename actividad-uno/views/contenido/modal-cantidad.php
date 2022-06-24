<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlTitulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formCantidad">
                <div class="modal-body">
                    <span id="mensaje"></span>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="cantidad" class="col-form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="1">


                            </div>
                        </div>

                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>