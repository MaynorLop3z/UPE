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
                                <textarea type="text" class="form-control" name="ordenM" id="ModuloOrden" placeholder="DerdenMscripcion del Modulo" required></textarea>
                            </div>
                        </div>                     
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Estado</label>
                            <div class="col-lg-9">
                                <div class="radio" name="radio" id="radio">
                                    <label>
                                        <input type="radio" name="estado" id="optionsActivo" value="activo" >
                                        Activo
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="estado" id="optionsInactivo" value="inactivo">
                                        Inactivo
                                    </label>
                                </div> 
                            </div>
                        </div>                                                                                       

                        <div class="form-group">
                            <label for="Turno" class="col-lg-3 control-label">Turno:</label>
                            <div class="col-lg-9">
                                <select class ="form-control" id="Turno" name="Turno">                                          
                                    <?php
                                    foreach ($Turno as $TurMo) { //AQui para seleccionar el diplomado al que pertenece
                                        ?>
                                        <option value="<?= $TurMo->CodigoTurno ?>">
                                            <?php echo $TurMo->NombreTurno ?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="NombreDiplomado" class="col-lg-3 control-label">Diplomado:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="NombreDiplomado" name="NameDiplomNombreDiplomadoado">                                          
                                    <?php
                                    foreach ($ModulosDip as $Modi) { //AQui para seleccionar el diplomado al que pertenece
                                        ?>
                                        <option value="<?= $Modi->CodigoDiplomado ?>">
                                            <?php echo $Modi->NombreDiplomado ?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
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
                                <input type="text" class="form-control" name="NombreModulo" id="ModuloNombre" placeholder="Nombre del Modulo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ModuloOrden" class="col-lg-3 control-label">Orden</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="Descripcion" id="ModuloOrden" placeholder="Descripcion del Modulo" required></textarea>
                            </div>
                        </div>                     
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Estado</label>
                            <div class="col-lg-9">
                                <div class="radio" name="" id="radio">
                                    <label>
                                        <input type="radio" name="estado" id="optionsActivo" value="activo" >
                                        Activo
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="estado" id="optionsInactivo" value="inactivo">
                                        Inactivo
                                    </label>
                                </div> 
                            </div>
                        </div>                                                                                       

                        <div class="form-group">
                            <label for="Turno" class="col-lg-3 control-label">Turno:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="Turno" name="Turno">                                          
                                    <?php
                                    foreach ($Turno as $TurMo) { //AQui para seleccionar el diplomado al que pertenece
                                        ?>
                                        <option value="<?= $TurMo->CodigoTurno ?>">
                                            <?php echo $TurMo->NombreTurno ?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="NombreDiplomado" class="col-lg-3 control-label">Diplomado:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="NombreDiplomado" name="NameDiplomado">                                          
                                    <?php
                                    foreach ($ModulosDip as $Modi) { //AQui para seleccionar el diplomado al que pertenece
                                        ?>
                                        <option value="<?= $Modi->CodigoDiplomado ?>">
                                            <?php echo $Modi->NombreDiplomado ?> <!-- Para imprimir El nombre en el select-->
                                        </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
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

