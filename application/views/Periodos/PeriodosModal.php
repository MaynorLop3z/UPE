<script src="../bootstrap/js/jquery-ui.js"></script>
<link href="../bootstrap/css/jquery-ui.css" rel="stylesheet">
<script>
    $('#iconFechaInicioPeriodo, #FechaInicioPeriodo').click(function () {
        $('#dateFechaInicioPeriodo');
        $('#dateFechaInicioPeriodo').datepicker({
            // $.datepicker.formatDate( "yy-mm-dd", new Date( 2007, 1 - 1, 26 ) );
            onSelect: function (date) {
                $('#FechaInicioPeriodo').val($(this).datepicker({dateFormat: 'dd-mm-yy'}).val());
                $(this).hide();
            },
            inline: true
        });

    });

</script>
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
                            <div class="col-lg-6">
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
                                    <div class="col-lg-6 input-group" >
                                        <input type="date" class="form-control" name="FechaInicioPeriodo" id="FechaInicioPeriodo" data-mask="0000-00-00" placeholder="Año-Mes-Dia" required>
                                        <span class="input-group-addon" id="iconFechaInicioPeriodo" ><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                    <div id="dateFechaInicioPeriodo" style="position: absolute;left:100px;z-index: 1000"></div>
                                </div> 
                                <div class="form-group">
                                    <label for="FechaFinPeriodo" class="col-lg-3 control-label">Fecha de Finalizacion: </label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" name="FechaFinPeriodo" id="FechaFinPeriodo" data-mask="0000-00-00" placeholder="Año-Mes-Dia" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                    <div id="dateFechaFinPeriodo"></div>
                                </div>
                                <div class="form-group">
                                    <label for="ComentariosPeriodo" class="col-lg-3 control-label">Comentarios: </label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="ComentariosPeriodo" id="ComentariosPeriodo" placeholder="Comentarios del Periodo" maxlength="200" ></textarea>
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="FechaInicioPeriodo" class="col-lg-3 control-label text-left">Fecha de Inicio: </label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" name="FechaInicioPeriodo" id="FechaInicioPeriodoE" data-mask="0000-00-00" placeholder="Año-Mes-Dia" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="FechaFinPeriodo" class="col-lg-3 control-label">Fecha de Finalizacion: </label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" name="FechaFinPeriodo" id="FechaFinPeriodoE" data-mask="0000-00-00" placeholder="Año-Mes-Dia" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="EstadoPeriodo" class="col-lg-3 control-label">Estado: </label>
                                    <div class="col-lg-6" style="margin-left: 20px;">
                                        <label class="checkbox"><input type="checkbox" name="EstadoPeriodo" id="EstadoPeriodoE" value="1">Activado</label> 
                                    </div>
                                    <div class="col-lg-3">
                                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ComentariosPeriodo" class="col-lg-3 control-label">Comentarios: </label>
                                    <div class="col-lg-6">
                                        <textarea cols="40" rows="5" class="form-control" name="ComentariosPeriodo" id="ComentariosPeriodoE" placeholder="Comentarios del Periodo" maxlength="200"></textarea>
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
                    <!--<form id="frmGrupoAddG" action="<?php echo base_url() ?>index.php/GestionGruposController/setGrupoPeriodo/" class="form-inline" method="post" >-->
                        <fieldset>
                            <h4>
                                Agregar Grupo:
                            </h4>
                            <div class="row">
                                <table>
