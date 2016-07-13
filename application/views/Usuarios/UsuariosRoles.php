<?php $this->load->helper('url'); ?>
<div id="usuarioRoles" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <form id="frmRolUser" action="<?php echo base_url() ?>index.php/UsuarioController/AplyRmvRols/" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header">Asignación de roles:</legend> 
                        <div class="form-group">
                            <table id="tableRUsers" class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Rol</th>
                                        <th style="text-align:center" >Asigado</th>
                                    </tr>
                                </thead> 
                                <tbody id="bodyTableUsrRol">

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  data-dismiss="modal" class=" btn btn-default" name="Cancelar">Cancelar</button>
                            <button type="submit" id="btnEnviarUR" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>   
    </div>
</div>