<div id="PeriodoNuevo" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalNewPeriodo" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form id="frmADDPeriodo" action="<?php echo base_url() ?>index.php/PeriodosController/insertPeriodo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">
                            Agregar Periodo:
                        </legend> 
                        <div class="row">
                            <div class="form-group">
                                <label for="Modulo" class="col-lg-3 control-label">Modulo: </label>
                                <div class="col-lg-6 ">
                                    <select class="form-control" name="CodigoModulo" id="CodigoModulo">
                                        <?php
                                        foreach ($Modulos as $modulo) {
                                            ?>
                                            <option value="<?= $modulo->CodigoModulo ?>">
                                                <?= $modulo->NombreModulo ?>
                                            </option>
                                            <?php
                                        }
                                        ?>   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="FechaInicioPeriodo" class="col-lg-3 control-label text-left">Fecha de Inicio: </label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" name="FechaInicioPeriodo" id="FechaInicioPeriodo" placeholder="Fecha de Inicio del Periodo" required>
                                </div>
                                <div class="col-lg-3">
                                    <label class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="FechaFinPeriodo" class="col-lg-3 control-label">Fecha de Finalizacion: </label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" name="FechaFinPeriodo" id="FechaFinPeriodo" placeholder="Fecha de Finalizacion del Periodo" required>
                                </div>
                                <div class="col-lg-3">
                                    <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ComentariosPeriodo" class="col-lg-3 control-label">Comentarios: </label>
                                <div class="col-lg-6">
                                    <textarea cols="40" rows="5" class="form-control" name="ComentariosPeriodo" id="ComentariosPeriodo" placeholder="Comentarios del Periodo"></textarea>
                                </div>
                                <div class="col-lg-3">
                                    <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btnEnviarPeriodoADD" onclick="" class=" btn btn-default" name="Aceptar">Agregar</button>
                                <button type="reset" id="btnLimpiarPeriodoADD" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                                <!--<button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>-->
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="PeriodoEliminar" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalDELPeriodo" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form id="frmDELPeriodo" action="<?php echo base_url() ?>index.php/PeriodosController/deletePeriodo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">
                            Eliminar Periodo
                        </legend>
                        <p class="text-center">¿Desea eliminar al Periodo del: <mark id="nombrePeriodoEliminar"></mark> ?</p>
                        <input type="hidden" class="form-control" name="onlyFor">
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarPeriodoDEL" onclick="" class="btn btn-default" name="Eliminar">Eliminar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Cancelar">Cancelar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>



<div id="PeriodoModificar" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalEditPeriodo" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form id="frmEditPeriodo" action="<?php echo base_url() ?>index.php/PeriodosController/editPeriodo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">
                            Modificar Periodo:
                        </legend> 
                        <div class="row">
                            <div class="form-group">
                                <label for="FechaInicioPeriodo" class="col-lg-3 control-label text-left">Fecha de Inicio: </label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" name="FechaInicioPeriodo" id="FechaInicioPeriodoE" placeholder="Fecha de Inicio del Periodo" required>
                                </div>
                                <div class="col-lg-3">
                                    <label class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="FechaFinPeriodo" class="col-lg-3 control-label">Fecha de Finalizacion: </label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" name="FechaFinPeriodo" id="FechaFinPeriodoE" placeholder="Fecha de Finalizacion del Periodo" required>
                                </div>
                                <div class="col-lg-3">
                                    <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EstadoPeriodo" class="col-lg-3 control-label">Estado: </label>
                                <div class="col-lg-6">
                                    <label class="checkbox"><input type="checkbox" name="EstadoPeriodo" id="EstadoPeriodoE" value="1">Activado</label> 
                                </div>
                                <div class="col-lg-3">
                                    <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ComentariosPeriodo" class="col-lg-3 control-label">Comentarios: </label>
                                <div class="col-lg-6">
                                    <textarea cols="40" rows="5" class="form-control" name="ComentariosPeriodo" id="ComentariosPeriodoE" placeholder="Comentarios del Periodo"></textarea>
                                </div>
                                <div class="col-lg-3">
                                    <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btnEnviarPeriodoEdit" onclick="" class=" btn btn-default" name="Aceptar">Actualizar</button>
                                <button type="reset" id="btnLimpiarPeriodoEdit" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>



<div id="PeriodoGestion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalGestionPeriodo" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-header">
                    Grupos del Periodo:
                </div> 
                <div>
                    <form id="frmGrupoAdd" action="<?php echo base_url() ?>index.php/PeriodosController/insertGrupo/" class="form-inline" method="post" >
                        <fieldset>
                            <h4>
                                Agregar Grupo:
                            </h4>
                            <div class="row">
                                <div class="form-group-sm">
                                    <label for="Aula" class="col-md-1 control-label">Aula: </label>
                                    <input type="text" class="col-md-2 form-control" name="Aula" id="AulaNombre" placeholder="Aula" maxlength="10" required>
                                </div>
                                <div class="form-group-sm">
                                    <label for="HoraEntradaGrupo" class="col-md-1 control-label">Entrada: </label>
                                    <input type="time" class="col-md-2 form-control" name="HoraEntradaGrupo" id="HoraEntradaGrupo" placeholder="Hora Inicializacion sesion" required>  
                                </div>

                                <div class="form-group-sm">
                                    <label for="HoraSalidaGrupo" class="col-md-1 control-label">Salida: </label>
                                    <input type="time" class="col-md-2 form-control" name="HoraSalidaGrupo" id="HoraSalidaGrupo" placeholder="Hora finalizacion sesion" required>
                                </div>
                                <div class="form-group-sm">
                                    <div class="col-md-1"></div>
                                    <button type="submit" id="btnEnviarGrupoPeriodoAdd" onclick="" class="col-md-2 btn btn-default" name="Aceptar"><span class="glyphicon glyphicon-plus"></span>Agregar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <h4>Grupos Existentes:</h4>
                    <table border="1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <!--<th>Codigo</th>-->
                                <th>Estado</th>
                                <th>Hora de Entrada</th>
                                <th>Hora de Salida</th>
                                <th>Aula</th>
                                <th>Configuracion</th>
                                <!--<th>Alumnos</th>-->
                            </tr>
                        </thead>
                        <tbody id="bodytablaPeriodosGruposO">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gestionGrupoModal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#Maestros" aria-controls="Maestros" role="tab" data-toggle="tab">Maestros</a></li>
                        <li role="presentation"><a href="#Alumnos" aria-controls="Alumnos" role="tab" data-toggle="tab">Alumnos</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Maestros">
                            <div class="contendor">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Asignar/Desasignar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>test</td>
                                            <td>testt</td>
                                            <td>test</td>
                                        </tr>
                                        <tr>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Alumnos">
                            <div class="contendor">
                                Alumnos
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>DUI</th>
                                            <th>Categoria</th>
                                            <th>Comentarios</th>
                                            <th>Asignar/Desasignar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="../bootstrap/js/GruposPeriodos.js"></script>
