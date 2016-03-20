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
//                            $("#Diplomado").html(data);
                            var diplomados = "";
                            var modulos = "";
                            var periodos = "";
                            var diplomado = JSON.parse(data);
                            if (diplomado.diplomados.length > 0) {
                                for (datos in diplomado.diplomados)
                                {
                                    diplomados += '<option value="' + diplomado.diplomados[datos].CodigoDiplomado + '">' + diplomado.diplomados[datos].NombreDiplomado + '</option>';
                                }
                                $("#Diplomado").html(diplomados);
//                                console.log(diplomado.test);
//                                console.log(diplomado.diplomados.length);
                                if (diplomado.modulos.length > 0) {
                                    for (datos in diplomado.modulos)
                                    {
                                        modulos += '<option value="' + diplomado.modulos[datos].CodigoModulo + '">' + diplomado.modulos[datos].NombreModulo + '</option>';
                                    }
                                    $("#Modulo").html(modulos);
                                    $("#CodigoModulo").html(modulos);
                                    console.log(diplomado.periodos.length);
                                    if (diplomado.periodos.length > 0) {
                                        for (datos in diplomado.periodos)
                                        {
                                            periodos += '<tr id="Periodo' + diplomado.periodos[datos].CodigoPeriodo + '">';
                                            periodos += '<th class="fip">' + diplomado.periodos[datos].FechaInicioPeriodo + '</th>';
                                            periodos += '<th class="ffp">' + diplomado.periodos[datos].FechaFinPeriodo + '</th>';
                                            if (diplomado.periodos[datos].Estado === 't') {
                                                periodos += '<th class="ep">Activo</th>';

                                            } else {
                                                periodos += '<th class="ep">Inactivo</th>';
                                            }
                                            periodos += '<th class="cp">' + diplomado.periodos[datos].Comentario + '</th>';
                                            periodos +='<th>';
                                            periodos +='<button id="PeriodoE'+diplomado.periodos[datos].CodigoPeriodo+'" onclick="EditPeriodoShow(this)" title="Editar Periodo" class="btn_modificar_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
                                            periodos +='<button id="PeriodoDEL'+diplomado.periodos[datos].CodigoPeriodo+'" onclick="DeletePeriodoShow(this)" title="Eliminar Periodo" class="btn_eliminar_periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                                            periodos +='<button id="PeriodoGES'+diplomado.periodos[datos].CodigoPeriodo+'" onclick="GestionPeriodoShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button>';
                                            periodos += '</th></tr>';
                                        }
                                        $("#bodytablaPeriodos").html(periodos);
                                    }
                                    else {
                                        $("#bodytablaPeriodos").html(periodos);
                                    }

                                }
                                else {
                                    $("#Modulo").html(modulos);
                                    $("#CodigoModulo").html(modulos);
                                }

                            }
                            else {
                                $("#Diplomado").html(diplomados);
                                $("#Modulo").html(modulos);
                            }
                        });
                    });
                });
                $("#Diplomado").change(function() {
                    $("#Diplomado option:selected").each(function() {
                        idDiplomado = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/GestionGruposController/getModulos/", {idDiplomado: idDiplomado}, function(data) {
                            console.log("EntroModulo");
                            $("#Modulo").html(data);
                            $("#CodigoModulo").html(data);
                        });
                    });
                });
                $("#Modulo").change(function() {
                    $("#Modulo option:selected").each(function() {
                        idModulo = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/PeriodosController/listarByModulo/", {idModulo: idModulo}, function(data) {
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
                                                <?php
                                                foreach ($Diplomados as $diplomado) {
                                                    ?>
                                                    <option value="<?= $diplomado->CodigoDiplomado ?>">
                                                        <?= $diplomado->NombreDiplomado ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Modulo" class="col-lg-1 control-label">Modulo: </label>
                                        <div class="col-lg-9 ">
                                            <select class="form-control" name="Modulo" id="Modulo">
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
                                        <?php
                                        foreach ($Periodos as $period) {
                                            ?>
                                            <tr id="Periodo<?= $period->CodigoPeriodo ?>">
                                                <th class="fip"><?= $period->FechaInicioPeriodo ?></th>
                                                <th class="ffp"><?= $period->FechaFinPeriodo ?></th>
                                                <th class="ep"><?= ($period->Estado === 't') ? 'Activo' : 'Inactivo' ?></th>
                                                <th class="cp"><?= $period->Comentario ?></th>
                                                <th>
                                                    <button id="PeriodoE<?= $period->CodigoPeriodo ?>" onclick="EditPeriodoShow(this)" title="Editar Periodo" class="btn_modificar_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                                                    <button id="PeriodoDEL<?= $period->CodigoPeriodo ?>" onclick="DeletePeriodoShow(this)" title="Eliminar Periodo" class="btn_eliminar_periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                    <button id="PeriodoGES<?= $period->CodigoPeriodo ?>" onclick="GestionPeriodoShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button>
                                                </th>
                                            </tr>
                                            <?php
                                        }
                                        ?>
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
        <script src="../bootstrap/js/GruposPeriodos.js"></script>
    </body>
</html>
