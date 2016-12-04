<?php $this->load->helper('url'); ?>
<div> 
    <form id="frmPago" action="PagosController/registrarPago/" class="form-horizontal" method="post" >
        <div class="panel panel-default">
            <fieldset>
                <legend class="modal-header">
                    Registrar    Pago:
                </legend> 
                <div class="row ">
                    <div class=" col-lg-4 b-r">                    
                        <div class="col-lg-12 form-group">
                            <label for="NoRecibo" class="col-lg-5 label-control">No. Recibo:</label>
                            <div class="col-lg-7">
                                <input type="text" value="<?php echo $NumeroRecibo ?>" class="onlyLettersS form-control"  name="NoRecibo" id="NoRecibo"  placeholder="No. Recibo"  maxlength="100" required>
                            </div>                                  
                        </div> 
                        <div class="col-lg-12 form-group">
                            <label for="MontoPago" class="col-lg-5 label-control">Monto:</label>
                            <div class="col-lg-7">
                                <input type="text" value="<?php echo $MontoPago ?>" class="form-control" name="MontoPago" id="MontoPago" placeholder="Monto" maxlength="100" required>
                            </div>
                        </div>  
                        <input type="hidden" name="CodGrupPar" id="codGrupPar" value="<?PHP echo $CodGrupPar ?>" />
                    </div>
                    <!---Finalizan las primeras columnas -->
                    <div class=" col-lg-7 b-l">
                        <div class="col-lg-12 form-group">
                            <label  class="col-lg-12"><h4><b>Aula: </b> <?PHP echo $Aula ?></h4></label>                           
                        </div>    
                        <div class="col-lg-12 form-group">
                            <label  class="col-lg-12"><h4><b>Horario: </b> <?PHP echo $HoraEntrada . ' - ' . $HoraSalida ?></h4></label>                           
                        </div>  
                        <div class="col-lg-12 form-group">
                            <label  class="col-lg-12"><h4><b>Periodo del modulo: </b> <?PHP echo $FechaIniP . ' - ' . $FechaFinP ?></h4></label>                            
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </fieldset>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if ($NumeroRecibo != null) {
                    echo '<input type="hidden" value="' . $NumeroRecibo . '" name="editarPg" id="editarPg"';
                }
                ?>
                <!--?php if($NumeroRecibo==null){ ?-->
                <div class="col-lg-2">
                    <button type="button" id="btnRegistrPago" onclick="ejecutarPago()" class=" btn btn-default" name="btnRegistrPago">Registrar</button>                 
                </div>
                <div class="col-lg-2">
                    <!--?php }else{ ?-->
                    <div class="col-lg-12">
                        <!--?php }?-->

                        <button type="reset" id="btnCerrarDePag" onclick="cerrarDivPagosDet()" class=" btn btn-default" name="Limpiar">Cerrar</button>
                    </div>
                    <!--<button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>-->
                </div>
                <?php
                if ($EditarPg != null) {
                    echo '<div style="color:blue;font-size:200%;">Pago editado correctamente</div>';
                }else{
                    echo'  <div  id="divMsgExito" style="color:blue;font-size:200%;"></div> ';
                }
                ?>
                
            </div>
    </form>


</div>
</div>