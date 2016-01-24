var codigoUsuario;
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
//-*public function frmEditarUser(){
("#frmEditarUser").submit(function (event) {
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


