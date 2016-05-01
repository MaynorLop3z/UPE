var codigoUsuario;
$("#btnUsuarioNuevo").on('click', function () {
    $("#usuarioNuevo").modal();
});

$("#containerTablePaging").on("click", ".btn_modificar_user", function (e) {
    codigoUsuario = this.id;
    $("#usuarioModifica").modal('show');
});

$("#containerTablePaging").on("click", ".btn_eliminar_user", function (e) {
    codigoUsuario = this.id;
    codigoUsuario = codigoUsuario.substring(6);
    $("#usuarioElimina").modal('show');
});

$("#containerTablePaging").on("click", ".btn_rls_user", function (e) {
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
            var obj = jQuery.parseJSON(data);
            var fila = '<tr id="tr' + obj.CodigoUsuario + '">';
            fila = fila + '<td class="nombre_Usuario" >' + obj.Nombre + '</td>';
            fila = fila + '<td class="correo_Usuario" >' + obj.CorreoUsuario + '</td>';
            fila = fila + '<td class="nickName_Usuario" >' + obj.NombreUsuario + '</td>';
            fila = fila + '<td style="text-align:center"  class="gestion_User">';
            fila = fila + '</td></tr>';
            $('#tableUsers > tbody').append(fila);
            var trUser = $('#tableUsers > tbody').find("#tr" + obj.CodigoUsuario);
            trUser.data("userd", obj);
            var tdGestionUser = trUser.find(".gestion_User");
            var divgestionUserBtn = $("#gestionUserBtn");

            if (divgestionUserBtn !== null) {
//                var divgestionUserBtnClone = divgestionUserBtn.clone(true);
                alert('Crea el div');
                var divgestionUserBtnClone = divgestionUserBtn;
                divgestionUserBtnClone.find(".btn_modificar_user").attr("id", "" + obj.CodigoUsuario);
                divgestionUserBtnClone.find(".btn_eliminar_user").attr("id", "btnDel" + obj.CodigoUsuario);
                tdGestionUser.html(divgestionUserBtnClone);
            }
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


