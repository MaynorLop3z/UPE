<?php $this->load->helper('url');?>
<script src="../bootstrap/js/Usuarios.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Usuarios</h3>
    </div>
    <div class="panel-body">
        <div id="mensajes">

        </div>
        <div  id="divBtnCrudUsr" class="well">

            <button id="btnUsuarioNuevo" class="btn btn-default decorateStyleCrud" ><span class="glyphicon glyphicon-plus"></span>Usuario Nuevo</button>
             
            

        </div>
        <table id="tableUsers" class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th style="text-align:center">Nombre</th>
                    <th style="text-align:center" >Correo</th>
                    <th style="text-align:center" >Usuario</th>
                    <th style="text-align:center" >Gestionar</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                foreach ($Usuarios as $user) {
                    ?>
                    <tr data-userd='<?php echo json_encode($user) ?>' id="tr<?php echo $user->CodigoUsuario ?>">
                        <td class="nombre_Usuario" ><?= $user->Nombre ?></td>
                        <td class="correo_Usuario" ><?= $user->CorreoUsuario ?></td>
                        <td class="nickName_Usuario" ><?= $user->NombreUsuario ?></td>
                        <td style="text-align:center"  class="gestion_User">
                            <button id="<?php echo $user->CodigoUsuario ?>" title="Editar Usuario" class="btn_modificar_user btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                            <button id="btnDel<?php echo $user->CodigoUsuario ?>" title="Eliminar Usuario" class="btn_eliminar_user btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <ul class="pager">
                <li><a href="#">&lt;&lt;</a></li>
                <li><a href="#">&lt;</a></li>
                <li><input data-datainic=NO numeric noise key 1004 type="text" value="1" id="txtPagingSearchUsr" name="txtNumberPag" size="5">/<?php echo intval(ceil($ToTalRegistros / ROWS_PER_PAGE)) ?></li>
                <li><a href="#">&gt;</a></li>
                <li><a href="#">&gt;&gt;</a></li>
                <li>[<?php echo $PagInicial . "-" . count($Usuarios) . "/" . $ToTalRegistros ?>]</li>
            </ul>
 </div>

        <!--<div class="panel-footer">Panel footer</div>-->
    </div>
</div>