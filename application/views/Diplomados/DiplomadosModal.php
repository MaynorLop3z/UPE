<?php $this->load->helper('url'); ?>
<!------Modal para el boton Agregar Diplomados----------------------------------------------------------------------------------->
<div id="DiplomadoNuevo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <form  id="formgrdDiplomado" action="<?php echo base_url()?>index.php/DiplomadosController/guardarDiplomado/" class="form-horizontal" method="post" >
                    <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                    <fieldset>
                        <legend class="modal-header">Nuevo Diplomado:</legend> 
                        <div class="form-group">
                            <label for="DiplomadoNombre" class="col-lg-3 control-label">Nombre Del Diplomado</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="NombreDiplomado" id="DiplomadoNombre" placeholder="Nombre del Diplomado" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DiplomadoDescripcion" class="col-lg-3 control-label">Descripcion</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="Descripcion" id="DiplomadoDescripcion" placeholder="Descripcion del Diplomado" required></textarea>
                            </div>
                       </div>
                       <div class="form-group">
                           <label class="col-lg-3 control-label">Estado</label>
                           <div class="col-lg-9">
                               <div class="radio" name="" id="radio">
                                   <label>
                                       <input type="radio" name="Opcion1" id="optionsRadios1" value="opcion1" checked="">
                                       Activo
                                   </label>
                               </div>
                               <div class="radio">
                                   <label>
                                       <input type="radio" name="Opcion2" id="optionsRadios2" value="opcion2">
                                       Inactivo
                                   </label>
                               </div>
                           </div>
                       </div>
                        <div class="form-group">
                            <label for="CategoriaDiplomado" class="col-lg-3 control-label">Categoria Diplomado:</label>
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
    <!-- Modal paa modificar Diplomados-------------------------------------------------------------------------------------------->
    <div id="ModificarDiplomado" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <form action="DiplomadosController" class="form-horizontal" method="post" >
                    <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                    <fieldset>
                        
                        <legend class="modal-header">Editar Diplomado:</legend> 
                        <div class="form-group">
                            <label for="DiplomadoNombre" class="col-lg-3 control-label">Nombre Del Diplomado</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="DiplomadoNombre" placeholder="Nombre del Diplomado" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CoordinadorDiplomado" class="col-lg-3 control-label">Coordinador</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="CoordinadorDiplomado">
                                    <option>Nombre 1</option>
                                    <option>Nombre 2</option>
                                    <option>Nombre 3</option>
                                    <option>Nombre 4</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="InicioDiplomado" class="col-lg-3 control-label">Fecha de Inicio:</label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control" id="InicioDiplomado" placeholder="Inicio del Diplomado"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FinDiplomado" class="col-lg-3 control-label">Fecha Fin:</label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control" id="FinDiplomado" placeholder="Fin del Diplomado" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="submit" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                            <button type="submit" id="btnCerrar" onclick="" class=" btn btn-default" name="Cerrar">Cerrar</button>
                        </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<!-- Eliminar DIplomado----->
<div id="EliminarDiplomado" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form action="UsuarioController" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Diplomados:</legend> 
                        <div class="form-group">
                            <div class="col-lg-9">
                                <label>¿Realmente desea eliminar el Diplomado seleccionado?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarU" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>