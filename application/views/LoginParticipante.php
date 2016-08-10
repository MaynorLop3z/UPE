<html lang="es">
    <head>
        <?php $this->load->helper('url'); ?>
        <meta charset="UTF-8">
        <title>Portal Participantes - UPESYS</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/images/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <style>
            .vcenter {
                
                vertical-align: middle;
                float: none;
            }
            body{text-align: center;
                height:90%;
                background:url(../bootstrap/images/profile2.png); background-repeat: no-repeat;   background-position: right bottom;
            }
        </style>
    </head>
  <body >

<div class="container-fluid " style="max-width: 500px;margin-top: 50px;">
    <h1 class="text-primary ">PORTAL PARA ESTUDIANTES</h1>
    <form method="post" class="vcenter" action="LoginParticipante/enter">
    <div class="login-form" id="frmLoginParticipantes">
        <div class="form-group">
            <input name="login_name" type="text" class="form-control login-field" value="" placeholder="Usuario" id="login-name" />
            <label class="login-field-icon fui-user" for="login-name"></label>
        </div>
 
        <div class="form-group">
            <input  name="login_password" type="password" class="form-control login-field" value="" placeholder="Contraseña" id="login-pass" />
            <label class="login-field-icon fui-lock" for="login-pass"></label>
        </div>
        <input class="btn btn-primary btn-lg btn-block" type="submit"  name="dlf_submit" value="ENTRAR" />
</form>
</div>

    </div>
  </body>
</html>
