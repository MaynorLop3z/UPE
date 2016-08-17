

<div class="panel-heading">
    <h3 class="panel-title">Gestion de Publicaciones</h3>
</div>
<div class="panel-body">
    <div class="btn btn-group">
        <button href="#NuevaPublicacion"  class="btn btn-default btn-default" data-toggle="modal">Nueva Publicacion</button>

    </div>
    <!--tabla de publicaciones solo muestra el titulo y la categoria-->
    <table id="tableTitulo"  class="table table-bordered table-striped table-hover table-responsive">
        <thead>
            <tr><!--Informacion a mostrar de las publicaciones-->
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Gestionar</th>

        </thead> 
        <tbody>

            <?php
            foreach ($allPublicaciones as $publi) {
                ?>

                <tr  data-dipd='<?php echo json_encode($publi) ?>' 
                     id="diplo<?php echo $publi->CodigoPublicacion ?>">
                    <td class="Titulo"><?php echo $publi->Titulo ?></td>
                    <td class=" Categoria"><?php echo $publi->NombreCategoriaDiplomado ?></td>
                    <td class="gestion_dip" >
                        <button id="editPublicacion<?php echo $publi->CodigoPublicacion ?>" title="Editar Publicacion" class="btnmoddi btn btn-success"><span class=" glyphicon glyphicon-pencil"></span></button>
                        <button id="delPub<?php echo $publi->CodigoPublicacion ?>" onclick="eliminarPublicacion('<?php echo $publi->CodigoPublicacion ?>','<?php echo $publi->Titulo ?>')" title="Eliminar Publicacion" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>

            <?php }
            ?>    
        </tbody>
    </table>  
</div>

