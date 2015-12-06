<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
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
        <script language="javascript">
            $(document).ready(function() {
                $("#Categorias").change(function() {
                    $("#Categorias option:selected").each(function() {
                        idCategoria = $(this).val();
                        $.post("<?php echo base_url() ?>index.php/GestionGruposController/getDiplomados/", {idCategoria: idCategoria}, function(data) {
        console.log("Entro");                    
        $("#Diplomado").html(data);
                        });
                    });
                });
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
                                <label id="labelpersona">Maynor Lopez</label>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Gestion de Grupos</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="formulario1" action="" method="POST">
                                <select class="form-control" name="Categorias" id="Categorias">
                                    <?php
                                    foreach ($Categorias as $categoria) {
                                        ?>
                                        <option value="<?= $categoria->CodigoCategoriaDiplomado ?>">
                                            <?= $categoria->NombreCategoriaDiplomado ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <select class="form-control" name="Diplomado" id="Diplomado">
                                    </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
