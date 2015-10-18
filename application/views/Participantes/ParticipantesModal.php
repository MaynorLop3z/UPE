<?php $this->load->helper('url'); ?>
<!-- Modal Para el Alumno Nuevo  ------------------------------------------------------------------------------------>
<div id="AlumnoNuevo" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalNewAlum" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form id="frmADDAlumno" action="<?php echo base_url() ?>index.php/ParticipantesController/agregar/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">
                            Agregar Alumno:
                        </legend> 
                        <div class="row">

                            <!--- --><div class="col-lg-6">
                                <div class="form-group">
                                    <label for="AlumnoNombre" class="col-lg-3 control-label">Nombre:</label>
                                    <div class="col-lg-6 ">
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
                                        <input type="text" class="form-control" name="NumeroDUI" id="AlumnoDUI" placeholder="Numero de DUI del Alumno" maxlength="10">
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

                                <!--- --></div>
                            <!--- --><div class="col-lg-6">
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
                                    <button type="submit" id="btnEnviarAlumnoADD" onclick="" class=" btn btn-default" name="Aceptar">Agregar</button>
                                    <button type="reset" id="btnLimpiarAlumnoADD" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                                    <!--<button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>-->
                                </div>

                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Alumnos --------------------------------------------------------------------------------------->
<div id="AlumnoEditar" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid ">
                <form id="frmEditarAlumno" action="<?php echo base_url() ?>index.php/ParticipantesController/modificar/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Editar Alumno:
                        </legend> 
                        <div class="row">

                            <!--- --><div class="col-lg-6">
                                <div class="form-group">
                                    <label for="AlumnoNombreEDIT" class="col-lg-3 control-label">Nombre:</label>
                                    <div class="col-lg-6 ">
                                        <input type="text" class="form-control" name="Nombre" id="AlumnoNombreEDIT" placeholder="Nombre Alumno" maxlength="100" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="AlumnoMailEDIT" class="col-lg-3 control-label">Correo Electronico:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="CorreoElectronico" id="AlumnoMailEDIT" placeholder="Correo electronico del alumno" maxlength="100" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoFijoEDIT" class="col-lg-3 control-label">Telefono Fijo:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="TelefonoFijo" id="AlumnoFijoEDIT" placeholder="Telefono Fijo del Alumno" maxlength="9" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoMovilEDIT" class="col-lg-3 control-label">Telefono Movil:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="TelefonoCelular" id="AlumnoMovilEDIT" placeholder="Telefono Celular del Alumno" maxlength="9" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="AlumnoDirEDIT" class="col-lg-3 control-label">Direccion:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="Direccion" id="AlumnoDirEDIT" placeholder="Direccion del Alumno" maxlength="200" required></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoDUIEDIT" class="col-lg-3 control-label">DUI:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="NumeroDUI" id="AlumnoDUIEDIT" placeholder="Numero de DUI del Alumno" maxlength="10">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="AlumnoFNacEDIT" class="col-lg-3 control-label">Fecha Nacimiento:</label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" name="FechaNacimiento" id="AlumnoFNacEDIT" placeholder="Fecha de nacimiento del Alumno" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>

                                <!--- --></div>
                            <!--- --><div class="col-lg-6">
                                <div class="form-group">
                                    <label for="AlumnoCarreraEDIT" class="col-lg-3 control-label">Carrera:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="Carrera" id="AlumnoCarreraEDIT" placeholder="Carrera del Alumno" maxlength="100">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoNivelEDIT" class="col-lg-3 control-label">Nivel Academico:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="NivelAcademico" id="AlumnoNivelEDIT" placeholder="Nivel academico del Alumno" maxlength="100">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoNEncargadoEDIT" class="col-lg-3 control-label">Encargado:</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="NombreEncargado" id="AlumnoNEncargadoEDIT" placeholder="Nombre del encargado del Alumno" maxlength="150">
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoCategoriaEDIT" class="col-lg-3 control-label">Categoria:</label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="AlumnoCategoriaEDIT" name="CodigoCategoriaParticipantes">
                                            <?php
                                            foreach ($CategoriasP as $categ) {
                                                //debo modificar este if para que hale la categoria actual del alumno
                                                if (true) {
                                                    echo '<option value="' . $categ->CodigoCategoriaParticipantes . '">' . $categ->NombreCategoriaParticipante . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoDescripcionEDIT" class="col-lg-3 control-label">Descripcion:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="Descripcion" id="AlumnoDescripcionEDIT" placeholder="Descripcion del Alumno"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AlumnoComentarioEDIT" class="col-lg-3 control-label">Comentarios:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="Comentarios" id="AlumnoComentarioEDIT" placeholder="Comentario del Alumno"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btnEnviarAlumnoEdit" onclick="" class=" btn btn-default" name="Aceptar">Actualizar</button>
                                    <button type="reset" id="btnLimpiarAlumnoEdit" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                                    <!--<button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>-->
                                </div>

                                <!--- --> </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar Alumnos --------------------------------------------------------------------------------------->
<?php $this->load->helper('url'); ?>
<div id="AlumnoEliminar" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalDELAlum" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form id="frmDELAlumno" action="<?php echo base_url() ?>index.php/ParticipantesController/eliminar/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">
                            Eliminar Alumno
                        </legend>
                        <p class="text-center">¿Desea eliminar al alumno: <mark id="nombreAlumEliminar"></mark> ?</p>
                        <input type="hidden" class="form-control" name="onlyFor">
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarAlumnoDEL" onclick="" class="btn btn-default" name="Eliminar">Eliminar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Cancelar">Cancelar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
