<? $this->load->helper('url'); ?>
<!------Modal para el boton Agregar Modulos----------------------------------------------------------------------------------->
<div id="ModuloNuevo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarMo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form  id="formgrdMo" action="<?php echo base_url()?>index.php/DiplomadosController/guardarDiplomado/" class="form-horizontal" method="post" >
                     <fieldset>
                        <legend class="modal-header">Nuevo Modulo:</legend> 
                        <div class="form-group">
                            <label for="nameModulo" class="col-lg-3 control-label">Nombre Del Modulo</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreModulo" id="ModuloNombre" placeholder="Nombre del Modulo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ModuloDescripcion" class="col-lg-3 control-label">Descripcion</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="Descripcion" id="ModuloDescripcion" placeholder="Descripcion del Modulo" required></textarea>
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
                            <label for="CatgoriaDiplomado" class="col-lg-3 control-label">Clomadoategoria Diplomado:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="CatgoriaDiplomado" name="CodigoCategoriaDiplomado">                                          
                                    <?php
                                    foreach ($CategoriasDi as $cadi){ //AQui para seleccionar  la categoria del diplomado al que pertenece
                                    ?>
                                    <option value="<?= $cadi->CodigoCategoriaDiplomado ?>">
                                    <?php echo $cadi->NombreCategoriaDiplomado ?> <!-- Para imprimir los datos en el select-->
                                    </option>
                                       <?php
                                    } ?>
                                    
                                </select>
                            </div>
                       </div>
                       <div class="form-group">
                            <label for="ComentarioDiplomado" class="col-lg-3 control-label">Comentarios</label>
                            <div class="col-lg-9">
                                <textarea id="ComentarioDiplomado" name="Comentarios"  type="text" class="form-control"  placeholder="Descripcion del Diplomado" required></textarea>
                            </div>
                       </div>
                        
                        <div class="modal-footer">
                            <button type="submit" id="BtnAddDi" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
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
                 <form  id="formeditDiplomado" action="<?php echo base_url()?>index.php/DiplomadosController/editarDiplomado/" class="form-horizontal" method="post" >
                     <fieldset>
                         
                        <legend class="modal-header">Editar Diplomado:</legend> 
                     
                        <div class="form-group">
                            <label for="DiplomadoNombreEdit" class="col-lg-3 control-label">Nombre Del Diplomado</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreDiplomado" id="DiplomadoNombreEdit" placeholder="Nombre del Diplomado" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DiplomadoDescripcionEdit" class="col-lg-3 control-label">Descripcion</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="Descripcion" id="DiplomadoDescripcionEdit" placeholder="Descripcion del Diplomado" required></textarea>
                            </div>
                       </div>
                       <div class="form-group">
                           <label class="col-lg-3 control-label">Estado</label>
                           <div class="col-lg-9">
                               <div class="radioedit" name="" id="radioedit">
                                   <label>
                                       <input type="radio" name="estado" id="optionsActivoEdit" value="opcion1" >
                                       Activo
                                   </label>
                               </div>
                             <div class="radio">
                                   <label>
                                       <input type="radio" name="estado" id="optionsInactivoEdit" value="opcion2">
                                       Inactivo
                                   </label>
                               </div> 
                           </div>
                       </div>                                                                                       
                        
                        <div class="form-group">
                            <label for="CatgoriaDiplomadoEdit" class="col-lg-3 control-label">Categoria Diplomado:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="CatgoriaDiplomadoEdit" name="CodigoCategoriaDiplomado">                                          
                                    <?php
                                    foreach ($CategoriasDi as $cadi){ //AQui para seleccionar  la categoria del diplomado al que pertenece
                                    ?>
                                    <option value="<?= $cadi->CodigoCategoriaDiplomado ?>">
                                    <?php echo $cadi->NombreCategoriaDiplomado ?> <!-- Para imprimir los datos en el select-->
                                    </option>
                                       <?php
                                    } ?> 
                                    
                                </select>
                            </div>
                       </div>
                       <div class="form-group">
                            <label for="ComentarioDiplomadoEdit" class="col-lg-3 control-label">Comentarios</label>
                            <div class="col-lg-9">
                                <textarea id="ComentarioDiplomadoEdit" name="Comentarios"  type="text" class="form-control"  placeholder="Descripcion del Diplomado" required></textarea>
                            </div>
                       </div>
                        
                        <div class="modal-footer">
                            <button type="submit" id="BtneditDi" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="reset" id="btncleaneditDi" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                           
                        </div>
                        
                      </fieldset>
                 </form>
            </div>
        </div>
    </div>
    </div>
<!-- Eliminar DIplomado----->
<div id="EliminarDiplomado" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form id="frmDELdip" action="<?php echo base_url() ?>index.php/DiplomadosController/EliminarDiplomado/" class="form-horizontal" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Diplomados:</legend> 
                        <div class="form-group">
                            <div class="col-lg-9">
                                <label>¿Realmente desea eliminar el Diplomado <mark id="markeliminar"></mark>?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarDipD" onclick="" class=" btn btn-default" name="Eliminar">Eliminar</button>
                            <button type="button"  onclick="" class=" btn btn-default" name="Cancelar">Cancelar</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>