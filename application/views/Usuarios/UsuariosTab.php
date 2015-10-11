<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Usuarios.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Usuarios</h3>
    </div>
    <div class="panel-body">
        <div id="mensajes">

        </div>
        <div   class="well">

            <button id="btnUsuarioNuevo" class="btn btn-default" ><span class="glyphicon glyphicon-plus"></span>Usuario Nuevo</button>
            <button id="btnActualizarUsuarios" class="btn btn-default" ><span class="glyphicon glyphicon-refresh"></span>Actualizar Lista</button>
            
            </div>
        <!--<div id="divp">-->
        <table id="tableUsers" class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Gestionar</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                foreach ($Usuarios as $user) {
                    ?>
                    <tr id="tr<?php echo $user->CodigoUsuario ?>">
                        <td class="nombre_Usuario" ><?= $user->Nombre ?></td>
                        <td class="correo_Usuario" ><?= $user->CorreoUsuario ?></td>
                        <td class="nickName_Usuario" ><?= $user->NombreUsuario ?></td>
                        <td class="gestion_User">
                            <button id="<?php echo $user->CodigoUsuario ?>"  title="Editar Usuario" class="btn_modificar_user btn btn-success "  class=" btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>
                            <button data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-trash"></span></button></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>   
        <!--            </div>-->


        <!--</div>-->
    </div>
    <!--<div class="panel-footer">Panel footer</div>-->
</div>