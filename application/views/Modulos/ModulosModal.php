<?php $this->load->helper('url'); ?>

<!-- Modal para modificar Modulos --------------------------------------------------------------------------------------------------------------------------------------->
<div id="ModificarModulo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarMo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
                <form  id="formEditMod" action="<?php echo base_url()?>index.php/ModulosController/editarModulo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Editar  Modulo:</legend> 
                        <div class="form-group">
                            <label for="nameModuloEdit" class="col-lg-3 control-label">Nombre Del Modulo:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreModulo" id="ModuloNombreEdit" placeholder="Nombre del Modulo" maxlength="300" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ModuloOrdenEdit" class="col-lg-3 control-label">Correlativo</label>
                            <div class="col-lg-9">
                                <input type="number"  min="1" class="onlyNumbers form-control" name="ordenM" id="ModuloOrdenEdit" placeholder="Orden" data-mask="000" required>
                            </div>
                        </div>                     
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Estado</label>
                            <div class="col-lg-9">
                                <input type="checkbox" id="EstadoE"  name="Activo" value="True" > Activo<br>
                            </div>
                        </div>                                                                                       
                        <div class="form-group">
                            <label for="Turno" class="col-lg-3 control-label">Turno:</label>
                            <div class="col-lg-9">
                                <select class ="form-control" id="TurnoEdit" name="Turno" placeholder="Seleecione un Turno" required>                                          
                                    <?php
                                    foreach ($Turno as $TurMo) { //Aqui para seleccionar el Turno a que Pertenece
                                        ?>
                                        <option value="<?= $TurMo->CodigoTurno ?>" >
                                            <?php echo $TurMo->NombreTurno ?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                         <!-- Se quita Diplomados ya que debe ser automatico-->
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Diplomado:</label>
                            <div class="col-lg-9">
                          <select class ="form-control" id="DiplomadonameEdit" name="Diplomadoname">                                          
                                    <?php
                                    foreach ($Diplomados as $DipMo) { //Aqui para seleccionar el Turno a que Pertenece
                                        ?>
                                        <option value="<?= $DipMo->CodigoDiplomado ?>">
                                            <?php echo $DipMo->NombreDiplomado?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>                 
                          <label class="col-lg-3 control-label">Comentario:</label>
                            
                            <div class="col-lg-9">
                                <textarea id="ComentarioModEdit" name="Comentarios"  type="text" class="form-control"  placeholder="Comentario Modulo" maxlength="500" ></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="BtnAddMo" onclick="" class=" btn btn-default" name="Aceptar">Actualizar</button>
                            <button type="reset" id="btncleanMo" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Aqui empieza la modal para eliminar diplomados ----------------------------------------------------------------->
<div id="EliminarModulo"  name="divfinish"  data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form id="frmDelMod" action="<?php echo base_url() ?>index.php/ModulosController/EliminarModulo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Eliminar Modulo:</legend> 
                        <div class="form-group">
                            <div class="col-lg-9">
                                <label>¿Realmente desea eliminar el modulo <mark id="nombreModuloDel"></mark>?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarMo" onclick="" class=" btn btn-default" name="Eliminar">Eliminar</button>
              <!--              <button type="button" id="btnLimpiarMo" onclick="" class="btn btn-default" name="Cancelar">Cancelar</button> -->
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>
<!--Modulos no definidos---------------------------------------------------------------------------------------------------------------------------------------->
<div id="ModInd" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
                <label style="center">El modulo no esta  definido</label>
            </div>
        </div>
    </div>
</div>
<!-- Div para  indicas que un modulo se ha  guardado correctamente -->
<div id="Modcorrecto" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
                <label style="center">Modulo ingresado corectamente</label>
            </div>
        </div>
    </div>
</div>