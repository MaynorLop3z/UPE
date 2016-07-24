<?php $this->load->helper('url'); ?>
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
        <br>
        <div id="containerTablePaging">
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
                        <tr data-userd='<?php echo($user->CodigoUsuario) ?>' id="tr<?php echo $user->CodigoUsuario ?>">
                            <td class="nombre_Usuario" ><?= $user->Nombre ?></td>
                            <td class="correo_Usuario" ><?= $user->CorreoUsuario ?></td>
                            <td class="nickName_Usuario" ><?= $user->NombreUsuario ?></td>
                            <td style="text-align:center"  class="gestion_User">
                                <?php echo $buttonsByUserRights ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            
            <div class="row">
                <hr>
                <ul class="pager">
                    <li><button data-datainic="1" id="aFirstPag" >&lt;&lt;</button></li>
                    <li><button id="aPrevPag" >&lt;</button></li>
                    <li><input data-datainic="1" type="text" value="1" id="txtPagingSearchUsr" name="txtNumberPag" size="5">/<?php echo $totalPaginas ?></li>
                    <li><button id="aNextPag">&gt;</button></li>
                    <li><button id="aLastPag" data-datainic="<?php echo $totalPaginas ?>" >&gt;&gt;</button></li>
                    <li>[<?php echo $PagInicial . "-" . count($Usuarios) . "/" . $ToTalRegistros ?>]</li>
                </ul>
            </div>

            <!--<div class="panel-footer">Panel footer</div>-->
        </div><!--Fin container table paging-->
    </div>
</div>