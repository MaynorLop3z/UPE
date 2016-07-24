<?php $this->load->helper('url'); ?>
<div id="rolesPermisos" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form id="frmRolRight" action="RolesController/AplyRmvRights/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Asignación de permisos:</legend> 
                        <div class="form-group">
                            <table id="tablePRols" class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Permisos</th>
                                        <th style="text-align:center">Controlador Contenedor</th>
                                        <th style="text-align:center" >Asigado</th>
                                    </tr>
                                </thead> 
                                <tbody id="bodyTableRolRights">
                                 
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviarPR" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="reset" id="btnLimpiarPR" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>