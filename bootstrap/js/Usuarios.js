var codigoUsuario;

$("#btnUsuarioNuevo").on('click', function () {
    $("#usuarioNuevo").modal();
});

$('.btn_modificar_user').on('click', function (event) {
    codigoUsuario = this.id;
    $("#usuarioModifica").modal('toggle');
});

$('.btn_eliminar_user').on('click', function (event) {
    codigoUsuario = this.id;
    codigoUsuario = codigoUsuario.substring(6);
    console.log("cualquyir babosasadasdasdasdadasdsadad");
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
            fila = fila + '<button id="' + obj.CodigoUsuario + '"  title="Editar Usuario" class="btn_modificar_user btn btn-success "  class=" btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td></tr>';

            $(document).on("click", "#" + obj.CodigoUsuario.toString(), function () {
                codigoUsuario = obj.CodigoUsuario;
                $("#usuarioModifica").modal('toggle');
            });
            $('#tableUsers > tbody').append(fila);
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
            var fila;//= '<tr id="tr' + obj.CodigoUsuario + '">';
            fila = fila + '<td class="nombre_Usuario" >' + obj.Nombre + '</td>';
            fila = fila + '<td class="correo_Usuario" >' + obj.CorreoUsuario + '</td>';
            fila = fila + '<td class="nickName_Usuario" >' + obj.NombreUsuario + '</td>';
            fila = fila + '<td style="text-align:center"  class="gestion_User">';
            fila = fila + '<button id="' + obj.CodigoUsuario + '"  title="Editar Usuario" class="btn_modificar_user btn btn-success "  class=" btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td>';

            $(document).on("click", "#" + obj.CodigoUsuario, function () {
                codigoUsuario = obj.CodigoUsuario;
                $("#usuarioModifica").modal('toggle');
            });
            //$('#tableUsers > tbody').append(fila);
            var trUser = $('#tableUsers > tbody').find("#tr" + obj.CodigoUsuario);
            trUser.html(fila);
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
    console.log("codigo user es:" + codigoUsuario);
    var tr = $('#tr' + codigoUsuario);
    var dataU = tr.data("userd");
    $('#nombreUserEliminar').html(dataU.Nombre);
});



