<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Modulos.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Modulos</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <button  id="btnAddModulo" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Nuevo Modulo</button>
            </div>
            <div class="col-md-8">
                <?php $this->load->helper('url'); ?>
                <form id="frmfindDipl" action="<?php echo base_url() ?>index.php/ModulosController/buscar/"  method="post" class="form-inline">
                    <span>Diplomado:</span>
                    <input type="text" class="form-control" id="tbDipBuscar" name="DipBuscado" placeholder="Escriba el Diplomado a buscar" required>                
                    <button id="btnFindDip" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar Por Diplomado</button>
                </form>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <table id="tableModulos" class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Modulo</th>
                            <th>Diplomado</th>
                            <th>Estado</th>
                            <th>Comentario</th>
                            <th>Gestion</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        foreach ($Modulos as $Mod) {
                            ?>
                            <tr id="alum<?= $alum->CodigoParticipante ?>">
                                <td class="NombreMod"><?= $Mod->NombreModulo ?></td>
                                <td class=""><?= $Mod->NombreDiplomado?></td>
                                <td class=""><?= $Mod->Estado?></td>
                                <td class=""><?= $Mod->Comentarios?></td>
                                <td class="gestion_Mod">
                                    <button id="ModEdit<?php echo $Mod->CodigoModulo ?>" onclick="" title="Editar Modulo" class="btn_modificar_Mod btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                                    <button id="ModDel<?php echo $Mod->CodigoModulo ?>" onclick="" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                     </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>