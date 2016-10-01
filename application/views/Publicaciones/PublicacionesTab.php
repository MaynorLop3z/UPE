
<?php $this->load->helper('url'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title">Gestion de Publicaciones</h3>
</div>
<div class="panel-body">
    <div class="well">
        <button onclick="" id="openNuevaPublicacion" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span>Nueva Publicacion</button>
<!--        <form id="frmfindPublicacion" action="<?php echo base_url() ?>index.php/PublicacionesController/BuscarPublicaciones/"  method="post" class="form-inline" style="float:right;">
            <span>Publicación:</span>    
            <input type="text" class="form-control" name="FindPublicacion" id="FindPublicacion" placeholder="Nombre de la Publicación" required>
            <button id="btnFindPub" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar</button>
        </form>-->
    </div>
     <form id="frmfindPublicacion"  action="" class="form-horizontal" method="post" >
        <fieldset>
            <legend class="modal-header">Buscar Publicación:</legend> 
            <div class="form-group">
                <div class="col-lg-4">
                    <input class="form-control form-inline FindPublicacionClass" placeholder="Nombre" name="FindUsuario" id="FindPublicacionNombre" type="text" maxlength="150" >
                </div>
                <div class="col-lg-4">
                    <input class="form-control form-inline FindPublicacionClass" placeholder="Categoria" id="FindPublicacionCategoria" type="text" maxlength="150" >
                </div>
                <button id="btnCleanSearchPub" class="btn btn-default" style="float:right;margin-right: 20px;"><span class="glyphicon glyphicon-refresh"></span>Limpiar Búsqueda</button> 
            </div>
        </fieldset>
    </form>
       <!--tabla de publicaciones solo muestra el titulo y la categoria-->
    <div id="TablaPublicacionesWeb">
    <table id="tableTitulo"  class="table table-bordered table-striped table-hover table-responsive">
        <thead>
            <tr><!--Informacion a mostrar de las publicaciones-->
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Gestionar</th>
            </tr>
        </thead> 
        <tbody>

            <?php
            foreach ($allPublicaciones as $publi) {
                ?>

                <tr  data-dipd='<?php echo json_encode($publi) ?>' 
                     id="diplo<?php echo $publi->CodigoPublicacion ?>">
                    <td class="Titulo" id="TutuloPubTabla<?php echo $publi->CodigoPublicacion ?>"><?php echo $publi->Titulo ?></td>
                    <td class=" Categoria" id="CategoriaPubTabla<?php echo $publi->CodigoPublicacion ?>"><?php echo $publi->NombreCategoriaDiplomado ?></td>
                    <td class="gestion_dip" >
                        <button id="editPublicacion<?php echo $publi->CodigoPublicacion ?>" onclick="editarPublicacion('<?php echo $publi->CodigoPublicacion ?>')" title="Editar Publicacion" class="btnmoddi btn btn-success"><span class=" glyphicon glyphicon-pencil"></span></button>
                        <button id="delPub<?php echo $publi->CodigoPublicacion ?>" onclick="eliminarPublicacion('<?php echo $publi->CodigoPublicacion ?>','<?php echo $publi->Titulo ?>')" title="Eliminar Publicacion" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>

            <?php }
            ?>    
        </tbody>
    </table> 
        <?php if( $ToTalRegistrosPubWeb!==0){ ?>
        <!--Paginacion-->
             <div class="row">
                <hr>
                <ul class="pager" id="footpagerPubWeb">
                    <li><button data-datainic="1" id="aFirstPagPubWeb" >&lt;&lt;</button></li>
                    <li><button id="aPrevPagPubWeb" >&lt;</button></li>
                    <li>
                        <input data-datainic="1" type="text" value="1" id="txtPagingSearchUsrPubWeb" name="txtNumberPag" data-mask="000000000" size="5">
                        <span id="pagerBetweenPubWeb" style="background: none;margin:0;padding:0;">/<?php echo $totalPaginasPubWeb ?></span>
                    </li>
                    <li><button id="aNextPagPubWeb">&gt;</button></li>
                    <li><button id="aLastPagPubWeb" data-datainic="<?php echo $totalPaginasPubWeb ?>" >&gt;&gt;</button></li>
                    <li id="pagerPubWeb">[<?php echo $PagInicialPubWeb . "-" . count($allPublicaciones) . "/" . $ToTalRegistrosPubWeb ?>]</li>
                </ul>
            </div>
        <!--Fin Paginacion-->
        <?php } ?>
    </div>
</div>
</div>
