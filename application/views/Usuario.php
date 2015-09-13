<!DOCTYPE html>
<html lang="en">
 <head>
        <meta charset="UTF-8">
        <title>Usuario Usuario</title>
       
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!--script para cargar la pagina  -->
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 </head>
<body>
<div class="container">
 
  <!-- Trigger the modal with a button,  Me falta centrar los botones el el div-->
 
  <div class="btn btn-group">
     <button href="#usuarioNuevo"  class="btn btn-default btn-default" data-toggle="modal">Usuario Nuevo</button>
      <button href="#usuarioModifica" class="btn btn-default btn-default" data-toggle="modal">Modificar Usuario</button>
      <button href="#usuarioElimina" class="btn btn-default btn-default" data-toggle="modal">Eliminar Usuario</button>
  </div>
    <!-- DIv para la tabla  donde se muestran todos los usuario-->
      <div class="col-lg-9">
         <table class="table table-bordered table-striped table-hover table-responsive">
  <thead>
      <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
    </tr>
  </thead> 
  <tbody>
      
      
  </tbody>
         </table>   
      </div>
    <div class="col-lg-3"></div>
  </div> 
<!-- Modal Para el Usuario Nuevo  ------------------------------------------------------------------------------------>
<div id="usuarioNuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="container-fluid ">
            <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
            
        <form action="Usuariocontroller" class="form-horizontal" method="post" >
            <fieldset>
                <legend class="modal-header">Agregar Usuario:</legend> 
                
                <div class="form-group">
                    <label for="Usuario" class="col-lg-3 control-label">Usuario</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="UsuarioNombre" placeholder="Nombre Usuario" required>
                    </div>
                    <div class="col-lg-3">
                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="col-lg-3 control-label">E-mail</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" id="UsuarioEmail" placeholder="Correo Electronico" required>
                    </div>
                    <div class="col-lg-3">
                        <label id="emR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password" class="col-lg-3 control-label">Contraseña</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="UsuarioPassword" placeholder="Contraseña"  required>
                    </div>
                    <div class="col-lg-3">
                        <label id="paR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password2" class="col-lg-3 control-label">Confirmar Contraseña</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="UsuarioPassword2" placeholder="Repita Contraseña" required>
                    </div>
                    <div class="col-lg-3">
                        <label id="prR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                    <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                  </div>
                </div>
            </fieldset>
        </form>
</div>
</div>
</div>

<!-- Modal para Editar Usuario --------------------------------------------------------------------------------------->
<div id="usuarioModifica" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="container-fluid ">
            <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
        <form action="Usuariocontroller" class="form-horizontal" method="post" >
            <fieldset>
                <legend class="modal-header">Modificar Usuario:</legend> 
                <div class="form-group">
                    <label for="Usuario" class="col-lg-3 control-label">Usuario</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="Usuariomodificar" placeholder="Nombre Usuario" required>
                    </div>
                    <div class="col-lg-3">
                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="col-lg-3 control-label">E-mail</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" id="Emailmodificar" placeholder="Correo Electronico" required>
                    </div>
                    <div class="col-lg-3">
                        <label id="emR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password" class="col-lg-3 control-label">Contraseña</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="Passwordmodificar" placeholder="Contraseña"  required>
                    </div>
                    <div class="col-lg-3">
                        <label id="paR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password2" class="col-lg-3 control-label">Confirmar Contraseña</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="Password2modificar" placeholder="Repita Contraseña" required>
                    </div>
                    <div class="col-lg-3">
                        <label id="prR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                    <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                    
                </div>
                
            </fieldset>
        </form></div>
</div>
</div>
</div>
<!-- Modal para Eliminar Usuario --------------------------------------------------------------------------------------->
<div id="usuarioElimina" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="container-fluid ">
            <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
         <form action="UsuarioController" class="form-horizontal" method="post" >
            <fieldset>
                <legend class="modal-header">Usuario:</legend> 
                <div class="form-group">
                    <label for="selectUsuario" class="col-lg-3 control-label" >Usuarios</label>
                    <div class="col-lg-9">
                        
                        <select class="form-control" id="selectUsuario" >
                            <option>usuario 1</option>
                            <option>Usuario 2</option>
                            <option>Usuario 3</option>
                          </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnEnviarU" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                    <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                </div>
                
            </fieldset></div>
   </div>     </form>
</div>
</div>
</div>

</body>           
</html>
