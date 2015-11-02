<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Diplomados.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Diplomados</h3>
    </div>
    <div class="panel-body">
      <div class="btn btn-group">
            <button id="BtnADDiplomado" class="btn btn-default btn-default" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span>Diplomado Nuevo</button>
      </div>
      
        
        <table id="tableDiplomados"  class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr><!--Agregar  Mas informacion acerca de los modulos -->
                    <th style="">Diplomado</th> <!-- Nombre de diplomado, Ponerlo que vaya al centro -->
                    <th>Descripcion</th><!-- Coordinador del  diplomado -->
                    <th>Estado</th> <!-- Descripcion del modulo -->
                    <th>Categoria</th>
                   <th>Comentarios</th>  <!-- Comentarios  sobre los diplomados  --> 
                   <th>Gestionar</th>
                <!--</tr>-->
            </thead> 
            <tbody>
                <?php
                foreach ($DiplomadosN as $dip){                
                ?>
                
                <tr  data-dipd='<?php echo json_encode($dip)?>' 
                    id="dip<?php echo $dip->CodigoDiplomado?>">
                    <td class="nombre_Diplomado"><?php echo $dip->NombreDiplomado ?></td>
                    <td class="descripcionDiplomado"><?php echo $dip->Descripcion ?></td>
                    <td class="estado"><?php echo $dip->Estado ?></td>
                    <td class="categoriaDi"><?php echo $dip->CodigoCategoriaDiplomado?></td>
                    <td class="comentarioDi"><?php echo $dip->Comentarios ?></td>
                    <td class="gestion_dip" >
            <button id="editDiplomado<?php echo $dip->CodigoDiplomado ?>" title="Editar Diplomado" class="btnmoddi btn btn-success"><span class=" glyphicon glyphicon-pencil"></span></button>
             <button id="DELDiplomado<?php echo $dip->CodigoDiplomado ?>" title="Eliminar Diplomado" class="btndeldip btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                     </td>
                </tr>
                <?php
                }
                
                ?>     
            </tbody>
        </table>   

    </div>
</div>