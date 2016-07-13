<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->helper('url'); ?>
        <meta charset="UTF-8">
        <title>Reportes</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1>REPORTES</h1>
                    <button class="btn btn-default" onclick="ParticipantesCantidadShow()"><span class="glyphicon glyphicon-eye-open"></span>  Participantes por Categoria</button>
                    <button class="btn btn-default" onclick="GeneroXDiplomadoShow()"><span class="glyphicon glyphicon-eye-open"></span>  Participantes por Categoria</button>
                    <!--<div id="piechart" style="width: 700px; height: 600px;"></div>-->
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div id="QuantityAlumCat" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="container-fluid ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Cantidad de Alumnos por Categoria</h4>
                        </div>
                        <div class="modal-body">
                            <div id="AlumByCat"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="QuantityGenderCat" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="container-fluid ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Diplomados por Genero</h4>
                        </div>
                        <div class="modal-body">
                            <div id="GenderByCat"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="../bootstrap/js/Graficos.js"></script>
    </body>
</html>
