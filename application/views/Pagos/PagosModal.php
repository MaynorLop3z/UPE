<?php $this->load->helper('url'); ?>
<div> 
    <form id="frmPago" action="<?php echo base_url() ?>index.php/PagosController/registrarPago/" class="form-horizontal" method="post" >
        <fieldset>
            <legend class="modal-header">
                Agregar Pago:
            </legend> 
            <div class="row">

                <!--- --><div class="col-lg-6">
                    <div class="form-group">
                        <label for="NoRecibo" class="col-lg-3 control-label">No. Recibo:</label>
                        <div class="col-lg-6 ">
                            <input type="text" class="onlyLettersS form-control"  name="NoRecibo" id="NoRecibo" placeholder="No. Recibo"  maxlength="100" required>
                        </div>
                        <div class="col-lg-3">
                            <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="MontoPago" class="col-lg-3 control-label">Monto:</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="MontoPago" id="MontoPago" placeholder="Monto" maxlength="100" required>
                        </div>
                        <div class="col-lg-3">
                            <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                        </div>
                    </div>
                    <!--- --></div>
                <!---Finalizan las primeras columnas --><div class="col-lg-6">
                    <div class="form-group">
                        <label for="grupo" class="col-lg-10 control-label">Grupo:</label>
                        <div class="col-lg-6">
                            <div id="grupo" class="form-control">grupo</div>
                        </div>
                        <div class="col-lg-3">
                            <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="periodoMod" class="col-lg-5 control-label">Periodo del modulo:</label>
                        <div class="col-lg-6">
                            <div id="periodoMod" class="form-control">fecha</div>
                        </div>
                        <div class="col-lg-3">
                            <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnRegistrPago" onclick="" class=" btn btn-default" name="Aceptar">Registrar</button>
                <button type="reset" id="btnCerrarDePag" onclick="" class=" btn btn-default" name="Limpiar">Cerrar</button>
                <!--<button type="button" id="btnCerrar" data-dismiss="modal" class=" btn btn-default" name="Cerrar">Cerrar</button>-->
            </div>

        </fieldset>
    </form>
</div>