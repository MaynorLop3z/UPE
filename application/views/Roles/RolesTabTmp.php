<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Roles</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <form action="RolesController/persistRol" class="form-horizontal" method="post" >
                <fieldset>
                    <legend class="modal-header">Agregar Nuevo Rol:</legend> 
                    <div class="form-group">
                        <label for="txtNombRol" class="col-lg-4 control-label">Nombre del Rol:</label>
                        <div class="col-lg-4">
                            <input class="form-control" id="txtNombRol" type="text" maxlength="50" required>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" id="btnEnviarR" onclick="" class=" btn btn-default" name="Guardar">Guardar</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>

        <div class="panel panel-default">
            <table class="table table-bordered table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nombre de Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                </tbody>
            </table>   
        </div>
    </div>
</div>