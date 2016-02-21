<?php $this->load->helper('url'); ?>
<!------Modal para el boton Agregar Modulos----------------------------------------------------------------------------------->
<div id="NuevoModulo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarMo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
                <form  id="formgrdMo" action="<?php echo base_url() ?>index.php/ModulosController/guardarModulo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Nuevo Modulo:</legend> 
                        <div class="form-group">
                            <label for="nameModulo" class="col-lg-3 control-label">Nombre Del Modulo:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreModulo" id="ModuloNombre" placeholder="Nombre del Modulo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ModuloOrden" class="col-lg-3 control-label">Orden</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="ordenM" id="ModuloOrden" placeholder="Orden" required></textarea>
                            </div>
                        </div>                     
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Estado</label>
                            <div class="col-lg-9">
                                <input type="checkbox" id="Estado"  name="Activo" value="True" checked> Activo<br>
                            </div>
                        </div>                                                                                       

                        <div class="form-group">
                            <label for="Turno" class="col-lg-3 control-label">Turno:</label>
                            <div class="col-lg-9">
                                <select class ="form-control" id="Turno" name="Turno">                                          
                                    <?php
                                    foreach ($Turno as $TurMo) { //Aqui para seleccionar el Turno a que Pertenece
                                        ?>
                                        <option value="<?= $TurMo->CodigoTurno ?>">
                                            <?php echo $TurMo->NombreTurno ?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                         <!-- Se quita Diplomados ya que debe ser automatico-->
                          <select class ="form-control" id="Diplomadoname" name="Diplomadoname">                                          
                                    <?php
                                    foreach ($Diplomados as $DipMo) { //Aqui para seleccionar el Turno a que Pertenece
                                        ?>
                                        <option value="<?= $DipMo->CodigoDiplomado ?>">
                                            <?php echo $DipMo->NombreDiplomado?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                         
                         
                         
                         
                         
                         
                        <div class="form-group">
                            <label for="ComentarioDiplomado" class="col-lg-3 control-label">Comentarios:</label>
                            <div class="col-lg-9">
                                <textarea id="ComentarioMod" name="Comentarios"  type="text" class="form-control"  placeholder="Comentario Modulo" required></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="BtnAddMo" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="reset" id="btncleanMo" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para modificar Diplomados --------------------------------------------------------------------------------------------------------------------------------------->
<div id="ModificarModulo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarMo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
                <form  id="formgrdMo" action="<?php echo base_url() ?>index.php/ModulosController/guardarModulo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Nuevo Modulo:</legend> 
                        <div class="form-group">
                            <label for="nameModulo" class="col-lg-3 control-label">Nombre Del Modulo:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreEditModulo" id="ModuloEditNombre" placeholder="Nombre del Modulo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ModuloOrden" class="col-lg-3 control-label">Orden</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="ordenM" id="ModuloOrden" placeholder="DerdenMscripcion del Modulo" required></textarea>
                            </div>
                        </div>                     
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Estado</label>
                            <div class="col-lg-9">
                                <input type="checkbox" id="Estado"  name="Activo" value="True" checked> Activo<br>
                            </div>
                        </div>                                                                                       

                        <div class="form-group">
                            <label for="Turno" class="col-lg-3 control-label">Turno:</label>
                            <div class="col-lg-9">
                                <select class ="form-control" id="Turno" name="Turno">                                          
                                    <?php
                                    foreach ($Turno as $TurMo) { //Aqui para seleccionar el Turno a que Pertenece
                                        ?>
                                        <option value="<?= $TurMo->CodigoTurno ?>">
                                            <?php echo $TurMo->NombreTurno ?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                         <!-- Se quita Diplomados ya que debe ser automatico-->
                        <div class="form-group">
                            <label for="ComentarioDiplomado" class="col-lg-3 control-label">Comentarios:</label>
                            <div class="col-lg-9">
                                <textarea id="ComentarioMod" name="Comentarios"  type="text" class="form-control"  placeholder="Comentario Modulo" required></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="BtnAddMo" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="reset" id="btncleanMo" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Aqui empieza la modal para eliminar diplomados ----------------------------------------------------------------->
<div id="EliminarModulo" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form id="frmDelMod" action="<?php echo base_url() ?>index.php/ModuloController/eliminarModulo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Modulo:</legend> 
                        <div class="form-group">
                            <div class="col-lg-9">
                                <label>¿Realmente desea eliminar el modulo <mark id="nombreModuloDel"></mark>?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarMo" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="reset" id="btnLimpiarMo" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>

