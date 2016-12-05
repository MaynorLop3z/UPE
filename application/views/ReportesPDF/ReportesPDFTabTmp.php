<?php $this->load->helper('url'); ?>
<!--<script src="../bootstrap/js/Pagos.js"></script>-->
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
                        <div class="col-lg-3">
                            <input name="NombreParticipan" class="form-control form-inline" placeholder="Nombre" id="txtNombAlum" type="text" maxlength="50" >
                        </div>
                        <div class="col-lg-3">
                            <input name="CarnetParticipan" class="form-control form-inline" placeholder="Carnet" id="txtCarnetAlum" type="text" width="20%" maxlength="20" >
                        </div>
                        <div class="col-lg-3">
                            <input name="DuiParticipan" class="form-control form-inline" placeholder="DUI" id="txtDuiAlum" type="text" maxlength="10" >
                        </div>
                        <div class="col-lg-3">
                            <select name="AnioParticipan" class="form-control" id="anioMod">
                                <?php
                                $anio = date("Y") - 5;
                                for ($i = 0; $i < 10; $i++) {
                                    $anio = $anio + 1;
                                    if ($i == 0) {
                                        echo ' <option value=0 >Seleccione un a&ntilde;o</option>';
                                    } else {
                                        echo '<option value=' . $anio . ' >' . $anio . '</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" id="btnSearchAlum" onclick="" class=" btn btn-default" name="Buscar">Buscar</button>
            </form>
        </div>
        <br>
        <div id="containerTablePagingPag">
                <table id="tableParticipantesPag" class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th style="text-align:center;font-size: large">Nombre</th>
                            <th style="text-align:center;font-size: large">Diplomado</th>
                            <th style="text-align:center;font-size: large">Modulo</th>
                            <th style="text-align:center;font-size: large">Estado</th>
                        </tr>
                    </thead> 
                    <tbody>

                    </tbody>
                </table>
            
            <!--<div class="panel-footer">Panel footer</div>-->
        </div><!--Fin container table paging-->
        <div id="containerDetPag">
            
        </div>
    </div>
</div>