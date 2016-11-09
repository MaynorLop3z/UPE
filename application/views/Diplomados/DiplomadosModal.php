<?php $this->load->helper('url'); ?>

<!------Modal para el boton Agregar Diplomados----------------------------------------------------------------------------------->
<div id="DiplomadoNuevo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarDi"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form  id="formgrdDiplomado" action="<?php echo base_url() ?>index.php/DiplomadosController/guardarDiplomado/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Nuevo Diplomado:</legend> 
                        <div class="form-group">
                            <label for="DiplomadoNombre" class="col-lg-3 control-label">Nombre Del Diplomado</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreDiplomado" id="DiplomadoNombre" placeholder="Nombre del Diplomado" maxlength="300" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DiplomadoDescripcion" class="col-lg-3 control-label">Descripcion</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="Descripcion" id="DiplomadoDescripcion" placeholder="Descripcion del Diplomado" maxlength="500" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Estado</label>
                            <div class="col-lg-9">
                                <input type="checkbox" id="Estado"  name="Activo" value="True" checked> Activo<br>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="CatgoriaDiplomado" class="col-lg-3 control-label">Categoria Diplomado:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="CatgoriaDiplomado" name="CodigoCategoriaDiplomado"  >                                          
                                    
                                 <?php
                                    foreach ($CategoriasDi as $cadi) { //AQui para seleccionar  la categoria del diplomado al que pertenece
                                        ?>
                                        <option value="<?= $cadi->CodigoCategoriaDiplomado ?>">
                                            <?php echo $cadi->NombreCategoriaDiplomado ?> <!-- Para imprimir los datos en el select-->
                                        </option>
                                        <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ComentarioDiplomado" class="col-lg-3 control-label">Comentarios</label>
                            <div class="col-lg-9">
                                <textarea id="ComentarioDiplomado" name="Comentarios"  type="text" class="form-control"  placeholder="Descripcion del Diplomado" maxlength="500" ></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="BtnAddDi" onclick="" class=" btn btn-default" name="Aceptar">Guardar</button>
                            <button type="reset" id="btncleanDi" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal paa modificar Diplomados --------------------------------------------------------------------------------------------------------------------------------------->
<div id="ModificarDiplomado" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarDi"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form  id="formeditDiplomado" action="<?php echo base_url() ?>index.php/DiplomadosController/editarDiplomado/" class="form-horizontal" method="post" >
                    <fieldset>

                        <legend class="modal-header">Editar Diplomado:</legend> 

                        <div class="form-group">
                            <label for="DiplomadoNombreEdit" class="col-lg-3 control-label">Nombre Del Diplomado</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreDiplomado" id="DiplomadoNombreEdit" placeholder="Nombre del Diplomado" maxlength="300" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DiplomadoDescripcionEdit" class="col-lg-3 control-label">Descripcion</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="Descripcion" id="DiplomadoDescripcionEdit" placeholder="Descripcion del Diplomado" maxlength="500" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Estado</label>
                            <div class="col-lg-9">
                                <input type="checkbox" id="EstadoEdit"  name="Activo" value="True" checked> Activo<br>
                            </div>
                        </div>                                                                              

                        <div class="form-group">
                            <label for="CategoriaDiplomadoEdit" class="col-lg-3 control-label">Categoria Diplomado:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="CategoriaDiplomadoEdit" name="CodigoCategoriaDiplomado" required>                                          
                                    <?php
                                    foreach ($CategoriasDi as $cadi) { //AQui para seleccionar  la categoria del diplomado al que pertenece
                                        ?>
                                        <option value="<?= $cadi->CodigoCategoriaDiplomado ?>">
                                            <?= $cadi->NombreCategoriaDiplomado ?> <!-- Para imprimir los datos en el select-->
                                        </option>
                                    <?php }
                                    ?> 

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ComentarioDiplomadoEdit" class="col-lg-3 control-label">Comentarios</label>
                            <div class="col-lg-9">
                                <textarea id="ComentarioDiplomadoEdit" name="Comentarios"  type="text" class="form-control"  placeholder="Descripcion del Diplomado" maxlength="500" ></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="BtneditDi" onclick="" class=" btn btn-default" name="Aceptar">Actualizar</button>
                            <button type="reset" id="btncleaneditDi" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Eliminar Diplomado----->
<div id="EliminarDiplomado" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                <form id="frmDELdip" action="<?php echo base_url() ?>index.php/DiplomadosController/EliminarDiplomado/" class="form-horizontal" class="form-horizontal" method="post" >
                    <legend class="modal-header">Diplomado:</legend> 
                    <div class="form-group">
                        <div class="col-lg-9">
                            <label>¿Realmente desea eliminar el Diplomado <mark id="nombreDipDel">?</mark></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnEnviarDip" onclick="" class=" btn btn-default" name="Eliminar">Eliminar</button>
                        <!-- <button type="reset" id="btnLimpiarDip" onclick="" class=" btn btn-default" name="Limpiar">Cancelar</button> -->
                    </div>
                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>
<!--Modulos no definidos---------------------------------------------------------------------------------------------------------------------------------------->
<div id="DipInd" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <label style="center">El Diplomado no esta Definido</label>
            </div>
        </div>
    </div>
</div>


<!---Cuando  el diplomado no tenga Modulos------------------------------------------------------->
<div id="NocontainsM" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <label style="center">No hay modulos agregados al Diplomados</label>
            </div>
        </div>
    </div>
</div>

<!----Vista de  modulos por  diplomado    ------------------------------------------------------------------------------------------------------------>
<div id="ModuloView" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y:scroll;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content ">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarMo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <form id="ModDip" action="<?php echo base_url() ?>index.php/DiplomadosController/listarModulosByDiplomado/" class="form-horizontal" class="form-horizontal" method="post" >
                    <legend>Modulos Por Diplomado</legend>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="col-lg-6"><label>Diplomado:</label></div>
                            <div class="col-lg-6"><h5><mark id="DipViewMod" ></mark></h5></div>
                        </div>
                    </div>
                </form> 
                <div class="row">
                    <div class="col-md-12">
                        <table id="tableMoVi" class="table table-bordered table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Correlativo</th>
                                    <th>Modulo</th>
                                    <th>Comentario</th>
                                </tr>
                            </thead> 
                            <tbody id="bdModulosDip">                    
                            </tbody>

                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
</div>
</div>

<!--agregar modulos---------------------------------------------------------------------------------------------------------------------------------->
<div id="NuevoModuloDip" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" name="NombreModulo" id="ModuloNombre" placeholder="Nombre del Modulo" maxlength="300" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ModuloOrden" class="col-lg-3 control-label">Correlativo</label>
                            <div class="col-lg-9">
                                <input   type="number" min="1" class="onlyNumbers form-control" name="ordenM" id="ModuloOrden" placeholder="Orden" data-mask="000" required>
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
                            <label class="col-lg-3 control-label">Codigo del Diplomado:</label>

                            <div class="col-lg-9">
                                <input id="modDiplomadohidde" type= "hidden" name="CodigoDiplomado" value=""/><mark id="prueba"></mark >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ComentarioDiplomado" class="col-lg-3 control-label">Comentarios:</label>
                            <div class="col-lg-9">
                                <textarea id="ComentarioMod" name="Comentarios"  type="text" class="form-control"  placeholder="Comentario Modulo" maxlength="500" ></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="BtnAddMo" onclick="" class=" btn btn-default" name="Aceptar">Guardar</button>
                            <button type="reset" id="btncleanMo" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>




