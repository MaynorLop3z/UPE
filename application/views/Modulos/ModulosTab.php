<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Modulos.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Modulos</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <button  id="btnAddModulo" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Nuevo Modulo</button>
                <button  id="btnActualizar" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Actualizar</button>
            </div>
            <div class="col-md-6">
                <?php $this->load->helper('url'); ?>
                <form id="frmfindDipl" action="<?php echo base_url() ?>index.php/ModulosController/BuscarModulos/"  method="post" class="form-inline">
                    <span>Diplomado:</span>
                    
                               
                                      
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
                            <th>Orden</th>
                            <th>Estado</th>
                            <th>Turno</th>
                            <th>Diplomado</th>
                            <th>Comentario</th>
                            <th>Gestion</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        foreach ($Modulos as $Mod) {
                            ?>
                        
                        <tr data-ModM='<?php echo json_encode($Mod)?>' id="Mod<?php echo $Mod->CodigoModulo?>">
                                <td class="NombreMod"><?php echo $Mod->NombreModulo ?></td>
                                <td class="ordenMo"><?php echo $Mod->OrdenModulo?></td>
                                <td class="Estado"><?php echo $Mod->Estado?></td> 
                                <td class="TurnoM"><?php echo $Mod->CodigoTurno?></td>
                                <td class="DipName"><?php echo $Mod->CodigoDiplomado?></td>
                                <td class="ComenMo"><?php echo $Mod->Comentarios?></td>
                                <td class="gestion_Mod">
            <button id="btnModiM<?php echo $Mod->CodigoModulo ?>" onclick="editModulo(this)" title="Editar Modulo" class="btn_modificar_Mod btn btn-success" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>
            <button id="btnDELM<?php echo $Mod->CodigoModulo ?>" onclick="delMo(this)" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash" class="btn btn-info btn-lg"></span></button>
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