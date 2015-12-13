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
        <script language="javascript">
            $(document).ready(function() {
                $("#Categorias").change(function() {
                    $("#Categorias option:selected").each(function() {
                        idCategoria = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/GestionGruposController/getDiplomados/", {idCategoria: idCategoria}, function(data) {
                            console.log("Entro");
                            $("#Diplomado").html(data);
                        });
                    });
                });
                $("#Diplomado").change(function() {
                    $("#Diplomado option:selected").each(function() {
                        idDiplomado = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/GestionGruposController/getModulos/", {idDiplomado: idDiplomado}, function(data) {
                            console.log("EntroModulo");
                            $("#Modulo").html(data);
                        });
                    });
                });
            });

            $("#PeriodoADD").submit(function(event) {
                event.preventDefault();
                var $form = $(this), idModulo = $form.find("select[name='Modulo']").val(), FechaInicio = $form.find("input[name='FechaInicioPeriodo']").val(), FechaFin = $form.find("input[name='FechaFinPeriodo']").val(), ComentariosPeriodo = $form.find("textarea[name=ComentariosPeriodo]").val(), url = $form.attr("action"), estadoPeriodo = true;
                var posting = $.post(url, {idModulo: idModulo, FechaInicio: FechaInicio, FechaFin: FechaFin, ComentariosPeriodo: ComentariosPeriodo, estadoPeriodo: estadoPeriodo});
                posting.done(function(data) {
                    if (data !== null) {
                        console.log("Realizo el insert");
                        //$("#TEST").html("<h1>Insertado</h1>");
                    }
                });
                posting.fail(function() {
                    alert("error");
                });
            });
            function NuevoPeriodoModalShow() {
                $("#PeriodoNuevo").modal();
            }
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
                            <form class="form-horizontal" name="PeriodoADD" action="<?php echo base_url() ?>index.php/PeriodosController/insertPeriodo/" method="POST">
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
    </body>
</html>
