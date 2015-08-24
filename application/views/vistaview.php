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
                $("#Usuario").click(function (event) {
                    $("#divp").load('Usuariocontroller');
                });
            });
                $(document).ready(function () {
                $("#Roles").click(function (event) {
                    $("#divp").load('Usuariocontroller');
                });
            });
                $(document).ready(function () {
                $("#Diplomados").click(function (event) {
                    $("#divp").load('Usuariocontroller');
                });
            });
                $(document).ready(function () {
                $("#Publicaciones").click(function (event) {
                    $("#divp").load('Usuariocontroller');
                });
            });
                $(document).ready(function () {
                $("#Horarios").click(function (event) {
                    $("#divp").load('Usuariocontroller');
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
                            <button id="btnsalir" name="btnsalir" onclick="window.location.href='Login'" class="btn btn-default "><span class="glyphicon glyphicon-log-out"></span>Salir</button>
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
                    <li class="drop down"><a name="Usuario" id="Usuario" type="text" value="Usuario"class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios </a>
                    </li>
                    <li class="drop down"><a name="Roles" id="Roles" type="text" value="Roles"class="dropdown-toggle" data-toggle="dropdown" href="#">Roles</a>
                    </li>
                    <li class="drop down"><a name="Diplomados" id="Diplomados" type="text" value="Diplomados"class="dropdown-toggle" data-toggle="dropdown" href="#">Diplomados </a>
                    </li>
                    <li class="drop down"><a name="Publicaciones" id="Publicaciones" type="text" value="Publicaciones"class="dropdown-toggle" data-toggle="dropdown" href="#">Publicaciones</a>
                    </li>
                    <li class="drop down"><a name="Horarios" id="Horarios" type="text" value="Horarios"class="dropdown-toggle" data-toggle="dropdown" href="#">Horarios</a>
                 </ul>
                 
            </div>
            <div id="divp" class="col-lg-9"  ><!--Este Div es  donde se deben  cargar  las Diferentes Funciones  -->

           </div> 

        </div>

    </body>