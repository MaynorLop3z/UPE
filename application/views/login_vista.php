<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/half-slider.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/images/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="js/less-1.3.3.min.js"></script>
    </head>
    <body>
        <!-- Se crea la navbar que incluye el login -->
        <div  class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">

                    <a class="navbar-brand" href="#">UPESYS</a>

                    <div>

                        <!-- de aqui empieza el form para loguin -->
                        <div class="nav navbar-nav navbar-right ">
                            <form method="POST" action=""class="form-inline" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="inputEmail">Email</label>
                                    <input type="text" id="user" name="user" class="form-horizontal col-lg-12" placeholder="Email address" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="inputPassword">Password</label>
                                    <input type="password" id="password" name="password" class="form-horizontal col-lg-12" placeholder="Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <span span class="glyphicon glyphicon-log-in"/> Login</button>
                            </form> </div><!-- de aqui termina el form para loguin -->

                    </div> 
                </div>
            </nav>

            <!-- finaliza el navbar de el login -->


            <!-- contendeor de publicaciones start-->

            <div class="container-fluid" >

                <header id="myCarousel" class="carousel slide">
                    <!-- Indicadores -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- PRUEBA -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <!-- Set the first background image using inline CSS below. -->
                            <div class="fill" style="background-image:url('../bootstrap/images/minerva.jpg=Slide One');"></div>
                            <div class="carousel-caption">
                                <h2>Caption 1</h2>
                            </div>
                        </div>
                        <div class="item">
                            <!-- Set the second background image using inline CSS below. -->
                            <div class="fill" style="background-image:url('../bootstrap/images/minerva.jpg=Slide One');"></div>
                            <div class="carousel-caption">
                                <h2>Caption 2</h2>
                            </div>
                        </div>
                        <div class="item">
                            <!-- Set the third background image using inline CSS below. -->
                            <div class="fill" style="background-image:url('../bootstrap/images/minerva.jpg=Slide Three');"></div>
                            <div class="carousel-caption">
                                <h2>Caption 3</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="icon-next"></span>
                    </a>

                    <!--  end PRUEBA -->


                </header>


            </div>
            <!-- contendeor de publicaciones end-->

            <!-- contendeor de busqueda start-->
            <div class="container col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="search" class="form-control" placeholder="Buscar" aria-describedby="basic-addon1">

                </div>

                <br>
                <ul>
                    <li  >Por Fecha</li>
                    <li>Por Departamento</li>
                    <li>Ultimas Noticias</li>
                </ul>




            </div>
            <!-- contendeor de busqueda end-->

            <!-- footer start-->
            <!--<div class="container-fluid"> -->           
            <nav class=" navbar navbar-fixed-bottom">
                <div class="panel-footer">
                    <div class="text-center "> Universidad de El Salvador Facultad Multidiciplinaria de Occidente
                        Unidad Proyectos Academicos Especiales  UESFmocc
                        Tel: (+503) 2480-0800
                        <img  src="../bootstrap/images/minervaVerde.png"  />
                    </div>
                </div>
            </nav>

            <!-- footer end-->

        </div>


    </body>
</html>