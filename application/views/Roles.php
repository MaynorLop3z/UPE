<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Roles Usuario</title>

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
            <div class="row">
             <div class="btn btn-group">
                <button href="#modificarRol" class="btn btn-default btn-default" data-toggle="modal">Modificar Rol</button>
                <!--    -->
                <button href="#eliminarRol" class="btn btn-default btn-default" data-toggle="modal">Quitar Rol</button>
            
             </div>
            </div>
            <!-- DIv para la tabla  donde se muestran todos los usuario-->
            <div class="row">
            <div class="col-lg-9">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                        </tr>
                    </thead> 
                    <tbody>


                    </tbody>
                </table>   
            </div>
            <div class="col-lg-3"></div>
        </div>
        </div>
        
<!------Modal para el boton Asignar Rol----------------------------------------------------------------------------------->
          <div id="modificarRol" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="container-fluid ">
        <form action="RolesController" class="form-horizontal" method="post" >
            <fieldset>
                <legend class="modal-header">Asignar Rol:</legend> 
                <div class="form-group">
                    <label for="selectUsuario" class="col-lg-3 control-label">Usuarios</label>
                    <div class="col-lg-9">
                        
                        <select class="form-control" id="selectRol">
                            <option>usuario 1</option>
                            <option>Usuario 2</option>
                            <option>Usuario 3</option>
                          </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectRol" class="col-lg-3 control-label">Rol</label>
                    <div class="col-lg-9">
                        <select class="form-control" id="selectRol">
                            <option>Secretaria Ingles</option>
                            <option>Horas sociales</option>
                            <option>Coordinador</option>
                            <option>Docente</option>
                            <option>Secretaria Diplomados</option>
                            <option>Coordinadora de Ingles</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnEnviarR" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                    <button type="submit" id="btnCancelarR" onclick="" class=" btn btn-default" name="Limpiar">Cancelar</button>
                </div>
                </div>
            </fieldset>
        </form>
</div>
</div>
</div>

<!-- Quitar Rol-------------------------------------------------------------------------------------------->
            
        
        
        
    </body>
</html>