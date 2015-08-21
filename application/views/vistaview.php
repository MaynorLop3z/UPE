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
                $("#crearUsuario").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
            
             $(document).ready(function () {
                $("#modificarUsuario").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#eliminarUsuario").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#eliminarRol").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#modificarRol").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#asignarRol").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#nuevoDiplomado").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#modificarDiplomado").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#eliminarDiplomado").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#nuevaPub").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#modificarPub").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
             $(document).ready(function () {
                $("#eliminarPub").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
            $(document).ready(function () {
                $("#agregarHora").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
            $(document).ready(function () {
                $("#modificarHora").click(function (event) {
                    $("#divp").load('UsuarioNcontroller');
                });
            });
            $(document).ready(function () {
                $("#eliminarHora").click(function (event) {
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
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a name="crearUsuario" id="crearUsuario" type="text" value="crear Usuario"/>Agregar usuario</li>
                            <li><a name="modificarUsuario" id="modificarUsuario" type="text" value="Modificar Usuario"/>Modificar Usuario</a></li>
                            <li><a name="eliminarUsuario" id="eliminarUsuario" type="text" value="Eliminar Usuario"/>Eliminar Usuario</a></li>
                        </ul>
                    </li>
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Roles<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a name="eliminarRol" id="eliminarRol" type="text" value="Eliminar Rol"/>Eliminar Rol</a></li>
                            <li><a name="modificarRol" id="modificarRol" type="text" value="Modificar Rol"/>Modificar Rol</a></li>
                            <li><a name="asignarRol" id="asignarRol" type="text" value="Asignar Rol"/>Asignar Rol</a></li>
                        </ul>
                    </li>
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Diplomados <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a name="nuevoDiplomado" id="nuevoDiplomado" type="text" value="Nuevo Diplomado"/>Nuevo Diplomado</a></li>
                            <li><a name="modificarDiplomado" id="modificarDiplomado" type="text" value="Modificar Diplomado "/>Modificar Diplomado</a></li>
                            <li><a name="eliminarDiplomado" id="eliminarDiplomado" type="text" value="Eliminar Diplomado"/>Eliminar Diplomado </a></li>
                        </ul>
                    </li>
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Publicaciones<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a name="nuevaPub" id="nuevaPub" type="text" value="Nueva Publicacion"/>Nueva publicacion</a></li>
                            <li><a name="modificarPub" id="modificarPub" type="text" value="Modificar Publicacion"/>Modificar publicacion </a></li>
                            <li><a name="eliminarPub" id="eliminarPub" type="text" value="Eliminar Publicacion"/>Eliminar publicacion </a></li>
                        </ul>
                    </li>
                    <li class="drop down"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Horarios<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a name="agregarHora" id="agregarHora" type="text" value="Agregar Horario"/>Agregar Horario</a></li>
                            <li><a name="modificarHora" id="modificarHora" type="text" value="Modificar Horario"/>Modificar Horario</a></li>
                            <li><a name="eliminarHora" id="eliminarHora" type="text" value="Eliminar Horario"/>Eliminar Horario  </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="divp" class="col-lg-9"  ><!--Este Div es  donde se deben  cargar  las Diferentes Funciones  -->

           </div> 

        </div>

    </body>