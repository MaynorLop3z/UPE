<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                                        <label for="ComentariosPeriodo" class="col-lg-3 control-label">Comentarios: </label>
                                        <div class="col-lg-6">
                                            <textarea cols="40" rows="5" class="form-control" name="ComentariosPeriodo" id="ComentariosPeriodoE" placeholder="Comentarios del Periodo"></textarea>
                                        </div>
                                        <div class="col-lg-3">
                                            <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btnEnviarPeriodoEdit" onclick="" class=" btn btn-default" name="Aceptar">Agregar</button>
                                        <button type="reset" id="btnLimpiarPeriodoEdit" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
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
                        , url = $form.attr("action");
                var posting = $.post(url,
                        {idPeriodo: idPeriodo
                            , FechaInicio: FechaInicio
                            , FechaFinal: FechaFinal
                            , Comentarios: Comentarios
                            , Estado: true});
                posting.done(function(data) {
                    if (data !== null) {
                        var obj = jQuery.parseJSON(data);
                        var trPeriodo = $('#bodytablaPeriodos').find("#Periodo" + obj.CodigoPeriodo);
                        trPeriodo.find('.ffp').html(obj.FechaFinPeriodo);
                        trPeriodo.find('.fip').html(obj.FechaInicioPeriodo);
                        trPeriodo.find('.cp').html(obj.Comentario);
                        $("#PeriodoModificar").modal('toggle');
                    }
                });
                posting.fail(function(xhr, textStatus, errorThrown) {
                    alert("error" + xhr.responseText);
                });
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
        </script>
    </body>
</html>
