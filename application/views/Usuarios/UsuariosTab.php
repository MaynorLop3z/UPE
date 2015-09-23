<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Usuarios</h3>
    </div>
    <div class="panel-body">
        <script type="text/javascript">
            var codigoUsuario;

            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(1500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
            });

            $("#btnUsuarioNuevo").on('click', function() {

                $("#usuarioNuevo").modal();
                //$("#myModal").modal('toggle')
            });

            $('.btn_modificar_user').on('click', function(event) {
                codigoUsuario = event.target.id;
                $("#usuarioModifica").modal('toggle');
            });

            $('#usuarioModifica').on('show.bs.modal', function(event) {
//                codigoUsuario = (event.target.id);
                var tr = $('#tr' + codigoUsuario);
                var nombre_Usuario = tr.find('.nombre_Usuario').html().toString().trim();
                var correo_Usuario = tr.find('.correo_Usuario').html().toString().trim();
                var correo_Usuario = tr.find('.correo_Usuario').html().toString().trim();
                $('#lblCodigoUser').html(codigoUsuario);
                $('#txtUserModificar').val(nombre_Usuario);
                $('#Emailmodificar').val(correo_Usuario);
                $('#Passwordmodificar').val(correo_Usuario);
                // alert(codigoUsuario);
            });

            $("#frmGuardarUSer").submit(function(event) {
                event.preventDefault();
                var $form = $(this), UsuarioNombre = $form.find("input[name='UsuarioNombre']").val(), UsuarioPassword = $form.find("input[name='UsuarioPassword']").val(), UsuarioEmail = $form.find("input[name='UsuarioEmail']").val(), url = $form.attr("action");
                var posting = $.post(url, {UsuarioNombre: UsuarioNombre, UsuarioPassword: UsuarioPassword, UsuarioEmail: UsuarioEmail});
                posting.done(function(data) {
                    if (data !== null) {
                        var obj = jQuery.parseJSON(data);
                        var trResult = $('#tableUsers tr:last').clone();
                        trResult.attr('id', 'tr' + obj.CodigoUsuario);
                        trResult.find('.nombre_Usuario').html(obj.Nombre);
                        trResult.find('.correo_Usuario').html(obj.CorreoUsuario);
                        trResult.find('.nickName_Usuario').html(obj.NombreUsuario);
                        trResult.find('.gestion_User').find('.btn_modificar_user').attr('id', obj.CodigoUsuario);
                        $('#tableUsers > tbody').append(trResult);
                        $("#usuarioNuevo").modal('toggle');
                    }
                });
                posting.fail(function() {
                    alert("error");
                });
            });


            $("#frmEditarUser").submit(function(event) {
                event.preventDefault();
                var $form = $(this), UsuarioNombre = $form.find("input[name='UsuarioNombre']").val(), UsuarioPassword = $form.find("input[name='UsuarioPassword']").val(), UsuarioEmail = $form.find("input[name='UsuarioEmail']").val(), url = $form.attr("action");
                var posting = $.post(url, {UsuarioNombre: UsuarioNombre, UsuarioPassword: UsuarioPassword, UsuarioEmail: UsuarioEmail});
                posting.done(function(data) {
                    if (data !== null) {
                        var obj = jQuery.parseJSON(data);
                        var trResult = $('#tableUsers tr:last').clone();
                        trResult.attr('id', 'tr' + obj.CodigoUsuario);
                        trResult.find('.nombre_Usuario').html(obj.Nombre);
                        trResult.find('.correo_Usuario').html(obj.CorreoUsuario);
                        trResult.find('.nickName_Usuario').html(obj.NombreUsuario);
                        trResult.find('.gestion_User').find('.btn_modificar_user').attr('id', obj.CodigoUsuario);
                        //                                    $('#tableUsers > tbody').append(trResult);
                        //                                    $('#usuarioNuevo').modal('hide');
                        //                                    $('body').removeClass('modal-open');
                        //                                    $('.modal-backdrop').remove();
                        //$("#divp").load('UsuarioController');
                    }
                });
                posting.fail(function() {
                    alert("error");
                });
            });
        </script>
        <div id="mensajes">

            </div>
            <div   class="container well">

                <button id="btnUsuarioNuevo" class="btn btn-default" ><span class="glyphicon glyphicon-plus"></span>Usuario Nuevo</button>
            </div>
        <div id="divp">
                <table id="tableUsers" class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Gestionar</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        foreach ($Usuarios as $user) {
                            ?>
                            <tr id="tr<?php echo $user->CodigoUsuario ?>">
                                <td class="nombre_Usuario" ><?= $user->Nombre ?></td>
                                <td class="correo_Usuario" ><?= $user->CorreoUsuario ?></td>
                                <td class="nickName_Usuario" ><?= $user->NombreUsuario ?></td>
                                <td class="gestion_User">
                                    <button id="<?php echo $user->CodigoUsuario ?>"  title="Editar Usuario" class="btn_modificar_user btn btn-success "  class=" btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>
                                    <button data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-trash"></span></button></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>   
            </div>
        
        
        <!--</div>-->
    </div>
    <!--<div class="panel-footer">Panel footer</div>-->
</div>