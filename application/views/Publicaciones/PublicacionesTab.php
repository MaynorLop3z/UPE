
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Publicaciones</h3>
    </div>
    <div class="panel-body">
        <div class="btn btn-group">
            <button href="#NuevaPublicacion"  class="btn btn-default btn-default" data-toggle="modal">Nueva Publicacion</button>
            <button href="#ModificarPublicacion" class="btn btn-default btn-default" data-toggle="modal">Modificar Publicacion</button>
            <button href="#EliminarPublicacion" class="btn btn-default btn-default" data-toggle="modal">Eliminar Publicacion</button>
        </div>
        <table id="tableTitulo"  class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr><!--Agregar  Mas informacion acerca de los modulos -->
                    <th>Titulo</th> <!-- Nombre de diplomado, Ponerlo que vaya al centro -->

            </thead> 
            <tbody>
                <?php
                foreach ($TituloN as $dip) {
                    ?>
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
                foreach ($TituloN as $dip){                
                ?>
                
                <tr  data-dipd='<?php echo json_encode($dip)?>' 
                    id="dip<?php echo $dip->CodigoPublicacion?>">
                    <td class="Titulo"><?php echo $dip->Titulo ?></td>
                                        <td class="gestion_dip" >
            <button id="editTitulo<?php echo $dip->CodigoPublicacion ?>" title="Editar Titulo" class="btnmoddi btn btn-success"><span class=" glyphicon glyphicon-pencil"></span></button>

                     </td>
                </tr>
                <?php
                }
                
                ?>     
            </tbody>
        </table>  
              
                <?php
            }
            ?>     
            </tbody>
        
            
    </div>
</div>