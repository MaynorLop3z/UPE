<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
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

            <!-- contendeor de busqueda start-->
            <div class="container col-lg-3">

                <h1>hola  mundo</h1>
            </div>
            <!-- contendeor de busqueda end-->

            <!-- contendeor de publicaciones start-->
            <div class="container-fluid">
                <h1> soy una publicacion </h1>
            </div>
            <!-- contendeor de publicaciones end-->

            <!-- footer start-->
            <div class="panel-footer">
                <h3>dfkjfkjfkdjk</h3> 
            </div>
            <!-- footer end-->
        </div>
        
    </body>
</html>