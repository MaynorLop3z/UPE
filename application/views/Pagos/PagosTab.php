<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Pagos.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Pagos</h3>
    </div>
    <div class="panel-body">
        <div id="mensajes">

        </div>
        <div class="panel panel-default">
            <form id="frmSearchAlum"  action="PagosController/buscarAlum" class="form-horizontal" method="post" >
                <fieldset>
                    <legend class="modal-header">Buscar Alumno:</legend> 
                    <div class="form-group">
                        <div class="col-lg-4">
                            <input name="NombreParticipan" class="form-control form-inline" placeholder="Nombre" id="txtNombAlum" type="text" maxlength="50" >
                        </div>
                        <div class="col-lg-4">
                            <input name="CarnetParticipan" class="form-control form-inline" placeholder="Carnet" id="txtCarnetAlum" type="text" maxlength="50" >
                        </div>
                        <div class="col-lg-4">
                            <input name="DuiParticipan" class="form-control form-inline" placeholder="DUI" id="txtDuiAlum" type="text" maxlength="50" >
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" id="btnSearchAlum" onclick="" class=" btn btn-default" name="Buscar">Buscar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <br>
        <div id="containerTablePagingPag">
            <table id="tableParticipantesPag" class="table table-bordered table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="text-align:center">Nombre</th>
                        
                    </tr>
                </thead> 
                <tbody>
                    <?php
//                    foreach ($Usuarios as $user) {
                        ?>
                        <tr data-alum='<?php echo('CodigoUsuario') ?>' id="tr<?php echo 'CodigoUsuario' ?>">
                            <td class="nombre_Usuario" ><?= '' ?></td>
                            
                            
                        </tr>
                        <?php
//                    }
                    ?>
                </tbody>
            </table>
            
            <div class="row">
                <hr>
                <ul class="pager">
                    <li><button data-datainic="1" id="aFirstPag" >&lt;&lt;</button></li>
                    <li><button id="aPrevPag" >&lt;</button></li>
                    <li><input data-datainic="1" type="text" value="1" id="txtPagingSearchUsr" name="txtNumberPag" size="5">/<?php echo $totalPaginas ?></li>
                    <li><button id="aNextPag">&gt;</button></li>
                    <li><button id="aLastPag" data-datainic="<?php echo $totalPaginas ?>" >&gt;&gt;</button></li>
                    <li>[<?php echo $PagInicial . "-" . count(0) . "/" . $ToTalRegistros ?>]</li>
                </ul>
            </div>

            <!--<div class="panel-footer">Panel footer</div>-->
        </div><!--Fin container table paging-->
    </div>
</div>