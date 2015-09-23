<!------Modal para el boton Agregar Diplomados----------------------------------------------------------------------------------->
<div id="DiplomadoNuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <form action="DiplomadosController" class="form-horizontal" method="post" >
                    <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                    <fieldset>
                        
                        <legend class="modal-header">Nuevo Diplomado:</legend> 
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


    <!-- Modal paa modificar Diplomados-------------------------------------------------------------------------------------------->
    <div id="ModificarDiplomado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<div id="EliminarDiplomado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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