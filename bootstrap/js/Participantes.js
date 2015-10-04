var codigoParticipante;

$("#btnADDAlumno").on('click', function() {

    $("#AlumnoNuevo").modal();
    //$("#myModal").modal('toggle')
});

$('.btn_modificar_alum').on('click', function(event) {
    codigoParticipante = event.target.id;
    $("#AlumnoEditar").modal('toggle');
});

$('#AlumnoEditar').on('show.bs.modal', function(event) {
//                codigoUsuario = (event.target.id);
    var alum = $('#alum' + codigoParticipante);
    var Mail_Alumno = alum.find('.Mail_Alumno').html().toString().trim();
    var TelefonoFijo_Alumno = alum.find('.TelefonoFijo_Alumno').html().toString().trim();
    var TelefonoMovil_Alumno = alum.find('.TelefonoMovil_Alumno').html().toString().trim();
    var DUI_Alumno = alum.find('.DUI_Alumno').html().toString().trim();
    var Nombre_Alumno = alum.find('.Nombre_Alumno').html().toString().trim();
    var FechaNac_Alumno = alum.find('.FechaNac_Alumno').html().toString().trim();
    var DCodU_Alumno = alum.find('.DCodU_Alumno').html().toString().trim();
    var Carrera_Alumno = alum.find('.Carrera_Alumno').html().toString().trim();
    var NivelAcad_Alumno = alum.find('.NivelAcad_Alumno').html().toString().trim();
    var DNombreEncargado_Alumno = alum.find('.NombreEncargado_Alumno').html().toString().trim();
    var CodPart_Alumno = alum.find('.CodPart_Alumno').html().toString().trim();
    var Descripcion_Alumno = alum.find('.Descripcion_Alumno').html().toString().trim();
    var Comentarios_Alumno = alum.find('.Comentarios_Alumno').html().toString().trim();
    var Direccion_Alumno = alum.find('.Direccion_Alumno').html().toString().trim();
//    $('#lblCodigoUser').html(codigoParticipante);
    $('#AlumnoNombreEDIT').val(Nombre_Alumno);
    $('#AlumnoMailEDIT').val(Mail_Alumno);
    $('#AlumnoFijoEDIT').val(TelefonoFijo_Alumno);
    $('#AlumnoMovilEDIT').val(TelefonoMovil_Alumno);
    $('#AlumnoDirEDIT').val(Direccion_Alumno);
    $('#AlumnoFNacEDIT').val(FechaNac_Alumno);
    $('#AlumnoCarreraEDIT').val(Carrera_Alumno);
    $('#AlumnoNivelEDIT').val(NivelAcad_Alumno);
    $('#AlumnoNEncargadoEDIT').val(DNombreEncargado_Alumno);
    $('#AlumnoCategoriaEDIT').val(CodPart_Alumno);
    $('#AlumnoDescripcionEDIT').val(Descripcion_Alumno);
    $('#AlumnoComentarioEDIT').val(Comentarios_Alumno);
    $('#AlumnoDUIEDIT').val(DUI_Alumno);
    // alert(codigoUsuario);
});

$("#frmADDAlumno").submit(function(event) {
    event.preventDefault();
    var $form = $(this), AlumnoNombre = $form.find("input[name='Nombre']").val(), AlumnoMail = $form.find("input[name='CorreoElectronico']").val(), AlumnoFijo = $form.find("input[name='TelefonoFijo']").val(), AlumnoMovil = $form.find("input[name='TelefonoCelular']").val(), AlumnoDir = $form.find("input[name='Direccion']").val(),AlumnoDUI = $form.find("input[name='NumeroDUI']").val(), AlumnoFNac = $form.find("input[name='FechaNacimiento']").val(), AlumnoCarrera = $form.find("input[name='Carrera']").val(), AlumnoNivel = $form.find("input[name='NivelAcademico']").val(),AlumnoNEncargado = $form.find("input[name='NombreEncargado']").val(),AlumnoCategoria = $form.find("select[name='CodigoCategoriaParticipantes']").val(),AlumnoDescripcion = $form.find("textare[name='Descripcion']").val(),AlumnoComentario = $form.find("textare[name='Comentarios']").val(),url = $form.attr("action");
    var posting = $.post(url, {AlumnoNombre: AlumnoNombre, AlumnoMail: AlumnoMail, AlumnoFijo: AlumnoFijo, AlumnoMovil: AlumnoMovil, AlumnoDir: AlumnoDir, AlumnoDUI: AlumnoDUI, AlumnoFNac: AlumnoFNac, AlumnoCarrera: AlumnoCarrera, AlumnoNivel: AlumnoNivel, AlumnoNEncargado: AlumnoNEncargado, AlumnoCategoria: AlumnoCategoria, AlumnoDescripcion: AlumnoDescripcion, AlumnoComentario: AlumnoComentario});
    posting.done(function(data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var trResult = $('#tableAlumnos tr:last').clone();
            trResult.attr('id', 'tr' + obj.CodigoParticipante);
            trResult.find('.nombre_Usuario').html(obj.Nombre);
            trResult.find('.correo_Usuario').html(obj.CorreoUsuario);
            trResult.find('.nickName_Usuario').html(obj.NombreUsuario);
            trResult.find('.gestion_User').find('.btn_modificar_alum').attr('id', obj.CodigoParticipante);
            $(document).on("click", "#" + obj.CodigoParticipante.toString(), function() {
                codigoUsuario = obj.CodigoParticipante;
                $("#AlumnoEditar").modal('toggle');
            });
            $('#tableAlumnos > tbody').append(trResult);
            $("#AlumnoNuevo").modal('toggle');
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