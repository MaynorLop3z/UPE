var codigoR;
$("#btnUsuarioNuevo").on('click', function () {
    $("#usuarioNuevo").modal();
});
$('.btn_modificar_user').on('click', function (event) {
    codigoUsuario = this.id;
    $("#usuarioModifica").modal('show');
});
$('.btn_eliminar_user').on('click', function (event) {
    codigoUsuario = this.id;
    codigoUsuario = codigoUsuario.substring(6);
    $("#usuarioElimina").modal('show');
});
$('.btn_rls_user').on('click', function (event) {
    codigoUsuario = this.id;
    codigoUsuario = codigoUsuario.substring(6);
    $("#usuarioRoles").modal('show');
});



$('#usuarioModifica').on('show.bs.modal', function (event) {
    var tr = $('#tr' + codigoUsuario);
    var dataU = tr.data("userd");
//
    $('#txtUserModificar').val(dataU.NombreUsuario);
    $('#txtNombrePersonaModifica').val(dataU.Nombre);
    $('#Emailmodificar').val(dataU.CorreoUsuario);
    $('#Passwordmodificar').val(dataU.ContraseniaUsuario);
    $('#txtAreaUserComent').val(dataU.Comentarios);
});

$('#usuarioRoles').on('show.bs.modal', function (event) {
    var url = 'UsuarioController/rolByUsr/';
    var posting = $.post(url, {cod_usr: codigoUsuario});

    posting.done(function (data) {
        if (data !== null) {
            $("#bodyTableUsrRol").html(data);
        }
    });
    posting.fail(function (data) {
        alert("error");
    });
});


$("#frmGuardarR").submit(function (event) {
    event.preventDefault();
    var $form = $(this),RolNombre = $form.find("input[name='RolName']").val(),url = $form.attr("action");
    var posting = $.post(url, {RolNombre: RolNombre});
    posting.done(function (data) {
        if (data !== null) {
            $("#tableRol > tbody > tr").remove();
            $('#tableRol > tbody').append(data);
            
        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
});

$("#frmEditarUser").submit(function (event) {
    event.preventDefault();
    var $form = $(this), UsuarioNombre = $form.find("input[name='UsuarioNombre']").val(),
            CodigoUsuario = codigoUsuario,
            UsuarioPassword = $form.find("input[name='UsuarioPassword']").val(),
            UsuarioEmail = $form.find("input[name='UsuarioEmail']").val(),
            UsuarioNombreReal = $form.find("input[name='UsuarioNombreReal']").val(),
            Comentarios = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
    var posting = $.post(url, {CodigoUsuario: CodigoUsuario, UsuarioNombre: UsuarioNombre,
        UsuarioPassword: UsuarioPassword,
        UsuarioEmail: UsuarioEmail,
        Comentarios: Comentarios,
        UsuarioNombreReal: UsuarioNombreReal});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var trUser = $('#tableUsers > tbody').find("#tr" + obj.CodigoUsuario);
            trUser.find('.nombre_Usuario').html(obj.Nombre);
            trUser.find('.correo_Usuario').html(obj.CorreoUsuario);
            trUser.find('.nickName_Usuario').html(obj.NombreUsuario);
            trUser.data("userd", obj);
            $("#usuarioModifica").modal('toggle');
        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
});

$("#frmEliminarUser").submit(function (event) {
    event.preventDefault();
    var $form = $(this), CodigoUsuario = codigoUsuario, url = $form.attr("action");
    var posting = $.post(url, {CodigoUsuario: CodigoUsuario});
    posting.done(function (data) {
        if (data) {
            $("#usuarioElimina").modal('toggle');
            $('#tableUsers').find('#tr' + codigoUsuario).fadeOut("slow");
            $('#tableUsers').find('#tr' + codigoUsuario).remove();
        }
    });
    posting.fail(function () {
        alert("error");
    });
});

$('#usuarioElimina').on('show.bs.modal', function (event) {

    var tr = $('#tr' + codigoUsuario);
    var dataU = tr.data("userd");
    $('#nombreUserEliminar').html(dataU.Nombre);
});

$('#txtPagingSearchUsr').keypress((function (e) {
    if (e.which == 13) {

        var data_inic = $('#txtPagingSearchUsr').data("datainic");
        var data_in = $('#txtPagingSearchUsr').val();

        var url = "http://localhost/UPE/index.php/UsuarioController/listarUsuariosPorRango/";
        var posting = $.post(url, {data_ini: data_in});

        posting.done(function (data) {
            if (data !== null) {
                var obj = jQuery.parseJSON(data);
                $('#tableUsers > tbody').remove();
                $.each(obj, function (k, v) {
                    console.log(v.Nombre.toString().trim() + " - " + v.CodigoUsuario);
                });
            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    }
}));


$("#frmRolUser").submit(function (event) {
    event.preventDefault();
    var url = 'http://localhost/UPE/index.php/UsuarioController/AplyRmvRols/';
    jsonRolsUsr = [];

    $('#bodyTableUsrRol tr').each(function () {
        var checkR = $(this).find(".gestion_UserR").find(".checkR");
        var r = checkR.data("rold");
        if (r != null) {
            rlObj = {};
            rlObj ["CodigoUsuario"] = codigoUsuario;
            rlObj ["CodigoRol"] = r.CodigoRol;

            if (checkR.is(":checked"))
            {
                  rlObj ["Sta"] =  "add" ;
            } else {
                rlObj ["Sta"] =  "del" ;
            }
          
            jsonRolsUsr.push(rlObj);
        }
    });
    jsonString = JSON.stringify(jsonRolsUsr);

    var posting = $.post(url, {"rolesUserSelect": jsonRolsUsr});
    posting.done(function (data) {
        if (data) {
            $("#usuarioRoles").modal('toggle');
            
//            $('#tableUsers').find('#tr' + codigoUsuario).fadeOut("slow");
//            $('#tableUsers').find('#tr' + codigoUsuario).remove();
        } else {

        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});



