<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Usuarios</h3>
    </div>
    <div class="panel-body">
        <div class="btn btn-group">
            <button href="#usuarioNuevo"  class="btn btn-default btn-default" data-toggle="modal">Usuario Nuevo</button>
            <button href="#usuarioModifica" class="btn btn-default btn-default" data-toggle="modal">Modificar Usuario</button>
            <button href="#usuarioElimina" class="btn btn-default btn-default" data-toggle="modal">Eliminar Usuario</button>
        </div>
        <!--<div class="col-lg-9">-->
        <table class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Gestionarm</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                $codigoUsuario;
                foreach ($Usuarios as $user) {
                    ?>
                    <tr>
                        <td><?= $user->Nombre ?></td>
                        <td><?= $user->CorreoUsuario ?></td>
                        <td><?= $user->NombreUsuario ?></td>
                        <td><a data-toggle="modal" title="Editar Usuario" class="btn btn-success" href="#usuarioModifica" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </a>

                            <a data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>   
        <!--</div>-->
    </div>
    <!--<div class="panel-footer">Panel footer</div>-->
</div>