

<div class="panel-heading">
    <h3 class="panel-title">Gestion de Publicaciones</h3>
</div>
<div class="panel-body">
    <div class="btn btn-group">
        <button href="#NuevaPublicacion"  class="btn btn-default btn-default" data-toggle="modal">Nueva Publicacion</button>

    </div>
    <table id="tableTitulo"  class="table table-bordered table-striped table-hover table-responsive">
        <thead>
            <tr><!--Agregar  Mas informacion acerca de los modulos -->
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Gestionar</th>

        </thead> 
        <tbody>

            <?php
            foreach ($allPublicaciones as $dip) {
                ?>

                <tr  data-dipd='<?php echo json_encode($dip) ?>' 
                     id="dip<?php echo $dip->CodigoPublicacion ?>">
                    <td class="Titulo"><?php echo $dip->Titulo ?></td>
                    <?php
                    // foreach($listNombreCategoria as $categorialist){
                    $contador = 0;
                    $catPub = "";
                    $categodiplo = $dip->CodigoCategoriaDiplomado;
//                    foreach ($listNombreCategoria as $name) {
//                        $nameCategoriaPubli = $name->CodigoCategoriaDiplomado;
//                        if ($contador == 0) {
//                            if ($categodiplo == $nameCategoriaPubli) {
//                                $catPub = $name->NombreCategoriaDiplomado;
//                                $contador++;
//                                break;
//                            }
//                        }
//                        else {
//                            break;
//                        }
//                    }
                    ?>
                    <td class=" Categoria"><?php echo $dip->NombreCategoriaDiplomado ?></td>
                    <td class="gestion_dip" >
                        <button id="editPublicacion<?php echo $dip->CodigoPublicacion ?>" title="Editar Publicacion" class="btnmoddi btn btn-success"><span class=" glyphicon glyphicon-pencil"></span></button>
                        <button id="delPub<?php echo $dip->CodigoPublicacion ?>" onclick=""  title="Eliminar Publicacion" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>

            <?php }
            ?>    
        </tbody>
    </table>  
</div>

