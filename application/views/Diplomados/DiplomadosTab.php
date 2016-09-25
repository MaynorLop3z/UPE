<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Diplomados.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Diplomados</h3>
    </div>
    <div class="panel-body">
        <div class="row">
        <div class="col-md-6">
            <button id="BtnADDiplomado" class="btn btn-default btn-default" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span>Nuevo Diplomado </button>
            <button id="btnActualizarDi" class="btn btn-default" onclick=""><span class="glyphicon glyphicon-refresh"></span>Actualizar</button>
        </div>
        <div class="col-md-6">
            <?php $this->load->helper('url'); ?>
            <form id="frmfindDip" action="<?php echo base_url() ?>index.php/DiplomadosController/BuscarDiplomados/"  method="post" class="form-inline">
                <span>Diplomados:</span>    
                <input type="text" class="form-control" name="FindDiplomado" id="FindDiplomado" placeholder="Nombre del Diplomado" required>
                <button id="btnFindDip" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar Diplomado</button>
            </form>
        </div>
        </div>
        <br>
       

        <div id="tablaDiplomadosContent">
        <table id="tableDiplomados"  class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr><!--Agregar  Mas informacion acerca de los modulos -->
                    <th style="text-align:center">Diplomado</th> <!-- Nombre de diplomado, Ponerlo que vaya al centro -->
                    <th style="text-align:center">Descripcion</th><!-- Coordinador del  diplomado -->
                    <th style="text-align:center">Estado</th> <!-- Descripcion del modulo -->
                    <th style="text-align:center">Categoria</th>
                   <th style="text-align:center">Comentarios</th>  <!-- Comentarios  sobre los diplomados  --> 
                   <th style="text-align:center">Gestionar</th>
                </tr>
            </thead> 
            <tbody>
                <?php
//                if($DiplomadoN ==null){
//                    echo "es nulo";
//                }
                foreach ($Diplomados as $dip){                
                ?>
                
                <tr id="dip<?=  $dip->CodigoDiplomado?>">
                    <td class="nombre_Diplomado"><?= $dip->NombreDiplomado ?></td>
                    <td class="descripcionDiplomado"><?= $dip->Descripcion ?></td>
                    <td class="estado"><?php echo $dip->Estado ?></td>
                    <td class="categoriaDi"><?php echo $dip->NombreCategoriaDiplomado?></td>
                    <td class="comentarioDi"><?php echo $dip->Comentarios ?></td>
                    <td class="gestion_dip" >
            <button id="btnmo<?php echo $dip->CodigoDiplomado ?>" onclick="editaDiplomado(this)" title="Editar Diplomado" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
            <button id="DELDiplomado<?php echo $dip->CodigoDiplomado ?>" onclick="eliminarDiplomado(this)"  title="Eliminar Diplomado" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
            <button id="Addmod<?php echo $dip->CodigoDiplomado ?>" onclick="AddModDip(<?= $dip->CodigoDiplomado ?>)"  title="Agregar Modulos" class="btnAddMod btn btn-info" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
            <button id="ModView<?php echo $dip->CodigoDiplomado?>" onclick="listarModulosByDiplomado(this)"  title="Ver modulos" class="btnVIewMod btn btn-warning" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-eye-open" ></span></button>       
                    </td>
                </tr>
                <?php
                }
                
                ?>     
            </tbody>
        </table> 
            <?php if($ToTalRegistrosDiplomados!==0){ ?>
            <!--Paginacion-->
             <div class="row">
                <hr>
                <ul class="pager" id="footpagerDiplomados">
                    <li><button data-datainic="1" id="aFirstPagDiplomados" >&lt;&lt;</button></li>
                    <li><button id="aPrevPagDiplomados" >&lt;</button></li>
                    <li>
                        <input data-datainic="1" type="text" value="1" id="txtPagingSearchDiplomados" name="txtNumberPag" data-mask="000000000" size="5">/<?php echo $totalPaginasDiplomados ?>
                    </li>
                    <li><button id="aNextPagDiplomados">&gt;</button></li>
                    <li><button id="aLastPagDiplomados" data-datainic="<?php echo $totalPaginasDiplomados ?>" >&gt;&gt;</button></li>
                    <li id="pagerDiplomados">[<?php echo $PagInicialDiplomados . "-" . count($Diplomados) . "/" . $ToTalRegistrosDiplomados ?>]</li>
                </ul>
            </div>
            <!--Fin Paginacion-->
            <?php } ?>
        </div>
    </div>
</div>