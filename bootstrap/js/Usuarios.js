var codigoUsuario;
$("#btnUsuarioNuevo").on('click', function () {
    $("#usuarioNuevo").modal();
});

$("#containerTablePaging").on("click", ".btn_modificar_user", function (e) {
    var tr = $(this).parent().parent().parent();
    var dataU = tr.data("userd");
    codigoUsuario = dataU;
    $("#usuarioModifica").modal('show');
});

$("#containerTablePaging").on("click", ".btn_eliminar_user", function (e) {
    var tr = $(this).parent().parent().parent();
    var dataU = tr.data("userd");
    codigoUsuario = dataU;
    $("#usuarioElimina").modal('show');
});

$("#containerTablePaging").on("click", ".btn_rls_user", function (e) {
    var tr = $(this).parent().parent().parent();
    var dataU = tr.data("userd");
    codigoUsuario = dataU.CodigoUsuario;
    $("#usuarioRoles").modal('show');
});

$('#usuarioModifica').on('show.bs.modal', function (event) {

    var url = 'UsuarioController/getUsrByCod/';
    var posting = $.post(url, {codUser: codigoUsuario});

    posting.done(function (data) {
        
          if (data !== null) {
           var obj=jQuery.parseJSON(data);
            $('#txtUserModificar').val(obj.NombreUsuario);
            $('#txtNombrePersonaModifica').val(obj.Nombre);
            $('#Emailmodificar').val(obj.CorreoUsuario);
            $('#Passwordmodificar').val(obj.ContraseniaUsuario);
            $('#Password2modificar').val(obj.ContraseniaUsuario);
            $('#txtAreaUserComent').val(obj.Comentarios);
        }
    });
    posting.fail(function (data) {
        alert("error");
    });

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


$("#frmGuardarUSer").submit(function (event) {
    event.preventDefault();
    var $form = $(this), UsuarioNombre = $form.find("input[name='UsuarioNombre']").val(),
            UsuarioPassword = $form.find("input[name='UsuarioPassword']").val(),
            UsuarioEmail = $form.find("input[name='UsuarioEmail']").val(),
            UsuarioNombreReal = $form.find("input[name='UsuarioNombreReal']").val(),
            Comentarios = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
    var posting = $.post(url, {UsuarioNombre: UsuarioNombre,
        UsuarioPassword: UsuarioPassword,
        UsuarioEmail: UsuarioEmail,
        Comentarios: Comentarios,
        UsuarioNombreReal: UsuarioNombreReal});
    posting.done(function (data) {
        if (data !== null) {
            $('#containerTablePaging').empty();
            $('#containerTablePaging').html(data);

            $("#usuarioNuevo").modal('toggle');
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

$("#containerTablePaging").on("keypress", "#txtPagingSearchUsr", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13) {

        var data_inic = $('#txtPagingSearchUsr').data("datainic");
        var data_in = $('#txtPagingSearchUsr').val();

        var url = 'UsuarioController/paginUsers/';
        var posting = $.post(url, {"data_ini": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $('#containerTablePaging').empty();
                $('#containerTablePaging').html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    }
});


$("#frmRolUser").submit(function (event) {
    event.preventDefault();
    var url = 'UsuarioController/AplyRmvRols/';
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
                rlObj ["Sta"] = "add";
            } else {
                rlObj ["Sta"] = "del";
            }

            jsonRolsUsr.push(rlObj);
        }
    });
    jsonString = JSON.stringify(jsonRolsUsr);

    var posting = $.post(url, {"rolesUserSelect": jsonRolsUsr});
    posting.done(function (data) {
        if (data !== null) {
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

$('.modal-dialog').draggable({
    handle: ".modal-header"
});


