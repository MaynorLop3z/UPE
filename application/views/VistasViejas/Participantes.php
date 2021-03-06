<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Alumnos</title>

        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!--script para cargar la pagina  -->
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">

            <!-- Trigger the modal with a button,  Me falta centrar los botones el el div-->

            <div class="btn btn-group">
                <button href="#AlumnoNuevo"  class="btn btn-default btn-default" data-toggle="modal">Alumno Nuevo</button>
                <button href="#AlumnoModifica" class="btn btn-default btn-default" data-toggle="modal">Modificar Alumno</button>
                <button href="#AlumnoElimina" class="btn btn-default btn-default" data-toggle="modal">Eliminar Alumno</button>
            </div>
            <?php
                        if ($creacion) {
                            ?>
            <div class="row">
            <div class="col-md-8 alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>Exito!</strong><?= $mensaje ?>
    </div>
                </div>
            <?php
                    }else {
                    ?>
            <div class="row">
            <div class="col-md-8 alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>Error!</strong><?= $mensaje ?>
    </div>
                </div>
            <?php
                    }
                    ?>
            <!-- DIv para la tabla  donde se muestran todos los usuario-->
            <div class="col-lg-9">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Mail</th>
                            <th># Fijo</th>
                            <th># Movil</th>
                            <th>Direccion</th>
                            <th>DUI</th>
                            <th>Nombre</th>
                            <th>Fecha Nac.</th>
                            <th>Universidad</th>
                            <th>Carrera</th>
                            <th>Nivel Acade.</th>
                            <th>Encargado</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Comentarios</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        foreach ($Alumnos as $alum) {
                            ?>
                        <tr id="<?= $alum->CodigoParticipante ?>">
                        <td><?= $alum->CorreoElectronico ?></td>
                        <td><?= $alum->TelefonoFijo ?></td>
                        <td><?= $alum->TelefonoCelular ?></td>
                        <td><?= $alum->Direccion ?></td>
                        <td><?= $alum->NumeroDUI ?></td>
                        <td><?= $alum->Nombre ?></td>
                        <td><?= $alum->FechaNacimiento ?></td>
                        <td><?= $alum->CodigoUniversidadProcedencia ?></td>
                        <td><?= $alum->Carrera ?></td>
                        <td><?= $alum->NivelAcademico ?></td>
                        <td><?= $alum->NombreEncargado ?></td>
                        <td><?= $alum->Descripcion ?></td>
                        <td><?= $alum->CodigoCategoriaParticipantes ?></td>
                        <td><?= $alum->Comentarios ?></td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>  

            </div>
            <div class="col-lg-3"></div>
        </div> 
        <!-- Modal Para el Usuario Nuevo  ------------------------------------------------------------------------------------>
        <div id="AlumnoNuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container-fluid ">
                        <form action="" class="form-horizontal" method="post" >
                            <!--http://localhost/~maynorlop3z/UPE/index.php/Participantes/agregar/-->
                            <fieldset>
                                
                                <legend class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    Agregar Alumno:
                                </legend> 
                                
                                <div class="form-group">
                                    <label for="AlumnoNombre" class="col-lg-3 control-label">Nombre:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="Nombre" id="AlumnoNombre" placeholder="Nombre Alumno" maxlength="100" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="AlumnoMail" class="col-lg-3 control-label">Correo Electronico:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="CorreoElectronico" id="AlumnoMail" placeholder="Correo electronico del alumno" maxlength="100" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="AlumnoFijo" class="col-lg-3 control-label">Telefono Fijo:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="TelefonoFijo" id="AlumnoFijo" placeholder="Telefono Fijo del Alumno" maxlength="9" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoMovil" class="col-lg-3 control-label">Telefono Movil:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="TelefonoCelular" id="AlumnoMovil" placeholder="Telefono Celular del Alumno" maxlength="9" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoDir" class="col-lg-3 control-label">Direccion:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="Direccion" id="AlumnoDir" placeholder="Direccion del Alumno" maxlength="200" required></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoDUI" class="col-lg-3 control-label">DUI:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="NumeroDUI" id="AlumnoSUI" placeholder="Numero de DUI del Alumno" maxlength="10">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="AlumnoFNac" class="col-lg-3 control-label">Fecha Nacimiento:</label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" name="FechaNacimiento" id="AlumnoFNac" placeholder="Fecha de nacimiento del Alumno" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <label for="AlumnoCarrera" class="col-lg-3 control-label">Carrera:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="Carrera" id="AlumnoCarrera" placeholder="Carrera del Alumno" maxlength="100">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                
                                    <div class="form-group">
                                    <label for="AlumnoNivel" class="col-lg-3 control-label">Nivel Academico:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="NivelAcademico" id="AlumnoNivel" placeholder="Nivel academico del Alumno" maxlength="100">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoNEncargado" class="col-lg-3 control-label">Encargado:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="NombreEncargado" id="AlumnoNEncargado" placeholder="Nombre del encargado del Alumno" maxlength="150">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoCategoria" class="col-lg-3 control-label">Categoria:</label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="AlumnoCategoria" name="CodigoCategoriaParticipantes">
                                            <?php
                                            foreach ($CategoriasP as $categ) {
                                            ?>
                                            <option value="<?= $categ->CodigoCategoriaParticipantes ?>">
                                                    <?= $categ->NombreCategoriaParticipante ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoDescripcion" class="col-lg-3 control-label">Descripcion:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="Descripcion" id="AlumnoDescripcion" placeholder="Descripcion del Alumno"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoComentario" class="col-lg-3 control-label">Comentarios:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="Comentarios" id="AlumnoComentario" placeholder="Comentario del Alumno"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                                    <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                                    <button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>
                                </div>
                                
                            </fieldset>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Editar Usuario --------------------------------------------------------------------------------------->
            <div id="alumnoModifica" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="container-fluid ">
                            <form action="Usuariocontroller" class="form-horizontal" method="post" >
                                <fieldset>
                                    <legend class="modal-header">Modificar Usuario:</legend> 
                                    <div class="form-group">
                                        <label for="Usuario" class="col-lg-3 control-label">Usuario</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="Usuariomodificar" placeholder="Nombre Usuario" required>
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
                                        <button type="submit" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                                        <button type="submit" id="btnCerrar" onclick="" class=" btn btn-default" name="Cerrar">Cerrar</button>
                                    </div>

                                </fieldset>
                            </form></div>
                    </div>
                </div>
            </div>
            <!-- Modal para Eliminar Usuario --------------------------------------------------------------------------------------->
            <div id="AlumnoElimina" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="container-fluid ">
                            <form action="UsuarioController" class="form-horizontal" method="post" >
                                <fieldset>
                                    <legend class="modal-header">Usuario:</legend> 
                                    <div class="form-group">
                                        <label for="selectUsuario" class="col-lg-3 control-label">Usuarios</label>
                                        <div class="col-lg-9">

                                            <select class="form-control" id="selectUsuario">
                                                <option>usuario 1</option>
                                                <option>Usuario 2</option>
                                                <option>Usuario 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btnEnviarU" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                                        <button type="submit" id="btnCancelarU" onclick="" class=" btn btn-default" name="Limpiar">Cancelar</button>
                                    </div>

                                </fieldset></div>
                    </div>     </form>
                </div>
            </div>
        </div>

    </body>           
</html>