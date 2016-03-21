<script src="../bootstrap/js/Roles.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Roles</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <form id="frmGuardarR"  action="RolesController/persistRol" class="form-horizontal" method="post" >
                <fieldset>
                    <legend class="modal-header">Agregar Nuevo Rol:</legend> 
                    <div class="form-group">
                        <label for="txtNombRol" class="col-lg-4 control-label">Nombre del Rol:</label>
                        <div class="col-lg-4">
                            <input name="RolName" class="form-control" id="txtNombRol" type="text" maxlength="50" required>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" id="btnEnviarR" onclick="" class=" btn btn-default" name="Guardar">Guardar</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>

        <div class="panel panel-default">
            <table id="tableRol" class="table table-bordered table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="text-align:center" >Nombre de Rol</th>
                        <th style="text-align:center" >Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    foreach ($RolesList as $rol) {
                        ?>
                        <tr data-rold='<?php echo json_encode($rol) ?>' id="tr<?php echo $rol->CodigoRol ?>">
                            <td style="text-align:center" class="nombre_Rol" ><?= $rol->NombreRol ?></td>
                            <td style="text-align:center"  class="gestion_rol">
                                <button id="<?php echo $rol->CodigoRol ?>" title="Editar Rol" class="btn_modificar_rol btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                                <button id="btnDel<?php echo $rol->CodigoRol ?>" title="Eliminar Rol" class="btn_eliminar_rol btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                <button id="btnPer<?php echo $rol->CodigoRol ?>" title="Asignar Permisos" class="btn_permisos_user btn btn-success"><span class="glyphicon glyphicon-user"></span></button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>   
        </div>
    </div>
</div>