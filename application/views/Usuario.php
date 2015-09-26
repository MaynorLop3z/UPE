<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Usuarios.js"></script>
<!--script para cargar la pagina  -->

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Usuarios</h3>
    </div>
    <div class="panel-body">
        <!-- Trigger the modal with a button,  Me falta centrar los botones el el div-->
        <div id="mensajes">

        </div>
        <div   class="well">

            <button id="btnUsuarioNuevo" class="btn btn-default" ><span class="glyphicon glyphicon-plus"></span>Usuario Nuevo</button>
        </div>
        <!-- DIv para la tabla  donde se muestran todos los usuario-->
        <div id="divp">
            <table id="tableUsers" class="table table-bordered table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Gestionar</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    foreach ($Usuarios as $user) {
                        ?>
                        <tr id="tr<?php echo $user->CodigoUsuario ?>">
                            <td class="nombre_Usuario" ><?= $user->Nombre ?></td>
                            <td class="correo_Usuario" ><?= $user->CorreoUsuario ?></td>
                            <td class="nickName_Usuario" ><?= $user->NombreUsuario ?></td>
                            <td class="gestion_User">
                                <button id="<?php echo $user->CodigoUsuario ?>"  title="Editar Usuario" class="btn_modificar_user btn btn-success "  class=" btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>
                                <button data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-trash"></span></button></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>   
        </div>
    </div>
</div>




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
<div id="usuarioElimina" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