<!--                                <tr>
                                    <td><label for="Aula" class="col-md-1 control-label">Aula: </label></td>
                                    <td><input type="text" class="col-md-2 form-control" name="Aula" id="AulaNombre" placeholder="Aula" maxlength="10" required></td>
                                </tr>
                                <tr>
                                    <td><label for="HoraEntradaGrupo" class="col-md-1 control-label">Entrada: </label></td>
                                    <td><input type="time" class="col-md-2 form-control" name="HoraEntradaGrupo" id="HoraEntradaGrupo" placeholder="Hora Inicializacion sesion" data-mask="00:00:00:00" required> </td>
                                </tr>

                                <tr>
                                    <td><label for="HoraSalidaGrupo" class="col-md-1 control-label">Salida: </label></td>
                                    <td><input type="time" class="col-md-2 form-control" name="HoraSalidaGrupo" id="HoraSalidaGrupo" placeholder="Hora finalizacion sesion" data-mask="00:00:00:00"  required></td>
                                </tr>-->
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-md-1" style="margin-top: 10px;">
                                                <button type="submit" id="btnEnviarGrupoPeriodoAdd" onclick="" class="btn btn-default" name="Aceptar"><span class="glyphicon glyphicon-plus"></span>Agregar</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </form>
                    <h4>Grupos Existentes:</h4>
                    <table border="1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>GT</th>
                                <th>Estado</th>
                                <th>Hora de Entrada</th>
                                <th>Hora de Salida</th>
                                <th>Aula</th>
                                <th>Dia</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gestionGrupoModalTitle"></h4>
            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#Maestros" aria-controls="Maestros" role="tab" data-toggle="tab">Maestros</a></li>
                        <li role="presentation"><a href="#Alumnos" aria-controls="Alumnos" role="tab" data-toggle="tab">Alumnos</a></li>
                        <li role="presentation"><a href="#HorarioDelGrupo" aria-controls="Horario" role="tab" data-toggle="tab">Horario</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Maestros">
                            <div class="contendor">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Asignar/Desasignar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="DocentesGrupoPeriodo">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Alumnos">
                            <div class="contendor">
                                <div class="panel panel-default">
                                    <form id="frmfindAlumnoPeriodo"  action="" class="form-horizontal" method="post" >
                                        <fieldset>
                                            <legend class="modal-header">Buscar Alumno:</legend> 
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <input class="form-control form-inline" placeholder="Nombre" name="FindAlumno" id="FindAlumnoNombre" type="text" maxlength="150" >
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

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
                                    <tbody id="EstudiantesGrupoPeriodo">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="HorarioDelGrupo">
                            <div class="contendor">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Dia</th>
                                            <th>Aula</th>
                                            <th>Entrada</th>
                                            <th>Salida</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="HorarioDelGrupoPeriodo">

                                    </tbody>
                                </table>
                                <button type="submit" id="btnEnviarGrupoPeriodoAddH" onclick="" class="btn btn-default" name="Aceptar"><span class="glyphicon glyphicon-plus"></span>Agregar Horario</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="../bootstrap/js/GruposPeriodos.js"></script>

<!--MODAL PARA AGREGAR HORARIOS-->
<script>
    var it = 'A.M.';
    var ft = 'A.M.';
    $(function () {
        var hIH = $('#HorarioInicioHoraGrupo').spinner({max: 12, min: 1, stop: function (event, ui) {
//           if($('#HorarioFinHora').val()<$('#HorarioInicioHora').val()){
//               $('#HorarioFinHora').val($('#HorarioInicioHora').val());
//           }
            }});
        $("#HorarioInicioHoraGrupo").spinner("option", "numberFormat", "nn");
        var hFH = $('#HorarioFinHoraGrupo').spinner({max: 12, min: 1, stop: function (event, ui) {
            }});
        var hIM = $('#HorarioInicioMinutosGrupo').spinner({max: 55, min: 0, step: 5});
        var hFM = $('#HorarioFinMinutosGrupo').spinner({max: 55, min: 0, step: 5});
        var hAPI = $('#HoraInicioAmPmGrupo').spinner({star: function (event, ui) {
                it = $(this).val();
            },
            spin: function (event, ui) {
                event.preventDefault();
                ui.value = '';
            },
            stop: function (event, ui) {
                if (it == 'A.M.') {
                    $(this).val('P.M.');
                    it = 'P.M.';
                } else {
                    it = 'A.M.';
                    $(this).val('A.M.');
                }
            }});

        var hAPF = $('#HoraFinAmPmGrupo').spinner({star: function (event, ui) {
                ft = $(this).val();
            },
            spin: function (event, ui) {
                event.preventDefault();
                ui.value = '';
            },
            stop: function (event, ui) {
                if (ft == 'A.M.') {
                    $(this).val('P.M.');
                    ft = 'P.M.';
                } else {
                    ft = 'A.M.';
                    $(this).val('A.M.');
                }
            }});

        $('#btnEnviarGrupoPeriodoAddH').click(function () {
            $('#ModalHorarioNuevoGrupo').modal();
        });
        $('#frmGrupoAddG').submit(function () {
            var idPeriodo = codigoPeriodo.substring(10);
            alert(idPeriodo);
            //var posting=$.post($(this).attr('action'),{'g':idPeriodo});
        });
    });


