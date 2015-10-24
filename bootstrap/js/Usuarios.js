var codigoUsuario;

$("#btnUsuarioNuevo").on('click', function () {
    $("#usuarioNuevo").modal();
});

$('.btn_modificar_user').on('click', function (event) {
    codigoUsuario = event.target.id;
    $("#usuarioModifica").modal('toggle');
});

$('#usuarioModifica').on('show.bs.modal', function (event) {
//                codigoUsuario = (event.target.id);
    var tr = $('#tr' + codigoUsuario);
    var correo_Usuario = tr.find('.correo_Usuario').html().toString().trim();
    var correo_Usuario = tr.find('.correo_Usuario').html().toString().trim();
    var dataU= tr.data("userd");
    if(dataU!==null){
        
    }
    $('#CodigoUser').html(codigoUsuario);
    $('#txtUserModificar').val(dataU.Nombre.toString().trim());
    $('#Emailmodificar').val(correo_Usuario);
    $('#Passwordmodificar').val(correo_Usuario);
    $('#txtAreaUserComent').val(correo_Usuario);
    // alert(codigoUsuario);
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

            var fila;//= '<tr id="tr' + obj.CodigoUsuario + '">';
            fila = fila + '<td class="nombre_Usuario" >' + obj.Nombre + '</td>';
            fila = fila + '<td class="correo_Usuario" >' + obj.CorreoUsuario + '</td>';
            fila = fila + '<td class="nickName_Usuario" >' + obj.NombreUsuario + '</td>';
            fila = fila + '<td style="text-align:center"  class="gestion_User">';
            fila = fila + '<button id="' + obj.CodigoUsuario + '"  title="Editar Usuario" class="btn_modificar_user btn btn-success "  class=" btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button data-toggle="modal" title="Eliminar Usuario" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td>';

            $(document).on("click", "#" + obj.CodigoUsuario.toString(), function () {
                codigoUsuario = obj.CodigoUsuario;
                $("#usuarioModifica").modal('toggle');
            });
            //$('#tableUsers > tbody').append(fila);
            $('#tableUsers > tbody').find("#" + obj.CodigoUsuario).html(fila);
            $("#usuarioModifica").modal('toggle');
        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
});