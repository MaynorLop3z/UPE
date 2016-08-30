<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Modulos.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Modulos</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <!--<div class="col-md-6">
           <button  id="btnAddModulo" class="btn btn-default"  onclick="AddMod(this)" ><span class="glyphicon glyphicon-plus"></span> Nuevo Modulo</button> -->
                <!--<button  id="btnActualizar" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Actualizar</button>
            </div>-->
            <div class="col-md-6">
                <?php $this->load->helper('url'); ?>
                <form id="frmfindMod" action="<?php echo base_url() ?>index.php/ModulosController/BuscarModulos/"  method="post" class="form-inline">
                    <span>Modulo:</span>    
                    <input type="text" class="form-control" name="FindModulo" id="FindModulo" placeholder="Nombre del Modulo" required>
                    <button id="btnFindDip" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar Modulo</button>
                </form>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div id="tablaModulosContent">
                <table id="tableModulos" class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Modulo</th>
                            <th>Correlativo</th>
                            <th>Estado</th>
                            <th>Turno</th>
                            <th>Diplomado</th>
                            <th>Comentario</th>
                            <th>Gestion</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        foreach ($Modulos as $mod) {
                            ?>
                        
                                              
                        <tr id="mod<?= $mod->CodigoModulo?>">
                                <td class="NombreMod"><?= $mod->NombreModulo ?></td>
                                <td class="ordenMo"><?= $mod->OrdenModulo?></td>
                                <td class="Estado"><?=  $mod->Estado?></td> 
                                <td class="TurnoM"><?= $mod->CodigoTurno?></td>
                                <td class="DipName"><?= $mod->CodigoDiplomado?></td>
                                <td class="ComenMo"><?= $mod->Comentarios?></td>
                                <td class="gestion_Mod">
            <button id="btnModiM<?php echo $mod->CodigoModulo ?>" onclick="editModulo(this)" title="Editar Modulo" class="btn_modificar_Mod btn btn-success" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>
            <button id="btnDELM<?php echo $mod->CodigoModulo ?>" onclick="delMo(this)" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash" class="btn btn-info btn-lg"></span></button>
                                     </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!--Paginacion-->
                <div class="row">
                   <hr>
                   <ul class="pager" id="footpagerModulos">
                       <li><button data-datainic="1" id="aFirstPagModulos" >&lt;&lt;</button></li>
                       <li><button id="aPrevPagModulos" >&lt;</button></li>
                       <li>
                           <input data-datainic="1" type="text" value="1" id="txtPagingSearchModulos" name="txtNumberPag" size="5">/<?php echo $totalPaginasModulos?>
                       </li>
                       <li><button id="aNextPagModulos">&gt;</button></li>
                       <li><button id="aLastPagModulos" data-datainic="<?php echo $totalPaginasModulos ?>" >&gt;&gt;</button></li>
                       <li id="pagerModulos">[<?php echo $PagInicialModulos . "-" . count($Modulos) . "/" . $ToTalRegistrosModulos ?>]</li>
                   </ul>
                </div>
                <!--Fin Paginacion-->
                </div>
            </div>
        </div>
    </div>
</div>