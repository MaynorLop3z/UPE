//var codigoUsuario;
//var postSend=false;
//$("#btnUsuarioNuevo").on('click', function () {
//    $("#usuarioNuevo").modal();
//});
//
//$("#containerTablePaging").on("click", ".btn_modificar_user", function (e) {
//    var tr = $(this).parent().parent().parent();
//    var dataU = tr.data("userd");
//    codigoUsuario = dataU;
//    $("#usuarioModifica").modal('show');
//});
//
//$("#containerTablePaging").on("click", ".btn_eliminar_user", function (e) {
//    var tr = $(this).parent().parent().parent();
//    var dataU = tr.data("userd");
//    codigoUsuario = dataU;
//    $("#usuarioElimina").modal('show');
//});
//
//$("#containerTablePaging").on("click", ".btn_rls_user", function (e) {
//    var tr = $(this).parent().parent().parent();
//    var dataU = tr.data("userd");
//    codigoUsuario = dataU;
//    $("#usuarioRoles").modal('show');
//});
//
//$('#usuarioModifica').on('show.bs.modal', function (event) {
//
//    var url = 'UsuarioController/getUsrByCod/';
//    var posting = $.post(url, {codUser: codigoUsuario});
//
//    posting.done(function (data) {
//
//        if (data !== null) {
//            var obj = jQuery.parseJSON(data);
//            $('#txtUserModificar').val(obj.NombreUsuario);
//            $('#txtNombrePersonaModifica').val(obj.Nombre);
//            $('#Emailmodificar').val(obj.CorreoUsuario);
//            $('#Passwordmodificar').val(obj.ContraseniaUsuario);
//            $('#Password2modificar').val(obj.ContraseniaUsuario);
//            $('#txtAreaUserComent').val(obj.Comentarios);
//        }
//    });
//    posting.fail(function (data) {
//        alert("error");
//    });
//
//});
//
//$('#usuarioRoles').on('show.bs.modal', function (event) {
//    var url = 'UsuarioController/rolByUsr/';
//    var posting = $.post(url, {cod_usr: codigoUsuario});
//
//    posting.done(function (data) {
//        if (data !== null) {
//            $("#bodyTableUsrRol").html(data);
//        }
//    });
//    posting.fail(function (data) {
//        alert("error");
//    });
//});
//
//
$("#frmSearchAlum").submit(function (event) {

    searchParticipante(event);

});

function searchParticipante(event) {
    event.preventDefault();
    var posting = $.post('PagosController/buscarAlum/', $('#frmSearchAlum').serializeArray());
//
    posting.done(function (data) {

        if (data !== null) {

            $('#containerTablePagingPag').empty();
            $('#containerTablePagingPag').html(data);
            

//            $("#usuarioNuevo").modal().hide();
        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
}

$("#txtNombAlum").on("keypress", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13) {
        searchParticipante(e);
    }
});
$("#txtCarnetAlum").on("keypress", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13) {
        searchParticipante(e);
    }
});
$("#txtDuiAlum").on("keypress", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13) {
        searchParticipante(e);
    }
});
