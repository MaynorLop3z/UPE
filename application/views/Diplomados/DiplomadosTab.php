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
            <button id="btnActualizarDi" class="btn btn-default" onclick="window.location.reload()"><span class="glyphicon glyphicon-refresh"></span>Actualizar</button>
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
       

        
        <table id="tableDiplomados"  class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr><!--Agregar  Mas informacion acerca de los modulos -->
                    <th style="text-align:center">Diplomado</th> <!-- Nombre de diplomado, Ponerlo que vaya al centro -->
                    <th style="text-align:center">Descripcion</th><!-- Coordinador del  diplomado -->
                    <th style="text-align:center">Estado</th> <!-- Descripcion del modulo -->
                    <th style="text-align:center">Categoria</th>
                   <th style="text-align:center">Comentarios</th>  <!-- Comentarios  sobre los diplomados  --> 
                   <th style="text-align:center">Gestionar</th>
                <!--</tr>-->
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
             <button id="Addmod<?php echo $dip->CodigoDiplomado ?>" onclick="AddMod()"  title="Agregar Modulos" class="btndeldip btn btn-default" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
                     </td>
                </tr>
                <?php
                }
                
                ?>     
            </tbody>
        </table>   

    </div>
</div>