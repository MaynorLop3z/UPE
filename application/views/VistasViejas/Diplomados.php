<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Diplomados</title>

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
             
                 <ul class="breadcrumb col-lg-8" >
                 <li><a href="#DiplomadoNuevo" data-toggle="modal">Agregar Diplomado</a></li>
                 <li><a href="#modificarDiplomado" data-toggle="modal">Modificar Diplomado</a></li>
                 <li><a href="#eliminarDiplomado"  data-toggle="modal">Eliminar Diplomado</a></li>
                 </ul>
          </div>
            <!-- DIv para la tabla  donde se muestran todos los Diplomados-->
            <div class="row">
            <div class="col-lg-8">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr><!--Agregar  Mas informacion acerca de los modulos -->
                            <th>ID</th> <!-- Id del modulo -->
                            <th>Diplomado</th> <!-- Nombre de diplomado-->
                            <th>Coordinador</th><!-- Coordinador del  diplomado -->
                            <th>Fecha Inicio</th> <!-- Fecha de inicio del modulo -->
                            <th>Fecha Fin</th>  <!-- Fecha de fin del modulo  -->
                            <th>Cantidad de modulos</th><!-- Solo agregar la cantidad de modulos que tendra -->
                        </tr>
                    </thead> 
                    <tbody>


                    </tbody>
                </table>   
            </div>
            <div class="col-lg-3"></div>
        </div>
        </div>
        
<!------Modal para el boton Agregar Diplomados----------------------------------------------------------------------------------->
<div id="DiplomadoNuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="container-fluid ">
        <form action="DiplomadosController" class="form-horizontal" method="post" >
            <fieldset>
                <legend class="modal-header">Nuevo Diplomado:</legend> 
                <div class="form-group">
                    <label for="DiplomadoNombre" class="col-lg-3 control-label">Nombre Del Diplomado</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="DiplomadoNombre" placeholder="Nombre del Diplomado" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="CoordinadorDiplomado" class="col-lg-3 control-label">Coordinador</label>
                    <div class="col-lg-9">
                        <select class="form-control" id="CoordinadorDiplomado">
                            <option>Nombre 1</option>
                            <option>Nombre 2</option>
                            <option>Nombre 3</option>
                            <option>Nombre 4</option>
                        </select>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="InicioDiplomado" class="col-lg-3 control-label">Fecha de Inicio:</label>
                    <div class="col-lg-9">
                        <input type="date" class="form-control" id="InicioDiplomado" placeholder="Inicio del Diplomado"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="FinDiplomado" class="col-lg-3 control-label">Fecha Fin:</label>
                    <div class="col-lg-9">
                        <input type="date" class="form-control" id="FinDiplomado" placeholder="Fin del Diplomado" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                    <button type="submit" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                    <button type="submit" id="btnCerrar" onclick="" class=" btn btn-default" name="Cerrar">Cerrar</button>
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