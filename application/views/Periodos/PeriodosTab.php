<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/paginacion.js"></script>
<script language="javascript">
    $(document).ready(function() {
        $("#Categorias").change(function() {
            $("#Categorias option:selected").each(function() {
                idCategoria = $(this).val();
                $.post("<?php echo base_url() ?>index.php/GestionGruposController/getDiplomados/", {idCategoria: idCategoria}, function(data) {
                    var diplomado = JSON.parse(data);
                    $("#Diplomado").html(diplomado.diplomados);
                    $("#Modulo").html(diplomado.modulos);
                    $("#CodigoModulo").html(diplomado.modulos);
                    $("#bodytablaPeriodos").html(diplomado.periodos);
                    paginadoPeriodos(diplomado);
                });
            });
        });
        $("#Diplomado").change(function() {
            $("#Diplomado option:selected").each(function() {
                idDiplomado = $(this).val();
                $.post("<?php echo base_url() ?>index.php/GestionGruposController/getModulos/", {idDiplomado: idDiplomado}, function(data) {
                    console.log("EntroModulo");
                    var modulo = JSON.parse(data);
                    $("#Modulo").html(modulo.modulos);
                    $("#CodigoModulo").html(modulo.modulos);
                    $("#bodytablaPeriodos").html(modulo.periodos);
                    paginadoPeriodos(modulo);
                });
            });
        });
        $("#Modulo").change(function() {
            $("#Modulo option:selected").each(function() {
                idModulo = $(this).val();
                $.post("<?php echo base_url() ?>index.php/PeriodosController/listarByModulo/", {idModulo: idModulo}, function(data) {
                    var datos = JSON.parse(data);
                    $("#bodytablaPeriodos").html(datos.cadena);
                    paginadoPeriodos(datos);
                });
            });
        });
    });
    

    function paginadoPeriodos(data){
        var actual=0,inicial=0;
        if(data.totalPagPer===0){
            actual=0;inicial=0;
        }
        if(data.totalPagPer===0){
            $('#footpagerPeriodos').hide(true);
        }else{
            $('#footpagerPeriodos').show(true);
        }
        $("#txtPagingSearchUsrPeriodos").val(actual);
        $("#pagerBetweenPer").html("/"+data.totalPagPer);
        $("#pagerPeriodos").html("["+ inicial +"-" +data.periodosMos+ "/" +data.totalRegPer+"]");
    }
    
    $("#tablaPeriodos").on("click", "#aFirstPagPeriodos", function (e) {
        paginarPeriodos("data_ini", $(this).data("datainic"));
    });

    $("#tablaPeriodos").on("click", "#aLastPagPeriodos", function (e) {
        paginarPeriodos("data_ini", $(this).data("datainic"));
    });

    $("#tablaPeriodos").on("click", "#aPrevPagPeriodos", function (e) {
        paginarPeriodos("data_inip", null);
    });

    $("#tablaPeriodos").on("click", "#aNextPagPeriodos", function (e) {
        paginarPeriodos("data_inin", null);
    });
    
    function paginarPeriodos(datos, op){
        var mod=$('#Modulo').find(":selected").val();
        var data_in = $('#txtPagingSearchUsrPeriodos').data("datainic");
        
        var url = 'PeriodosController/paginPeriodos/';
        var opcion="";
        if(datos==="data_inin"){
             opcion={"data_inin":data_in, "modulo":mod};
        }else if(datos==="data_inip"){
            opcion={"data_inip":data_in, "modulo":mod};
        }else if(datos==="data_ini"){
            data_in= op;
            opcion={"data_ini":data_in, "modulo":mod};
        }
        var posting = $.post(url, opcion);
        posting.done(function (data) {
            if (data !== null) {
                $('#tablaPeriodos').empty();
                $('#tablaPeriodos').html(data);
            }
        });
        posting.fail(function (data) {
            alert("Error");
        });
    
    }
</script>
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
        <div id="MsjErrorPeriodo"></div>
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
            <?php if($ToTalRegistrosPeriodos!==0){ ?>
            <!--Paginacion-->
             <div class="row">
                <hr>
                <ul class="pager" id="footpagerPeriodos">
                    <li><button data-datainic="1" id="aFirstPagPeriodos" >&lt;&lt;</button></li>
                    <li><button id="aPrevPagPeriodos" >&lt;</button></li>
                    <li>
                        <input data-datainic="1" type="text" value="1" id="txtPagingSearchUsrPeriodos" name="txtNumberPag" size="5">
                        <span id="pagerBetweenPer" style="background: none;margin:0;padding:0;">/<?php echo $totalPaginasPeriodos ?></span>
                    </li>
                    <li><button id="aNextPagPeriodos">&gt;</button></li>
                    <li><button id="aLastPagPeriodos" data-datainic="<?php echo $totalPaginasPeriodos ?>" >&gt;&gt;</button></li>
                    <li id="pagerPeriodos">[<?php echo $PagInicialPeriodos . "-" . count($Periodos) . "/" . $ToTalRegistrosPeriodos ?>]</li>
                </ul>
            </div>
            <!--Fin Paginacion-->
            <?php } ?>
        </div>
    </div>
</div>