<script src="../bootstrap/js/Horarios.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Horarios</h3>
    </div>
    <div class="panel-body">
        <div class="row well">
            <div class="col-md-6">
                <button  id="btnAbrirAgregarHorario" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span>Agregar Horario</button>
            </div>
        </div>
        <div class="row well">
        <form class="form-horizontal" name="HolariosTurnosList" action="" method="POST">        
                <div class="form-group">
                    <label for="TurnosList" class="col-lg-1 control-label">Turno: </label> 
                    <div class="col-lg-4 ">
                        <select class="form-control" name="TurnosList" id="TurnosList">
                            <option value="NULL" >TODOS</option>
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
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                        <th>Aula</th>
                        <th>Dia</th>
                        <th>Tipo Jornada</th>
                        <th>Configuracion</th>
                    </tr>
                </thead>
                <tbody id="bodytablaGruposTurno">
                    <?php foreach($Grupos as $grupo){
                        echo '<tr id="horario'.$grupo->IdHorario.'">
                              <td class="horario">'.$grupo->CodigoGrupoPeriodo.'</td>';
                        echo '<td class="horario">'.$grupo->HoraEntrada.'</td>';
                        echo '<td class="horario">'.$grupo->HoraSalida.'</td>';
                        echo '<td class="horario">'.$grupo->NombreAula.'</td>';
                        echo '<td class="horario">'.$Dias[$grupo->Dia-1].'</td>';
                        echo '<td class="horario">'.$grupo->NombreTurno.'</td>';
//                        echo '<td class="horario">'.$grupo->FechaInicioPeriodo.' - '.$grupo->FechaFinPeriodo.'</td>
//                              </td>';
                        echo '<td><button id="btnmo" onclick="" title="Editar Horario" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
                                <button type="button" id="DELH" onclick="eliminarHorario('.$grupo->IdHorario.')"  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                                </td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
     </div>
</div>