</script>
<!------Modal para Agregar Horarios--------->
<div id="ModalHorarioNuevoGrupo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarHorarioNuevoGrupo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form  id="formAgregarHorarioGrupo" action="<?php echo base_url() ?>index.php/HorariosController/agregarHorario/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Nuevo Horario:</legend> 
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Turno:</label>
                            <div class="col-lg-4">
                                <select class="form-control col-lg-4" name="TurnoHorarioGrupo" id="TurnoHorarioGrupo">
                                    <?php
                                    foreach ($Turnos as $t) {
                                        ?>
                                        <option value="<?= $t->CodigoTurno ?>">
    <?= $t->NombreTurno ?>
                                        </option>
    <?php
}
?>   
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Dia:</label>
                            <div class="col-lg-4">
                                <select class="form-control col-lg-4" name="DiaHorarioGrupo" id="DiaHorarioGrupo">
                                        <?php
                                        $dias = array("LUNES" => LUNES, "MARTES" => MARTES, "MIÉRCOLES" => MIERCOLES,
                                            "JUEVES" => JUEVES, "VIERNES" => VIERNES, "SÁBADO" => SABADO, "DOMINGO" => DOMINGO);

                                        foreach ($dias as $dia => $i) {
                                            ?>
                                        <option value="<?= $i ?>">
    <?= $dia ?>
                                        </option>
    <?php
}
?>   
                                </select>

                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="HorarioInicioGrupo" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-9">
                                <!--<input type="text" class="form-control" name="AulaNombre" id="AulaNombre" placeholder="Nombre del Aula" maxlength="50" required>-->
                                <p>
                                    <input id="HorarioInicioHoraGrupo" name="value" placeholder="Horas" value="6" size="4"> : 
                                    <input id="HorarioInicioMinutosGrupo" name="value" placeholder="Minutos" value="0" size="4">
                                    <input id="HoraInicioAmPmGrupo" value="A.M." size="3">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="HorarioFinGrupo" class="col-lg-3 control-label">Fin</label>
                            <div class="col-lg-9">
                                <p>
                                    <input id="HorarioFinHoraGrupo" name="value" placeholder="Horas" value="8" size="4"> : 
                                    <input id="HorarioFinMinutosGrupo" name="value" placeholder="Minutos" value="0" size="4">
                                    <input id="HoraFinAmPmGrupo" value="A.M." size="3">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Aula</label>
                            <div class="col-lg-4">
                                <select class="form-control col-lg-4" name="AulaHorarioGrupo" id="AulaHorarioGrupo">

                                </select>
                            </div>
                        </div> 

                        <div class="modal-footer">
                            <button type="submit" id="btnAgregarHorarioGrupo" onclick="" class=" btn btn-default" name="AceptarGrupo">Agregar este horario</button>
                            <!--                            <button type="button" id="btnCancelarHorarioGrupo" onclick=""class=" btn btn-default" data-dismiss="modal">Listo</button>-->
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!--//Eliminar horarios-->
<div id="frmEliminarHorario" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalDELPeriodo" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <legend class="modal-header">
                    Eliminar Horario
                </legend>
                <p class="text-center">¿Desea eliminar este horario?: <mark id="nombreHorarioEliminar"></mark> ?</p>
                <input type="hidden" class="form-control" name="onlyFor">
                <div class="modal-footer">
                    <button type="button" id="btnEliminarHorarioDeGrupo" onclick="" class="btn btn-default" name="Eliminar">Eliminar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Cancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Nuevo Grupo-->
<div id="modalNuevoGrupo" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarModalNewGrupo" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form id="frmNuevoGrupo" action="<?php echo base_url() ?>index.php/PeriodosController/insertGrupo/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">
                            Agregar Grupo:
                        </legend> 
                        <div class="row">
                            <div class="col-lg-9">
                                ¿Desea agregar un nuevo grupo a este periodo?
                                <div class="modal-footer">
                                    <button type="button" id="btnEnviarGrupoHADD" onclick="" class=" btn btn-default" name="Aceptar">Agregar</button>
                                    <!--<button type="reset" id="btnLimpiarGrupoADD" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>-->
                                    <button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
