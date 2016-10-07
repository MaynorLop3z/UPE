<?php $this->load->helper('url'); ?>

<!------Modal para Agregar Aulas--------->
<div id="ModalAulaNueva" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarNuevaAula"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form  id="formAgregarAula" action="<?php echo base_url() ?>index.php/AulasController/agregarAula/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Nueva Aula:</legend> 
                        <div class="form-group">
                            <label for="AulaNombre" class="col-lg-3 control-label">Nombre del Aula</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="AulaNombre" id="AulaNombre" placeholder="Nombre del Aula" maxlength="50" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="AulaDescripcion" class="col-lg-3 control-label">Descripcion</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="AulaDescripcion" id="AulaDescripcion" placeholder="Descripcion del Aula" maxlength="150" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tipo</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="TipoAula"  name="TipoAula" placeholder="Tipo de aula" maxlength="150" >
                            </div>
                        </div> 

                        
                        <div class="modal-footer">
                            <button type="submit" id="btnAgregarAula" onclick="" class=" btn btn-default" name="Aceptar">Guardar</button>
                            <button type="reset" id="btnResetAgregarAula" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<!------Modal para Modificar Aulas--------->
<div id="ModalAulaModificar" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModificarAula"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form  id="formModificarAula" action="<?php echo base_url() ?>index.php/AulasController/modificarAula/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Modificar Aula:</legend> 
                        <div class="form-group">
                            <label for="AulaNombreModificar" class="col-lg-3 control-label">Nombre del Aula</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="AulaNombreModificar" id="AulaNombreModificar" placeholder="Nombre del Aula" maxlength="50" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="AulaDescripcionModificar" class="col-lg-3 control-label">Descripcion</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="AulaDescripcionModificar" id="AulaDescripcionModificar" placeholder="Descripcion del Aula" maxlength="150" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tipo</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="TipoAulaModificar"  name="TipoAulaModificar" placeholder="Tipo de aula" maxlength="150" >
                            </div>
                        </div> 
                        <input type="hidden" id="idAulaModificar" val="">
                        
                        <div class="modal-footer">
                            <button type="submit" id="btnModificarAula" onclick="" class=" btn btn-default" name="Aceptar">Guardar</button>
                            <button type="reset" id="btnResetModificarAula" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Eliminar Aula----->
<div id="ModalEliminarAula" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                <form id="frmEliminarAula" action="<?php echo base_url() ?>index.php/AulasController/eliminarAula/" class="form-horizontal" class="form-horizontal" method="post" >
                    <legend class="modal-header">Aula:</legend> 
                    <div class="form-group">
                        <div class="col-lg-9">
                            <label>¿Realmente desea eliminar el Aula<mark id="nombreAulaDel">?</mark></label>
                        </div>
                    </div>
                    <input type="hidden" id="idAulaEliminar" val="">
                    <div class="modal-footer">
                        <button type="submit" id="btnConfirmarEliminarAula" onclick="" class=" btn btn-default" name="Eliminar">Eliminar</button>
                    </div>
                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>