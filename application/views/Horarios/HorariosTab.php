<script src="../bootstrap/js/Horarios.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Horarios</h3>
    </div>
    <div class="panel-body">
        <div class="row well">
        <form class="form-horizontal" name="HolariosTurnosList" action="" method="POST">        
                <div class="form-group">
                    <label for="TurnosList" class="col-lg-1 control-label">Turno: </label> 
                    <div class="col-lg-4 ">
                        <select class="form-control" name="TurnosList" id="TurnosList">
                            <?php
                            foreach ($Turnos as $turno) {
                                ?>
                                <option value="<?= $turno->CodigoTurno ?>">
                                    <?= $turno->NombreTurno ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>          
        </form>
        </div>
        
        <div id="GruposListContent">
            <h4 id="gruposListTurno">Grupos, Turno</h4>
            <table border="1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <!--<th>Codigo</th>-->
                        <th>Grupo</th>
                        <th>Modulo</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                        <th>Aula</th>
                        <th>Periodo</th>
                        <th>Configuracion</th>
                        <!--<th>Alumnos</th>-->
                    </tr>
                </thead>
                <tbody id="bodytablaGruposTurno">
                    <?php //foreach($Grupos as $grupo){
//                        echo '<tr id="grHor">
//                                <td class="Mail_Alumno">'.$grupo->CodigoGrupoPeriodo.'</td>
//                              </td>';
                    //}
                    ?>
                </tbody>
            </table>
        </div>
     </div>
</div>