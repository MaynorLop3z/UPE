<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->helper('url'); ?>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <!--script src="../bootstrap/js/Periodos.js"></script-->
        <script language="javascript">
            $(document).ready(function() {
                $("#Categorias").change(function() {
                    $("#Categorias option:selected").each(function() {
                        idCategoria = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/GestionGruposController/getDiplomados/", {idCategoria: idCategoria}, function(data) {
//                            console.log("Entro");
                            $("#Diplomado").html(data);
                        });
                    });
                });
                $("#Diplomado").change(function() {
                    $("#Diplomado option:selected").each(function() {
                        idDiplomado = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/GestionGruposController/getModulos/", {idDiplomado: idDiplomado}, function(data) {
//                            console.log("EntroModulo");
                            $("#Modulo").html(data);
                            $("#CodigoModulo").html(data);
                        });
                    });
                });
                $("#Modulo").change(function() {
                    $("#Modulo option:selected").each(function() {
                        idModulo = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/PeriodosController/listarByModulo/", {idModulo: idModulo}, function(data) {
//                            console.log("EntroTablaPeriodos");
                            $("#bodytablaPeriodos").html(data);
                        });
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">UPESYS</a>
                        </div>
                        <div>
                            <ul class="nav  navbar-right center-block ">
                                <label id="labelpersona">Maynor Lopez</label>
                                <button id="btnsalir" name="btnsalir" onclick="window.location.href = 'Login'" class="btn btn-default "><span class="glyphicon glyphicon-log-out"></span>Salir</button>
                            </ul>
                        </div> 

                    </nav>
                    <!--Hasta  Aqui termina la barra de navegacion Encabezado--> 
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Gestion de Grupos</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="PeriodoList" action="" method="POST">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="Categorias" class="col-lg-1 control-label">Categoria: </label> 
                                        <div class="col-lg-9 ">
                                            <select class="form-control" name="Categorias" id="Categorias">
                                                <?php
                                                foreach ($Categorias as $categoria) {
                                                    ?>
                                                    <option value="<?= $categoria->CodigoCategoriaDiplomado ?>">
                                                        <?= $categoria->NombreCategoriaDiplomado ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Diplomado" class="col-lg-1 control-label">Diplomado: </label>
                                        <div class="col-lg-9 ">
                                            <select class="form-control" name="Diplomado" id="Diplomado">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Modulo" class="col-lg-1 control-label">Modulo: </label>
                                        <div class="col-lg-9 ">
                                            <select class="form-control" name="Modulo" id="Modulo">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button  id="btnADDPeriodo" class="btn btn-default" onclick="NuevoPeriodoModalShow()"><span class="glyphicon glyphicon-plus"></span>Nuevo Periodo</button>
                            <div id="tablaPeriodos">
                                <table border="1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Estado</th>
                                            <th>Comentarios</th>
                                            <th>Gestion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodytablaPeriodos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
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
                                    Eliminar Alumno
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
                                    <!--                                    <div class="form-group">
                                                                            <label for="Aula" class="col-lg-3 control-label">Aula:</label>
                                                                            <div class="col-lg-6 ">
                                                                                <input type="text" class="form-control" name="Aula" id="AulaNombre" placeholder="Aula" maxlength="10" required>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <label id="usR" class="warning"></label>  Para  cuando el campo sea requerido
                                                                            </div>
                                                                        </div>-->
                                    <!--                                    <div class="form-group">
                                                                            <label for="HoraEntradaGrupo" class="col-lg-3 control-label">Hora de Salida: </label>
                                                                            <div class="col-lg-6">
                                                                                <input type="time" class="form-control" name="HoraEntradaGrupo" id="HoraEntradaGrupo" placeholder="Hora Inicializacion sesion" required>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <label id="usR" class="warning"></label>  Para  cuando el campo sea requerido
                                                                            </div>
                                                                        </div>-->
                                    <!--                                    <div class="form-group">
                                                                            <label for="HoraSalidaGrupo" class="col-lg-3 control-label">Hora de Salida: </label>
                                                                            <div class="col-lg-6">
                                                                                <input type="time" class="form-control" name="HoraSalidaGrupo" id="HoraSalidaGrupo" placeholder="Hora finalizacion sesion" required>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <label id="usR" class="warning"></label>  Para  cuando el campo sea requerido
                                                                            </div>
                                                                        </div>-->
                                    <!--                                    <div class="row">
                                                                            <div class="col-md-11"></div>
                                                                            <div class="col-md-1 form-group">
                                                                                <button type="submit" id="btnEnviarGrupoPeriodoEdit" onclick="" class=" btn btn-default" name="Aceptar"><span class="glyphicon glyphicon-plus"></span></button>
                                                                                <button type="reset" id="btnLimpiarGrupoPeriodoEdit" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                                                                            </div>-->
                                    <!--                                    </div>-->
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
                                        <!--<th>Alumnos</th>-->
                                    </tr>
                                </thead>
                                <tbody id="bodytablaPeriodosGrupos">
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
        <script language="javascript">
            var codigoPeriodo;
            $("#frmADDPeriodo").submit(function(event) {
                event.preventDefault();
                var $form = $(this), idModulo = $form.find("select[name='CodigoModulo']").val(), FechaInicio = $form.find("input[name='FechaInicioPeriodo']").val(), FechaFin = $form.find("input[name='FechaFinPeriodo']").val(), ComentariosPeriodo = $form.find("textarea[name=ComentariosPeriodo]").val(), url = $form.attr("action"), estadoPeriodo = true;
                console.log(idModulo);
                var posting = $.post(url, {idModulo: idModulo, FechaInicio: FechaInicio, FechaFin: FechaFin, ComentariosPeriodo: ComentariosPeriodo, estadoPeriodo: estadoPeriodo});
                posting.done(function(data) {
                    if (data !== null) {
                        $("#PeriodoNuevo").modal('toggle');
                    }
                });
                posting.fail(function() {
                    alert("error");
                });
            });
            $('#PeriodoEliminar').on('show.bs.modal', function(event) {
                var perio = $('#Periodo' + codigoPeriodo.substring(10));
                var Fecha_Inicio = perio.find('.fip').html().toString().trim();
                var Fecha_Fin = perio.find('.fip').html().toString().trim();
                $('#nombrePeriodoEliminar').html(Fecha_Inicio + " al " + Fecha_Fin);
            });
            $('#PeriodoModificar').on('show.bs.modal', function(event) {
                var perio = $('#Periodo' + codigoPeriodo.substring(8));
                var Fecha_Inicio = perio.find('.fip').html().toString().trim();
                var Fecha_Fin = perio.find('.ffp').html().toString().trim();
                var Comentarios = perio.find('.cp').html().toString().trim();
                var Estado = perio.find('.ep').html().toString().trim();
                //console.log(Estado);
                //console.log((Estado === "Activado"));
                if (Estado === "Activo") {
                    $("#EstadoPeriodoE").prop("checked", true);
                } else {
                    $("#EstadoPeriodoE").prop("checked", false);
                }
//                $('#nombrePeriodoEliminar').html(Fecha_Inicio + " al " + Fecha_Fin);
                $('#FechaInicioPeriodoE').val(Fecha_Inicio);
                $('#FechaFinPeriodoE').val(Fecha_Fin);
                $('#ComentariosPeriodoE').val(Comentarios);
            });
            $("#frmDELPeriodo").submit(function(event) {
                event.preventDefault();
                var $form = $(this), PeriodoCodigo = codigoPeriodo.substring(10), url = $form.attr("action");
                console.log(PeriodoCodigo);
                var posting = $.post(url, {PeriodoCodigo: PeriodoCodigo});
                posting.done(function(data) {
                    console.log(data);
                    if (data) {
                        console.log(data);
                        $("#PeriodoEliminar").modal('toggle');
                        $('#tablaPeriodos').find('#Peridoo' + PeriodoCodigo).fadeOut("slow");
                        $('#tablaPeriodos').find('#Periodo' + PeriodoCodigo).remove();
                    }
                });
                posting.fail(function() {
                    alert("error");
                });
            });
            $("#frmEditPeriodo").submit(function(event) {
                event.preventDefault();
                var $form = $(this), idPeriodo = codigoPeriodo.substring(8)
                        , FechaInicio = $form.find("input[name='FechaInicioPeriodo']").val()
                        , FechaFinal = $form.find("input[name='FechaFinPeriodo']").val()
                        , Comentarios = $form.find("textarea[name='ComentariosPeriodo']").val()
                        , Estado = $("#EstadoPeriodoE").prop("checked")
                        , url = $form.attr("action");
                console.log(Estado);
                var posting = $.post(url,
                        {idPeriodo: idPeriodo
                            , FechaInicio: FechaInicio
                            , FechaFinal: FechaFinal
                            , Comentarios: Comentarios
                            , Estado: (Estado) ? 1 : 0});
                posting.done(function(data) {
                    if (data !== null) {
                        var obj = jQuery.parseJSON(data);
                        var trPeriodo = $('#bodytablaPeriodos').find("#Periodo" + obj.CodigoPeriodo);
                        trPeriodo.find('.ffp').html(obj.FechaFinPeriodo);
                        trPeriodo.find('.fip').html(obj.FechaInicioPeriodo);
                        trPeriodo.find('.cp').html(obj.Comentario);
//                        console.log(obj.Estado);
                        if (obj.Estado === '1') {
//                            console.log("in");
                            trPeriodo.find('.ep').html("Activo");
                        } else {
                            console.log("out");
                            trPeriodo.find('.ep').html("Inactivo");
                        }
                        $("#PeriodoModificar").modal('toggle');
                    }
                });
                posting.fail(function(xhr, textStatus, errorThrown) {
                    alert("error" + xhr.responseText);
                });
            });
            $("#frmGrupoAdd").submit(function(event) {
                event.preventDefault();
                var $form = $(this), idPeriodo = codigoPeriodo.substring(10)
                        , HoraEntrada = $form.find("input[name='HoraEntradaGrupo']").val()
                        , HoraSalida = $form.find("input[name='HoraSalidaGrupo']").val()
//                        , Estado = $("#EstadoPeriodoE").prop("checked")
                        , Aula = $form.find("input[name='Aula']").val()
                        , url = $form.attr("action");
//                console.log(Estado);
                var posting = $.post(url,
                        {idPeriodo: idPeriodo
                            , HoraEntrada: HoraEntrada
                            , HoraSalida: HoraSalida
                            , Aula: Aula});
                posting.done(function(data) {
                    if (data !== null) {
                        var obj = jQuery.parseJSON(data);
                        var fila = "";
                        fila += '<tr id="GrupoPeriodo' + obj.CodigoGrupoPeriodo + '">\n';
                        fila += '<td class="Estado_Grupo">' + ((obj.Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
                        fila += '<td class="Hora_Entrada">' + obj.HoraEntrada + '</td>\n';
                        fila += '<td class="Hora_Salida">' + obj.HoraSalida + '</td>\n';
                        fila += '<td class="Aula">' + obj.Aula + '</td>\n';
                        fila += '</tr>\n';
//                        console.log(fila);
                        $('#bodytablaPeriodosGrupos').append(fila);
//                        $(this).trigger("reset");
                        $form.find("input[name='HoraEntradaGrupo']").val("");
                        $form.find("input[name='HoraSalidaGrupo']").val("");
                        $form.find("input[name='Aula']").val("");
                        //$("#PeriodoGestion").modal('toggle');
                    }
                });
                posting.fail(function(xhr, textStatus, errorThrown) {
                    alert("error" + xhr.responseText);
                });
            });
            $('#PeriodoGestion').on('show.bs.modal', function(event) {
                var idPeriodo = codigoPeriodo.substring(10);
                var url = "<?php echo base_url() ?>index.php/PeriodosController/listarGrupos/";
                var posting = $.post(url, {idPeriodo: idPeriodo});
                posting.done(function(data) {
                    if (data !== null) {
                        var obj = jQuery.parseJSON(data);
                        var tabla = "";
                        for (x in obj) {
                            tabla += '<tr id="GrupoPeriodo' + obj[x].CodigoGrupoPeriodo + '">\n';
                            tabla += '<td class="Estado_Grupo">' + ((obj[x].Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
                            tabla += '<td class="Hora_Entrada">' + obj[x].HoraEntrada + '</td>\n';
                            tabla += '<td class="Hora_Salida">' + obj[x].HoraSalida + '</td>\n';
                            tabla += '<td class="Aula">' + obj[x].Aula + '</td>\n';
                            tabla += '</tr>\n';
//                            for (y in obj[x]) {
//                                console.log(obj[x][y]);
//                            }
                        }
//                        console.log(tabla);
                        $('#bodytablaPeriodosGrupos').html(tabla);

                    }
                });
                posting.fail(function(xhr, textStatus, errorThrown) {
                    alert("error" + xhr.responseText);
                });
                //$('#nombrePeriodoEliminar').html(Fecha_Inicio + " al " + Fecha_Fin);
            });
            function NuevoPeriodoModalShow() {
                $("#PeriodoNuevo").modal();
            }
            function DeletePeriodoShow(fila) {
                codigoPeriodo = fila.id;
                $("#PeriodoEliminar").modal('toggle');
            }
            function EditPeriodoShow(fila) {
                codigoPeriodo = fila.id;
                $("#PeriodoModificar").modal('toggle');
            }
            function GestionPeriodoShow(fila) {
                codigoPeriodo = fila.id;
                $("#PeriodoGestion").modal('toggle');
            }
        </script>
    </body>
</html>
