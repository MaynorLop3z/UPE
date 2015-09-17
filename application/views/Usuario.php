<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->helper('url'); ?>
        <meta charset="UTF-8">
        <title>Usuario Usuario</title>

        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!--script para cargar la pagina  -->
        <!--<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
    </head>
    <body>
        <div class="container">

            <!-- Trigger the modal with a button,  Me falta centrar los botones el el div-->

            <div class="btn btn-group">
                <button href="#usuarioNuevo"  class="btn btn-default btn-default" data-toggle="modal">Usuario Nuevo</button>
                <button href="#usuarioModifica" class="btn btn-default btn-default" data-toggle="modal">Modificar Usuario</button>
                <button href="#usuarioElimina" class="btn btn-default btn-default" data-toggle="modal">Eliminar Usuario</button>
            </div>
            <!-- DIv para la tabla  donde se muestran todos los usuario-->
            <div class="col-lg-9">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Gestionarm</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        static $codigoUsuario = 1;
                        foreach ($Usuarios as $user) {
                            ?>
                            <tr id="tr<?php echo $user->CodigoUsuario ?>">
                                <td class="nombre_Usuario" ><?= $user->Nombre ?></td>
                                <td class="correo_Usuario" ><?= $user->CorreoUsuario ?></td>
                                <td class="nickName_Usuario" ><?= $user->NombreUsuario ?></td>
                                <td><a id="<?php echo $user->CodigoUsuario ?>" data-toggle="modal" title="Editar Usuario" class="btn btn-success" href="#usuarioModifica" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </a>

                                    <a data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-remove"></span></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>   
            </div>
            <div class="col-lg-3"></div>
        </div>  </a>

    <!-- Modal Para el Usuario Nuevo  ------------------------------------------------------------------------------------>
    <div id="usuarioNuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container-fluid ">
                    <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">X</button>

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
                                <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                            </div>

                        </fieldset>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal para Editar Usuario --------------------------------------------------------------------------------------->
    <div id="usuarioModifica" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <script type="text/javascript">

                    var codigoUsuario;
                    $('#usuarioModifica').on('show.bs.modal', function (event) {
                        codigoUsuario = (event.relatedTarget.id);
                        var tr = $('#tr' + codigoUsuario);
                        var nombre_Usuario = tr.find('.nombre_Usuario').html().toString().trim();
                        var correo_Usuario = tr.find('.correo_Usuario').html().toString().trim();
                        var correo_Usuario = tr.find('.correo_Usuario').html().toString().trim();

                        $('#lblCodigoUser').html(codigoUsuario);
                        $('#txtUserModificar').val(nombre_Usuario);
                        $('#Emailmodificar').val(correo_Usuario);
                        $('#Passwordmodificar').val(correo_Usuario);
                    });

                    $("#frmGuardarUSer").submit(function (event) {

                        // Stop form from submitting normally
                        event.preventDefault();

                        // Get some values from elements on the page:
                        var $form = $(this),
                                UsuarioNombre = $form.find("input[name='UsuarioNombre']").val(),
                                UsuarioPassword = $form.find("input[name='UsuarioPassword']").val(),
                                UsuarioEmail = $form.find("input[name='UsuarioEmail']").val(),
                              
                                url = $form.attr("action");

                        // Send the data using post
                        var posting = $.post(url, {UsuarioNombre: UsuarioNombre,UsuarioPassword:UsuarioPassword,UsuarioEmail:UsuarioEmail, });

                        // Put the results in a div
                        posting.done(function (data) {
//                            var content = $(data).find("#content");
//                            $("#result").empty().append(content);
                            alert("agregado");

                        });
                    });


                </script>


                <div class="container-fluid ">
                    <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                    <form action="Usuariocontroller"  class="form-horizontal" method="post" >
                        <fieldset>
                            <label id="lblCodigoUser" hidden="true"></label>

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
                                <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
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
</div>

</body>           
</html>
