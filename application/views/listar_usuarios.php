<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado de alumnos</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/DarkSide.ico" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($lista as $registro) {
                                echo '<tr>';
                                foreach ($registro as $value) {
                                    echo '<td>' . $value . '</td>';
                                }
                                echo '</tr>';
                            }
                            ?>        
                        </tbody>
                    </table>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

    </body>
</html>
