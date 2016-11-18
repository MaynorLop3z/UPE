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
                            <label for="NoRecibo" class="col-lg-3 control-label">No. Recibo:</label>
                            <div class="col-lg-6">
                                <input type="text" class="onlyLettersS form-control"  name="NoRecibo" id="NoRecibo" placeholder="No. Recibo"  maxlength="100" required>
                            </div>                                  
                        </div> 
                        <div class="col-lg-12 form-group">
                            <label for="MontoPago" class="col-lg-3 control-label">Monto:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MontoPago" id="MontoPago" placeholder="Monto" maxlength="100" required>
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
                <div class="col-lg-2">
                    <button type="button" id="btnRegistrPago" onclick="ejecutarPago()" class=" btn btn-default" name="btnRegistrPago">Registrar</button>                 
                </div>
                <div class="col-lg-2">
                    <button type="reset" id="btnCerrarDePag" onclick="cerrarDivPagosDet()" class=" btn btn-default" name="Limpiar">Cerrar</button>
                </div>
                <!--<button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>-->
            </div>
        </div>
    </form>


</div>