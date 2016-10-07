<script src="../bootstrap/js/Aulas.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Aulas</h3>
    </div>
    <div class="panel-body">
        <div class="row well">
            <div class="col-md-6">
                <button  id="btnAbrirAgregarAula" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Aula Nueva</button>
            </div>
        </div>
        <form id="frmfindAulas"  action="" class="form-horizontal" method="post" >
        <fieldset>
            <legend class="modal-header">Buscar Aula:</legend> 
            <div class="form-group">
                <div class="col-lg-4">
                    <input class="form-control form-inline FindAulasClass" placeholder="Nombre" name="FindAulasNombre" id="FindAulasNombre" type="text" maxlength="150" >
                </div>
                <div class="col-lg-4">
                    <input class="form-control form-inline FindAulasClass" placeholder="Tipo" id="FindAulasTipo" type="text" maxlength="150" >
                </div>
                <button id="btnCleanSearchAulas" class="btn btn-default" style="float:right;margin-right: 20px;"><span class="glyphicon glyphicon-refresh"></span>Limpiar Búsqueda</button> 
            </div>
        </fieldset>
    </form>
        <div id="AulasListContent">
            <table border="1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Aula</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Gestión</th>
                    </tr>
                </thead>
                <tbody id="bodytablaAulas">
                    <?php foreach($Aulas as $aula){
                        echo '<tr id="Aula-'.$aula->IdAula.'">
                              <td >'.$aula->NombreAula.'</td>';
                        echo '<td >'.$aula->Descripcion.'</td>';
                        echo '<td class="Mail_Alumno">'.$aula->TipoAula.'</td>
                              </td>';
                        echo '<td><button id="btnEditAula'.$aula->IdAula.'" onclick="editarAula(\''.$aula->NombreAula.'\',\''.$aula->IdAula.'\',\''.$aula->Descripcion.'\',\''.$aula->TipoAula.'\')" title="Editar Aula" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
                                <button id="btnDeleteAula'.$aula->IdAula.'" onclick="eliminarAula(\''.$aula->NombreAula.'\',\''.$aula->IdAula.'\')"  title="Eliminar Aula" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                                </td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            
            <?php if( $Aulas>ROWS_PER_PAGE){ ?>
        <!--Paginacion-->
             <div class="row">
                <hr>
                <ul class="pager" id="footpagerAulas">
                    <li><button data-datainic="1" id="aFirstPagAulas" >&lt;&lt;</button></li>
                    <li><button id="aPrevPagAulas" >&lt;</button></li>
                    <li>
                        <input data-datainic="1" type="text" value="1" id="txtPagingSearchAulas" name="txtNumberPag" data-mask="000000000" size="5">
                        <span id="pagerBetweenAulas" style="background: none;margin:0;padding:0;">/<?php echo $totalPaginasAulas?></span>
                    </li>
                    <li><button id="aNextPagAulas">&gt;</button></li>
                    <li><button id="aLastPagAulas" data-datainic="<?php echo $totalPaginasAulas ?>" >&gt;&gt;</button></li>
                    <li id="pagerAulas">[<?php echo "1 -" . count($Aulas) . "/" . $totalAulas ?>]</li>
                </ul>
            </div>
        <!--Fin Paginacion-->
        <?php } ?>
        </div>
     </div>
</div>