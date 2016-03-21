<?php $this->load->helper('url'); ?>
<div id="usuarioElimina" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form id="frmEliminarUser" action="<?php echo base_url() ?>index.php/RolesController/eliminarRol/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Usuario:</legend> 
                        <div class="form-group">
                            <div class="col-lg-9">
                                <label>¿Realmente desea eliminar el rol <mark id="nombreRolEliminar"></mark>?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarR" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="reset" id="btnCancelarR" onclick="" class=" btn btn-default" name="Limpiar">Cancelar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>