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
        <link rel="icon" href="../bootstrap/images/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!--        <script src="../bootstrap/js/Usuarios.js"></script>-->
        <script type="text/javascript">
            $(document).ready(function() {
               
                window.setTimeout(function() {
                    $(".alert").fadeTo(1500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
//                $(".alert").alert();
//                window.setTimeout(function() {
//                    $(".alert").alert('close');
//                }, 2000);
<?php
$Permisos = $this->session->userdata('permisosUsuer');
if ($Permisos==null){
    header('location:'.base_url());
}else{
foreach ($Permisos as $p) {

    if ($p->systemPart == MENU_PPAL_RIGHT) {
        ?>

                        $('#<?= $p->idContainer ?>').load('<?= $p->controllerContainer ?>');


        <?php
    }
}
?>
           $('#btnsalir').click(function(){$.post("Dashboard/logout");window.location.replace('<?php echo base_url();?>');});
           
       });
            
        </script>
        
    </head>
    <body>
        <div id="VistasAyuda" style='display:none;'></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#"><img src="../bootstrap/images/minervaB.png" style="height: 170%;display: inline">UPESYS</a>
                        </div>
                        <div>
                            <ul class="nav  navbar-right center-block ">
                                <label id="labelpersona">Bienvenid@: <?= $this->session->userdata('nombreUserLogin'); ?></label>
                                <button id="btnsalir" name="btnsalir" onclick="" class="btn btn-default "><span class="glyphicon glyphicon-log-out"></span>Salir</button>
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

                        <ul class="nav nav-tabs" role="tablist" id="pmenulist">
                            <?php
                            //$iterator = 0;

                            foreach ($Permisos as $p) {
                                if ($p->systemPart == MENU_PPAL_RIGHT) {
                                    ?>
                                    <li role="presentation" <?php
                                    if ($p->idContainer == CONTROLLER_TAP_PANEL_DEFAULT) {
                                        echo 'class="active"';
                                    } else {
                                        echo '';
                                    }
                                    ?> ><a href="#<?= $p->idContainer ?>" aria-controls="<?= $p->idContainer ?>" role="tab" data-toggle="tab"><?= $p->NombrePermiso ?></a></li>
                                        <?php
                                        //$iterator++;
                                    }
                                }
                                ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                            foreach ($Permisos as $p) {
                                if ($p->systemPart == MENU_PPAL_RIGHT) {
                                    ?>
                                    <div role="tabpanel" <?php
                                    if ($p->idContainer == CONTROLLER_TAP_PANEL_DEFAULT) {
                                        echo 'class="tab-pane active"';
                                    } else {
                                        echo 'class="tab-pane"';
                                    }
                                    ?> class="tab-pane" id="<?= $p->idContainer ?>"></div>

                                    <?php
                                    //$iterator++;
                                }
                            }
}?>
                        </div>
                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>
