<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/jquery-ui.js"></script>
<link rel="stylesheet" href="../bootstrap/css/jquery-ui.css">
<script>
    var it='A.M.';var ft='A.M.';
    $(function(){
    var hIH = $('#HorarioInicioHora').spinner({ max: 12, min:1, stop: function( event, ui ) {
//           if($('#HorarioFinHora').val()<$('#HorarioInicioHora').val()){
//               $('#HorarioFinHora').val($('#HorarioInicioHora').val());
//           }
        }});
    $("#HorarioInicioHora").spinner( "option", "numberFormat", "nn" );
    var hFH = $('#HorarioFinHora').spinner({ max: 12, min:1,  stop: function( event, ui ) {
        }});
    var hIM = $('#HorarioInicioMinutos').spinner({ max: 55, min: 0, step: 5});
    var hFM = $('#HorarioFinMinutos').spinner({ max: 55, min: 0, step: 5});
    var hAPI = $('#HoraInicioAmPm').spinner({star: function( event, ui ) {
            it=$(this).val();
    },
    spin: function( event, ui ) { event.preventDefault(); ui.value='';} ,
        stop: function( event, ui ) {
            if(it=='A.M.'){
                $(this).val('P.M.');
                it='P.M.';
            }else{
                it='A.M.';
                $(this).val('A.M.');
            }
    }});
   
    var hAPF = $('#HoraFinAmPm').spinner({star: function( event, ui ) {
            ft=$(this).val();
    },
    spin: function( event, ui ) { event.preventDefault(); ui.value='';} ,
        stop: function( event, ui ) {
            if(ft=='A.M.'){
                $(this).val('P.M.');
                ft='P.M.';
            }else{
                ft='A.M.';
                $(this).val('A.M.');
            }
    }});

    $('#prueba').click(function(){
        alert("Hora: "+$('#HoraFinAmPm').val());
    });
    });
  
</script>
<!------Modal para Agregar Horarios--------->
<div id="ModalHorarioNuevo" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarHorarioNuevo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form  id="formAgregarHorario" action="<?php echo base_url() ?>index.php/HorariosController/agregarHorario/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Nuevo Horario:</legend> 
                         <div class="form-group">
                            <label class="col-lg-3 control-label">Turno:</label>
                            <div class="col-lg-4">
                                      <select class="form-control col-lg-4" name="TurnoHorario" id="TurnoHorario">
                                        <?php
                                        foreach ($Turnos as $t) {
                                            ?>
                                            <option value="<?= $t->CodigoTurno?>">
                                                <?= $t->NombreTurno?>
                                            </option>
                                            <?php
                                        }
                                        ?>   
                                    </select>
                            </div>
                         </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Dia:</label>
                            <div class="col-lg-4">
                                <select class="form-control col-lg-4" name="DiaHorario" id="DiaHorario">
                                    <?php
                                    $dias=array("LUNES"=> LUNES,"MARTES"=>MARTES,"MIÉRCOLES"=>MIERCOLES,
                                        "JUEVES"=>JUEVES,"VIERNES"=>VIERNES,"SÁBADO"=>SABADO,"DOMINGO"=>DOMINGO);
                                    
                                    foreach ($dias as $dia => $i) {
                                        ?>
                                        <option value="<?= $i?>">
                                            <?= $dia ?>
                                        </option>
                                        <?php
                                    }
                                    ?>   
                                </select>
                                 
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="HorarioInicio" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-9">
                                <!--<input type="text" class="form-control" name="AulaNombre" id="AulaNombre" placeholder="Nombre del Aula" maxlength="50" required>-->
                                <p>
                                    <input id="HorarioInicioHora" name="value" placeholder="Horas" value="6" size="4"> : 
                                    <input id="HorarioInicioMinutos" name="value" placeholder="Minutos" value="0" size="4">
                                    <input id="HoraInicioAmPm" value="A.M." size="3">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="HorarioFin" class="col-lg-3 control-label">Fin</label>
                            <div class="col-lg-9">
                                <p>
                                    <input id="HorarioFinHora" name="value" placeholder="Horas" value="8" size="4"> : 
                                    <input id="HorarioFinMinutos" name="value" placeholder="Minutos" value="0" size="4">
                                    <input id="HoraFinAmPm" value="A.M." size="3">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Aula</label>
                            <div class="col-lg-4">
                                <select class="form-control col-lg-4" name="AulaHorario" id="AulaHorario">
                                    <?php
                                    foreach ($Aulas as $aula) {
                                        ?>
                                        <option value="<?= $aula->IdAula ?>">
                                            <?= $aula->NombreAula ?>
                                        </option>
                                        <?php
                                    }
                                    ?>   
                                </select>
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="col-lg-3 control-label">Grupo</label>
                            <div class="col-lg-4">
                                <select class="form-control col-lg-4" name="GrupoHorario" id="GrupoHorario">
                                    <?php
                                    foreach ($GruposPëriodo as $grupoP) {
                                        ?>
                                        <option value="<?= $grupoP->CodigoGrupoPeriodo?>">
                                            <?= $grupoP->CodigoGrupoPeriodo?>
                                        </option>
                                        <?php
                                    }
                                    ?>   
                                </select>
                            </div>
                        </div> 
                        <button type="submit" id="btnAgregarHorario" onclick="" class=" btn btn-default" name="Aceptar">Agregar este horario</button>
                        <span id="mensajeHorarios"></span>
                        <table id="TablaHorario" border="1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Dia</th>
                                    <td>Aula</td>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Quitar</th>
                                </tr>
                            </thead>
                            <tbody id="CuerpoTablaHorario">
                                <?php
                                    foreach ($HxGrupos as $h) {
                                        ?>
                                        <tr id="horario<?=$h->IdHorario?>"><td ><?=$Dias[$h->Dia-1]?></td>
                                        <td ><?=$h->NombreAula?></td>
                                        <td ><?=$h->HoraEntrada?></td>
                                        <td ><?=$h->HoraSalida?></td>
                                        <td> <button type="button" id="DELH<?=$h->IdHorario?>" onclick="eliminarHorario(<?=$h->IdHorario?>)"  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                                        </td></tr>
                                        <?php
                                    }
                                    ?>  
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="reset" id="btnResetAgregarHorario" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                            <button type="button" id="btnGuardarHorario" onclick=""class=" btn btn-default" name="Probar">Listo</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

