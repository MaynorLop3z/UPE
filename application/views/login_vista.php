<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../bootstrap/images/logo.png" type="image/x-icon" />
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/half-slider.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/images/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="js/less-1.3.3.min.js"></script>
        <title>Index</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/half-slider.css" rel="stylesheet">
    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <image class="img-responsive" src = "../bootstrap/images/logo.png" href="#"/>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse nav navbar-right" id="bs-example-navbar-collapse-1">
                    <form method="POST" action=""class="form-inline" role="form">
                        <div class="form-group right">
                            <label class="sr-only" for="inputEmail">Email</label>
                            <input type="text" id="user" name="user" class="form-horizontal col-lg-12" placeholder="Email address" required autofocus>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="inputPassword">Password</label>
                            <input type="password" id="password" name="password" class="form-horizontal col-lg-12" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span span class="glyphicon glyphicon-log-in"/> Login</button>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Half Page Image Background Carousel Header -->
        <header id="myCarousel" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for Slides -->
            <div class="carousel-inner">
                <div class="item active" >
                    <!-- Set the first background image using inline CSS below. -->
                    <div class="fill" style="background-image:url(../bootstrap/images/minervaSlider.png)"></div>
                </div>
                <div class="item">
                    <!-- Set the second background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
                    <div class="carousel-caption">
                        <h2>Caption 2</h2>
                    </div>
                </div>
                <div class="item">
                    <!-- Set the third background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
                    <div class="carousel-caption">
                        <h2>Caption 3</h2>
                    </div>
                </div>
                <!--div para el fondo de pantalla-->
                <div id='background'></div>
                <!--div para visualizar la imagen grande con el boton cerrar-->
                <div id='preview'><div id='close'></div><div id='content'></div></div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="icon-next"></span>
            </a>

        </header>

        <!-- Page Content -->
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
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
            </div>

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <nav class=" navbar navbar-fixed-bottom">
                            <div class="panel-footer">
                                <div class="text-center "> Universidad de El Salvador Facultad Multidiciplinaria de Occidente
                                    Unidad Proyectos Academicos Especiales  UESFmocc
                                    Tel: (+503) 2480-0800
                                    <img  src="../bootstrap/images/minervaVerde.png"  />
                                    <p>Copyright &copy; UPESYS 2015</p>
                                </div>
                            </div>
                        </nav>

                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->


        <!-- Script to Activate the Carousel -->
        <script>
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })
        </script>

    </body>

</html>
