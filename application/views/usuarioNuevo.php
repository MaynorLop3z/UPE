<html>
    <body>

        <form action="validacionUsuarioN" class="form-horizontal" method="post" >
            <fieldset>
                <legend>Agregar Usuario:</legend> 
                <div class="form-group">
                    <label for="Usuario" class="col-lg-3 control-label">Usuario</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="Usuario" placeholder="Nombre Usuario">
                    </div>
                    <div class="col-lg-3">
                        <label id="usR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="col-lg-3 control-label">E-mail</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" id="Email" placeholder="Correo Electronico">
                    </div>
                    <div class="col-lg-3">
                        <label id="emR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password" class="col-lg-3 control-label">Contraseña</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="Password" placeholder="Contraseña">
                    </div>
                    <div class="col-lg-3">
                        <label id="paR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password2" class="col-lg-3 control-label">Confirmar Contraseña</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="Password2" placeholder="Repita Contraseña">
                    </div>
                    <div class="col-lg-3">
                        <label id="prR" class="warning"></label> <!-- Para  cuando el campo sea requerido-->
                    </div>
                </div>
                <input type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">
                </div>
            </fieldset>
        </form>
    </body>
</html>