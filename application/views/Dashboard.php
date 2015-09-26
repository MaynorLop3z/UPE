<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <?php $this->load->helper('url'); ?>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
<!--        <script src="../bootstrap/js/Usuarios.js"></script>-->
        <script type="text/javascript">
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(1500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
                $("#Usuarios").load('UsuarioController');
                $("#Roles").load('RolesController');
                $("#Diplomados").load('DiplomadosController');
                $("#Publicaciones").load('PublicacionesController');
                $("#Horarios").load('HorariosController');
                $("#Modulos").load('ModulosController');
                $("#Participantes").load('ParticipantesController');
            });
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">UPESYS</a>
                        </div>
                        <div>
                            <ul class="nav  navbar-right center-block ">
                                <label id="labelpersona">Johanna Rodriguez</label>
                                <button id="btnsalir" name="btnsalir" onclick="window.location.href = 'Login'" class="btn btn-default "><span class="glyphicon glyphicon-log-out"></span>Salir</button>
                            </ul>
                        </div> 

                    </nav>
                    <!--Hasta  Aqui termina la barra de navegacion Encabezado--> 
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#Usuarios" aria-controls="Usuarios" role="tab" data-toggle="tab">Usuarios</a></li>
                            <li role="presentation"><a href="#Roles" aria-controls="Roles" role="tab" data-toggle="tab">Roles</a></li>
                            <li role="presentation"><a href="#Diplomados" aria-controls="Diplomados" role="tab" data-toggle="tab">Diplomados</a></li>
                            <li role="presentation"><a href="#Publicaciones" aria-controls="Publicaciones" role="tab" data-toggle="tab">Publicaciones</a></li>
                            <li role="presentation"><a href="#Horarios" aria-controls="Horarios" role="tab" data-toggle="tab">Horarios</a></li>
                            <li role="presentation"><a href="#Modulos" aria-controls="Modulos" role="tab" data-toggle="tab">Modulos</a></li>
                            <li role="presentation"><a href="#Participantes" aria-controls="Participantes" role="tab" data-toggle="tab">Participantes</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="Usuarios"></div>
                            <div role="tabpanel" class="tab-pane" id="Roles"></div>
                            <div role="tabpanel" class="tab-pane" id="Diplomados"></div>
                            <div role="tabpanel" class="tab-pane" id="Publicaciones"></div>
                            <div role="tabpanel" class="tab-pane" id="Horarios"></div>
                            <div role="tabpanel" class="tab-pane" id="Modulos"></div>
                            <div role="tabpanel" class="tab-pane" id="Participantes"></div>
                        </div>
                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>
