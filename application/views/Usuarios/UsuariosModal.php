<?php $this->load->helper('url'); ?>
<!-- Modal Para el Usuario Nuevo  ------------------------------------------------------------------------------------>
<div id="usuarioNuevo" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" id="btnCerrarModalNewUser" data-dismiss="modal" aria-hidden="true">X</button>
                <form id="frmGuardarUSer" action="<?php echo base_url() ?>index.php/UsuarioController/guardarUsuario/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Agregar Usuario:</legend> 
                        <div class="form-group">
                            <label for="Usuario" class="col-lg-3 control-label">Usuario</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="UsuarioNombre" placeholder="Nombre Usuario" required>
                            </div>
                            <div class="col-lg-3">
                                <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email" name="" class="col-lg-3 control-label">E-mail</label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control" name="UsuarioEmail" placeholder="Correo Electronico" required>
                            </div>
                            <div class="col-lg-3">
                                <label id="emR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="col-lg-3 control-label">Contraseña</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="UsuarioPassword" placeholder="Contraseña"  required>
                            </div>
                            <div class="col-lg-3">
                                <label id="paR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password2" class="col-lg-3 control-label">Confirmar Contraseña</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="UsuarioPassword2" placeholder="Repita Contraseña" required>
                            </div>
                            <div class="col-lg-3">
                                <label id="prR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="btnEnviar" value="Guardar" class=" btn btn-default" name="Aceptar"/>
                            <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default"  name="Limpiar">Limpiar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Usuario --------------------------------------------------------------------------------------->
<div id="usuarioModifica" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form action="<?php echo base_url() ?>index.php/UsuarioController/editarUsuario/"  class="form-horizontal" method="post" >
                    <fieldset>
                        <label id="lblCodigoUser" ></label>
                        <legend class="modal-header">Modificar Usuario:</legend>
                        <div class="form-group">
                            <label for="Usuario" class="col-lg-3 control-label">Usuario</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="txtUserModificar"  placeholder="Nombre de la persona" required>
                            </div>
                            <div class="col-lg-3">
                                <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email" class="col-lg-3 control-label">E-mail</label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control" id="Emailmodificar" placeholder="Correo Electronico" required>
                            </div>
                            <div class="col-lg-3">
                                <label id="emR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="col-lg-3 control-label">Contraseña</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="Passwordmodificar" placeholder="Contraseña"  required>
                            </div>
                            <div class="col-lg-3">
                                <label id="paR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password2" class="col-lg-3 control-label">Confirmar Contraseña</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="Password2modificar" placeholder="Repita Contraseña" required>
                            </div>
                            <div class="col-lg-3">
                                <label id="prR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Guardar</button>
                            <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                        </div>
                    </fieldset>
                </form></div>
        </div>
    </div>
</div>
<!-- Modal para Eliminar Usuario --------------------------------------------------------------------------------------->
<div id="usuarioElimina" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form action="UsuarioController" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Usuario:</legend> 
                        <div class="form-group">
                            <div class="col-lg-9">
                                <label>¿Realmente desea eliminar al usuario seleccionado?</label>
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