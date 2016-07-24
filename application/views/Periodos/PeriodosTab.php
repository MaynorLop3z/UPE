<?php $this->load->helper('url'); ?>
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
        </div>
    </div>
</div>