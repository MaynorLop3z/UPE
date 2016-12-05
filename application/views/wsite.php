<!--i was here :P-->


<html lang="en">


    <head>

        <?php
        $this->load->helper('url');
        //si esta logueado redirecciona al Dashboard
        if ($this->session->userdata("logueado") === TRUE) {
            Redirect('Dashboard');
        }
        ?>
        <title>PAESIS</title>
        <link rel="icon" href="bootstrap/minerva.jpg" type="image/x-icon" />
        <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="bootstrap/css/freelancer.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <!--        <link rel="stylesheet" href="/resources/demos/style.css">-->
        <!-- jQuery -->
        <script src="bootstrap/js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/jquery.mask.js"></script>
        <!-- Plugin JavaScript -->
        <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->
        <script src="bootstrap/js/classie.js"></script>
        <script src="bootstrap/js/cbpAnimatedHeader.js"></script>

    </head>


    <body id="page-top" class="index">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#page-top">PAESIS</a>
                </div>

                <!-- Nav con opciones principales(login, mas recientes, about,etc.) -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li class="page-scroll">
                            <a href="" class="portfolio-link btn   dropdown-toggle"  title="Buscar Publicaciones" data-toggle="dropdown" id="test3"><i class="fa fa-fw fa-search"></i></a>
                            <ul class="dropdown-menu" id="scrollBuscar">
                                <li value="1" id="opccategoria"> <a href="#portfolio">Por Categoria</a> </li>
                                <li value="2" id="opcDate"> <a href="#portfolio">Por Fecha</a> </li>
                                <li value="3" id="opcNombre"> <a href="#portfolio">Por Nombre</a> </li>
                            </ul>
                        </li>
                        <li class="page-scroll" id="opcReciente">
                            <a href="#portfolio">Mas recientes</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#about">¿Quienes Somos?</a>
                        </li>
                        <li class="page-scroll">
                            <a href="" class="portfolio-link btn   dropdown-toggle"  title="Ingresar al Sistema" data-toggle="dropdown" id="test3"><i class="fa fa-fw fa-sign-in"></i></a>
                            <ul class="dropdown-menu" id="log">
                                <li class="page-scroll " value="2" >
                                    <a href='index.php/PortalParticipantes' class="portfolio-link" data-toggle="modal">Alumnos</a>
                                </li>
                                <li class="page-scroll " value="1" >
                                    <a href="#Login2" class="portfolio-link" data-toggle="modal">Institucion</a>
                                </li>
                            </ul></li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img class="img-responsive" src="bootstrap/images/profile.png" alt="">
                        <div class="intro-text">
                            <span class="name">Unidad de Proyectos Academicos Especiales</span>
                            <hr class="star-light">
                            <span class="skills">Universidad de El Salvador Facultad Multidiciplinaria de Occidente</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- Publicaciones  Grid Section -->
        <section id="portfolio">
            <div class="container" id="masRecientesDiv" >
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Publicaciones Recientes</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row" id="pubRecientes">
                    <!--Aqui empieza las publicaciones--> 
                    <div id="Pubsrecie">
                        <?php
                        if ($TotalPaginacion != null && count($TotalPaginacion) > 0) {
                            foreach ($TotalPaginacion as $publicacion) {
                                $iterador = 0;
                                $iterador ++;
                            }
                            ?>
                            <?php
                            foreach ($TotalPaginacion as $publicacion) {
                                ?>

                                <div class="col-sm-4 portfolio-item"  >

                                    <a  id="a<?php echo $publicacion->CodigoPublicacion ?>" data-dimg='<?php echo json_encode($publicacion) ?>' class="portfolio-link callModalPublicacion"  >
                                        <div class="caption">
                                            <div class="caption-content" >
                                                <i class="fa fa-search-plus fa-3x"></i>
                                            </div>
                                        </div>
                                        <img  src="<?php echo 'bootstrap' . $publicacion->Ruta ?>" class="img-responsive" alt="" style="height:500px; width: 500px;">
                                    </a>


                                </div>

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- start paginacion-->

                <div class="row" id="paginacionDiv">

                    <ul class="pager">
                        <li><a  id="btnpaginicio">&laquo;</a></li>
                        <?php
                        $contador = 1;

                        $totalpag = $publicacionesMostrar;

                        if ((($totalpag % PUBLICACIONES_X_PAG) != 0) && (($totalpag / PUBLICACIONES_X_PAG) >= 1)) {
                            $totalpag = intval(($totalpag / PUBLICACIONES_X_PAG) + 1);
                            ?>
                            <?php
                        } else {
                            $totalpag = intval(ceil(($totalpag / PUBLICACIONES_X_PAG)));
                        }
                        while ($contador <= $totalpag) {
                            ?>
                            <li><a id="<?php echo $contador ?>"><?php echo $contador ?></a></li>
                            <?php
                            $contador ++;
                        }
                        ?>
                        <li><a id="btnpagfin">&raquo;</a></li>
                    </ul>
                </div>
                <!-- finish paginacion-->
            </div>


            <!--comienza grid e publicacines con busqueda por categoria-->
            <div class="container" id="categoriaDiv" style='display:none;'>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Seleccione la categoria</h2>
                        <select name="categoriasl" onchange="" id="selectCategoriaBusqueda" name="seltcate">

                            <?php
                            foreach ($listCategorias as $categorias) {
                                ?>

                                <option value=<?php echo $categorias->CodigoCategoriaDiplomado ?>> <?php echo $categorias->NombreCategoriaDiplomado ?>  </option>
                                <?php
                            }
                            ?>

                        </select>
                        <hr class="star-primary">


                        <!--here-->
                        <?php
                        //$publicacionesMostrar=null;
                        if ($TotalPaginacion != null && count($TotalPaginacion) > 0) {
                            foreach ($TotalPaginacion as $publicacion) {
                                $iterador = 0;
                                $iterador ++;
                            }
                            ?>
                            <div id="PubsCategoria">
                                <?php
                                foreach ($TotalPaginacion as $publicacion) {
                                    ?>

                                    <div class="col-sm-4 portfolio-item"  >

                                        <a  id="a<?php echo $publicacion->CodigoPublicacion ?>" data-dimg='<?php echo json_encode($publicacion) ?>' class="portfolio-link callModalPublicacion"  >
                                            <div class="caption">
                                                <div class="caption-content" >
                                                    <i class="fa fa-search-plus fa-3x"></i>
                                                </div>
                                            </div>
                                            <img  src="<?php echo 'bootstrap' . $publicacion->Ruta ?>" class="img-responsive" alt="" style="height:500px; width: 500px;">
                                        </a>


                                    </div>

                                    <?php
                                }
                            }
                            ?>
                            <!-- start paginacion-->
                            <div class="row" id="paginacionDiv2">

                                <ul class="pager">
                                    <li><a  id="btnpaginicio2 ">&laquo;</a></li>
                                    <?php
                                    $contador = 1;

                                    $totalpag = $publicacionesMostrar;

                                    if ((($totalpag % PUBLICACIONES_X_PAG) != 0) && (($totalpag / PUBLICACIONES_X_PAG) >= 1)) {
                                        $totalpag = intval(($totalpag / PUBLICACIONES_X_PAG) + 1);
                                        ?>
                                        <?php
                                    } else {
                                        $totalpag = intval(ceil(($totalpag / PUBLICACIONES_X_PAG)));
                                    }
                                    while ($contador <= $totalpag) {
                                        ?>
                                        <li><a id="<?php echo $contador ?>"><?php echo $contador ?></a></li>
                                        <?php
                                        $contador ++;
                                    }
                                    ?>
                                    <li><a id="btnpagfin2">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--tohere-->


            <!--comienza grid e publicacines con busqueda por fecha-->
            <div class="container" id="DateDiv" style='display:none;'>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Seleccione el rango de  fechas</h2>
                        <label for="fechastart">Fecha Inicio : </label>
                        <input type="date" id="fechastart"  />

                        <label for="fechaend"> &nbsp;  &nbsp;  &nbsp; Fecha Fin: </label>
                        <input type="date" id="fechaend"  />


                        <input type="button" id="btndate" class="btn btn-primary small" value="Buscar"/>

                        <hr class="star-primary">


                        <!--here-->
                        <?php
                        //$publicacionesMostrar=null;
                        if ($TotalPaginacion != null && count($TotalPaginacion) > 0) {
                            foreach ($TotalPaginacion as $publicacion) {
                                $iterador = 0;
                                $iterador ++;
                            }
                            ?>
                            <div id= "PubsDate">
                                <?php
                                foreach ($TotalPaginacion as $publicacion) {
                                    ?>

                                    <div class="col-sm-4 portfolio-item"  >

                                        <a  id="a<?php echo $publicacion->CodigoPublicacion ?>" data-dimg='<?php echo json_encode($publicacion) ?>' class="portfolio-link callModalPublicacion"  >
                                            <div class="caption">
                                                <div class="caption-content" >
                                                    <i class="fa fa-search-plus fa-3x"></i>
                                                </div>
                                            </div>
                                            <img  src="<?php echo 'bootstrap' . $publicacion->Ruta ?>" class="img-responsive" alt="" style="height:500px; width: 500px;">
                                        </a>


                                    </div>

                                    <?php
                                }
                            }
                            ?>
                            <!-- start paginacion-->
                            <div class="row" id="paginacionDiv3">

                                <ul class="pager">
                                    <li><a  id="btnpaginicio3">&laquo;</a></li>
                                    <?php
                                    $contador = 1;

                                    $totalpag = $publicacionesMostrar;

                                    if ((($totalpag % PUBLICACIONES_X_PAG) != 0) && (($totalpag / PUBLICACIONES_X_PAG) >= 1)) {
                                        $totalpag = intval(($totalpag / PUBLICACIONES_X_PAG) + 1);
                                        ?>
                                        <?php
                                    } else {
                                        $totalpag = intval(ceil(($totalpag / PUBLICACIONES_X_PAG)));
                                    }
                                    while ($contador <= $totalpag) {
                                        ?>
                                        <li><a id="<?php echo $contador ?>"><?php echo $contador ?></a></li>
                                        <?php
                                        $contador ++;
                                    }
                                    ?>
                                    <li><a id="btnpagfin3">&raquo;</a></li>
                                </ul>
                            </div>

                            <!--tohere-->

                            <!--termia p por fecha-->

                        </div>

                    </div>

                </div>
            </div>



            <!--/comienza el grid de busqueda por nombre/-->
            <div class="container" id="NameDiv" style='display:none;'>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h3>Escriba el nombre del diplomado</h3>
                        <input type=text id="nombreDiplomado"  />
                         <input type="button" id="btname" class="btn btn-primary small" value="Buscar"/>

                        <hr class="star-primary">


                        <!--here-->
                        <?php
                        //$publicacionesMostrar=null;
                        if ($TotalPaginacion != null && count($TotalPaginacion) > 0) {
                            foreach ($TotalPaginacion as $publicacion) {
                                $iterador = 0;
                                $iterador ++;
                            }
                            ?>
                            <div id="PubName">
                                <?php
                                foreach ($TotalPaginacion as $publicacion) {
                                    ?>

                                    <div class="col-sm-4 portfolio-item"  >

                                        <a  id="a<?php echo $publicacion->CodigoPublicacion ?>" data-dimg='<?php echo json_encode($publicacion) ?>' class="portfolio-link callModalPublicacion"  >
                                            <div class="caption">
                                                <div class="caption-content" >
                                                    <i class="fa fa-search-plus fa-3x"></i>
                                                </div>
                                            </div>
                                            <img  src="<?php echo 'bootstrap' . $publicacion->Ruta ?>" class="img-responsive" alt="" style="height:500px; width: 500px;">
                                        </a>


                                    </div>

                                    <?php
                                }
                            }
                            ?>
                            <!-- start paginacion-->
                            <div class="row" id="paginacionDiv2">

                                <ul class="pager">
                                    <li><a  id="btnpaginicio2 ">&laquo;</a></li>
                                    <?php
                                    $contador = 1;

                                    $totalpag = $publicacionesMostrar;

                                    if ((($totalpag % PUBLICACIONES_X_PAG) != 0) && (($totalpag / PUBLICACIONES_X_PAG) >= 1)) {
                                        $totalpag = intval(($totalpag / PUBLICACIONES_X_PAG) + 1);
                                        ?>
                                        <?php
                                    } else {
                                        $totalpag = intval(ceil(($totalpag / PUBLICACIONES_X_PAG)));
                                    }
                                    while ($contador <= $totalpag) {
                                        ?>
                                        <li><a id="<?php echo $contador ?>"><?php echo $contador ?></a></li>
                                        <?php
                                        $contador ++;
                                    }
                                    ?>
                                    <li><a id="btnpagfin2">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--tohere-->
            <!--termina el grid de busqueda por nombre-->

        </section>



        <!-- About Section -->
        <section class="success" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>¿Quienes Somos?</h2>
                        <hr class="star-light">
                    </div>
                </div>
                <div class="row " >
                    <div class="col-lg-8 col-lg-offset-2">
                        <p style="text-align: justify;">La unidad de proyectos especiales de la facultad es la que se encarga de brindar diversos servicios entre los más destacados por su alto fortalecimiento de competencias técnicas y teóricas se encuentran los diplomados  y los cursos de idiomas extranjeros 
                            <br>los diplomados ofertados por esta unidad siempre se adecuan a las necesidades del entorno laboral, permitiendo así que las personas interesadas en someterse a una actividad de formación como los diplomados tengan accesibilidad al conocimiento adecuado para enfrentarse al mundo laboral</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Consultas</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                        <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                        <form name="sentMessage" id="contactForm" novalidate>



                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">


                                    <label>Nombre</label>
                                    <input type="text" class="form-control" placeholder="Nombre" id="name" required maxlength="150" data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Telefono</label>
                                    <input type="tel" class="form-control" placeholder="Número Telefonico" id="phone" data-mask="0000-0000" >
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Mensaje</label>
                                    <textarea rows="5" class="form-control" placeholder="Mensaje" id="message" maxlength="600" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br>
                            <div id=""></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-success btn-lg"id="btnSend">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-6">
                            <h3>Telefono de Contacto</h3>
                            <p>Universidad de El Salvador Facultad Multidiciplinaria de Occidente<br>
                                Tel: (+503) 2484 0824<br>
                                <img  src="bootstrap/images/minervaVerde.png" width="50" height="50"  /></p>
                        </div>
                        <div class="footer-col col-md-6">
                            <h3>Sitios Universitarios</h3>
                            <ul class="list-inline">
                                <li>
                                    <a href="http://www.uesocc.edu.sv" class="btn-social btn-outline" title="Academica"><i class="fa fa-fw fa-university"></i></a>
                                </li>
                                <li>
                                    <a href="https://expediente.uesocc.edu.sv/index.php" class="btn-social btn-outline" title="Expediente Academico"><i class="fa fa-fw fa-archive"></i></a>
                                </li>
                                <li>
                                    <a href="http://av.uesocc.edu.sv/" class="btn-social btn-outline" title="Aula Virtual"><i class="fa fa-fw fa-pencil"></i></a>
                                </li>
                                <li>
                                    <a href="https://correo.uesocc.edu.sv/" class="btn-social btn-outline" title="Correo Institucional"><i class="fa fa-fw fa-envelope"></i></a>
                                </li>
                                <li>
                                    <a href="http://biblioteca.uesocc.edu.sv/" class="btn-social btn-outline " title="Biblioteca"><i class="fa fa-fw fa-book"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            Copyright &copy; PAESIS 2016
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll visible-xs visible-sm">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

        <!-- Ingresar Modals -->
        <div class="portfolio-modal modal fade" id="Login2" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-content" style="background:url(bootstrap/images/profile2.png); background-repeat: no-repeat;   background-position: right bottom; background-color: white ">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!--<img class="img-centered"  height="50" width="50" src="../bootstrap/images/profile2.png" alt="">-->
                                <h2>Ingresar a PAESIS</h2>
                                <hr class="star-primary">
                                <form method="POST" action=""   class="form-group" role="form" id="Ingresar">
                                    <p>Ingrese sus credenciales</p>
                                    <style type="text/css">
                                        table{border-spacing: 0px 0px; }
                                    </style>
                                    <table class="table list-inline col-sm-4" >
                                        <!--<ul class="list-unstyled item-details ">-->
                                        <tr > <td class="text-justify">
                                                Usuario:                                            </td>
                                            <td>
                                                <strong> <input type="text" id="user" name="user"  placeholder="Email address" required autofocus>
                                                </strong>
                                                <br>
                                            </td> 
                                        </tr>

                                        <tr ><td  class="text-justify"> 
                                                Contraseña:
                                            </td>
                                            <td>
                                                <strong><input type="password" id="password" name="password"  placeholder="Password" required>
                                                </strong>
                                            </td>
                                        </tr>
                                        <!--</ul>-->
                                    </table>
                                    <b><a>En caso de olvido su contraseña debe de comunicarse con el administrador</a></b>
                                    <ul class="list-inline item-details">
                                        <li><button type="button" class="btn btn-default center-block " data-dismiss="modal">Cancelar</button></li>
                                        <li><button type="submit" class="btn btn-default center-block  " >Aceptar</button></li>
                                    </ul>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
        <!--aqui termina la modal de las publicaciones-->

        <!--Modal pop up-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">

                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">


                                <h2 id="h2TituloPub"></h2>
                                <hr class="star-primary">
                                <img  class="img-responsive img-centered " id="imgPub" alt="">
                                <p id="pContenidoPub"></p>   
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .ui-datepicker
            {
                width:auto;
                background: whitesmoke;

            }
        </style>

        <script src="bootstrap/js/websitejs.js"></script>

        <!-- Contact Form JavaScript -->
        <script src="bootstrap/js/jqBootstrapValidation.js"></script>
        <script src="bootstrap/js/contact_me.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="bootstrap/js/freelancer.js"></script>



       <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    </body>

</html>
