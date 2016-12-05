<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Usuarios.js"></script>
<script src="../bootstrap/js/jquery.mask.js"></script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Usuarios</h3>
    </div>
    <div class="panel-body">
        <div id="mensajes">

        </div>
        <div  id="divBtnCrudUsr" class="well">

            <button id="btnUsuarioNuevo" class="btn btn-default decorateStyleCrud" ><span class="glyphicon glyphicon-plus"></span>Usuario Nuevo</button>
<!--            <button id="btnActualizarUsuarios" class="btn btn-default decorateStyleCrud" ><span class="glyphicon glyphicon-refresh"></span>Limpiar Búsqueda</button> -->
                <button id="btnCleanSearchUsuarios" class="btn btn-default" style="float:right;"><span class="glyphicon glyphicon-refresh"></span>Limpiar Búsqueda</button> 
<!--            <div class="col-md-6" style="float:right;">
        
                <form id="frmfindUsuario" action="<?php echo base_url() ?>index.php/UsuarioController/BuscarUsuario/"  method="post" class="form-inline" style="float:right;" >
                <span>Usuario:</span>    
                <input type="text" class="form-control" name="FindUsuario" id="FindUsuario" placeholder="Nombre de Usuario" required>
                <button id="btnFindUsuario" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar</button>
            </form>
        </div>-->
        </div>
        <div class="panel panel-default">
            <form id="frmfindUsuario"  action="<?php echo base_url() ?>index.php/UsuarioController/BuscarUsuario/" class="form-horizontal" method="post" >
                <fieldset>
                    <legend class="modal-header">Buscar Usuario:</legend> 
                    <div class="form-group">
                        <div class="col-lg-4">
                            <input class="form-control form-inline FindUsuarioClass" placeholder="Nombre" name="FindUsuario" id="FindUsuario" type="text" maxlength="150" >
                        </div>
                        <div class="col-lg-4">
                            <input class="form-control form-inline FindUsuarioClass" placeholder="Correo" id="FindUsuarioCorreo" type="text" maxlength="150" >
                        </div>
                        <div class="col-lg-4">
                            <input class="form-control form-inline FindUsuarioClass" placeholder="Nombre de Usuario" id="FindUsuarioNick" type="text" maxlength="150" >
                        </div>
<!--                        <div class="col-lg-4">
                            <button type="submit" id="btnSearchAlum" onclick="" class=" btn btn-default" name="Buscar">Buscar</button>
                        </div>-->
                    </div>
                </fieldset>
            </form>
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
                    <li><input data-datainic="1" type="text" value="1" id="txtPagingSearchUsr" name="txtNumberPag" data-mask="000000000" size="5">/<?php echo $totalPaginas ?></li>
                    <li><button id="aNextPag">&gt;</button></li>
                    <li><button id="aLastPag" data-datainic="<?php echo $totalPaginas ?>" >&gt;&gt;</button></li>
                    <li>[<?php echo $PagInicial . "-" . count($Usuarios) . "/" . $ToTalRegistros ?>]</li>
                </ul>
            </div>

            <!--<div class="panel-footer">Panel footer</div>-->
        </div><!--Fin container table paging-->
    </div>
</div>