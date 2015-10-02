<!------Modal para el boton Asignar Rol----------------------------------------------------------------------------------->
<div id="modificarRol" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <form action="RolesController" class="form-horizontal" method="post" >
                    <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                    <fieldset>
                        <legend class="modal-header">Asignar Rol:</legend> 
                        <div class="form-group">
                            <label for="selectUsuario" class="col-lg-3 control-label">Usuarios</label>
                            <div class="col-lg-9">

                                <select class="form-control" id="selectRol">
                                    <option>usuario 1</option>
                                    <option>Usuario 2</option>
                                    <option>Usuario 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="selectRol" class="col-lg-3 control-label">Rol</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="selectRol">
                                    <option>Secretaria Ingles</option>
                                    <option>Horas sociales</option>
                                    <option>Coordinador</option>
                                    <option>Docente</option>
                                    <option>Secretaria Diplomados</option>
                                    <option>Coordinadora de Ingles</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarR" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="submit" id="btnCancelarR" onclick="" class=" btn btn-default" name="Limpiar">Cancelar</button>
                        </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <!-- Quitar Rol-------------------------------------------------------------------------------------------->
