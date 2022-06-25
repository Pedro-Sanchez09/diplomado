<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlTitulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formProducto">
                <div class="modal-body">
                    <span id="mensaje"></span>


                    <div class="form-group ">
                        <label for="id" class="col-form-label">Id:</label>
                        <input type="number" class="form-control" id="id" name="id" required>
                        <span id="id-producto"></span>


                    </div>



                    <div class="form-group">
                        <label for="descripcion" class="col-form-label">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion" rows="2" class="form-control" placeholder="Escriba la descripcion del producto" required></textarea>

                    </div>




                    <div class="form-group">
                        <label for="precio" class="col-form-label ">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio" required>
                        <span id="precioS"></span>

                    </div>






                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
            </form>
        </div>
    </div>
</div>