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
                <button href="#usuarioNuevo"  class="btn btn-default btn-default" data-toggle="modal">Asignar Rol</button>
                <button href="#usuarioModifica" class="btn btn-default btn-default" data-toggle="modal">Modificar Rol</button>
                <button href="#eliminarUsuario" class="btn btn-default btn-default" data-toggle="modal">Quitar Rol</button>
            </div>
            <!-- DIv para la tabla  donde se muestran todos los usuario-->
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
    </body>
</html>