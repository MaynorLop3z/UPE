<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Vista General</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!--script para cargar la pagina  -->
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <!-- Acción sobre el botón con id=boton y actualizamos el div con id=capa -->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#crear").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
        </script>



    </head>
    <body>
        <div id="divGeneral" class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">UPESYS</a>

                    </div>
                    <div>
                        <ul class="nav  navbar-right center-block ">
                            <label id="labelpersona">Johanna Rodriguez</label>
                            <button id="btnsalir"   class="btn btn-default "><span class="glyphicon glyphicon-log-out"></span>Salir</button>
                        </ul>
                    </div>                   
                </div> 
        </div>
        <!--Hasta  Aqui termina la barra de navegacion Encabezado--> 
        <!--Hasta  Aqui comienza la barra de funciones --> 
        <div class="container">  
            <div class="col-lg-3">
                <h2>Funciones</h2>             
                <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a name="crear" id="crear" type="text" value="crear Usuario"/>Crear usuario</li>
                            <li><a href="#">Modificar Usuario</a></li>
                            <li><a href="#">Eliminar Usuario</a></li>
                        </ul>
                    </li>
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Roles<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="crearRol" >Crear Rol</a></li>
                            <li><a href="#">Modificar Rol</a></li>
                            <li><a href="#">Eliminar Rol</a></li>
                        </ul>
                    </li>
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Diplomados <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="nuevoDiplomado" href="#">Nuevo Diplomado</a></li>
                            <li><a id="modificarDiplomado"href="#">Modificar Diplomado</a></li>
                            <li><a id="eliminarDiplomado" href="#">Eliminar Diplomado </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="divp" class="col-lg-9"  ><!--Este Div es  donde se deben  cargar  las Diferentes Funciones  -->

           </div> 

        </div>

    </body>