var codigoParticipante;
var filaEdit;

$("#btnADDAlumno").on('click', function() {

    $("#AlumnoNuevo").modal();
    //$("#myModal").modal('toggle')
});

//$('.btn_modificar_alum').on('click', function(event) {
//    codigoParticipante = this.id;
//    filaEdit = $(this);
//    //console.log(filaEdit);
//    //console.log('Clic en editar al codigo:' + codigoParticipante);
//    $("#AlumnoEditar").modal('toggle');
//});

function mostrarEditAlumno(fila){
    codigoParticipante = fila.id;
    filaEdit = fila;
    $("#AlumnoEditar").modal('toggle');
}

function mostrarInfoAlumno(fila){
    codigoParticipante = fila.id;
    $("#AlumnoVIEWDATA").modal('toggle');
}

function mostrarDelAlumno(fila){
    codigoParticipante = fila.id;
    $("#AlumnoEliminar").modal('toggle');
}

//$('.btn_ver_alum').on('click', function(event) {
//    codigoParticipante = this.id;
//    //filaEdit = $(this);
//    //console.log(filaEdit);
//    //console.log('Clic en ver al codigo:' + codigoParticipante);
//    $("#AlumnoVIEWDATA").modal('toggle');
//});

//$('.btn_eliminar_alum').on('click', function(event) {
//    codigoParticipante = this.id;
//    //filaEdit = $(this);
//    //console.log(filaEdit);
//    //console.log('Clic en eliminar al codigo:' + codigoParticipante);
//    $("#AlumnoEliminar").modal('toggle');
//});

$('#AlumnoVIEWDATA').on('show.bs.modal', function(event) {
    var alum = $('#alum' + codigoParticipante.substring(8));
    //console.log(alum);
    var Mail_Alumno = alum.find('.Mail_Alumno').html().toString().trim();
    var TelefonoFijo_Alumno = alum.find('.TelefonoFijo_Alumno').html().toString().trim();
    var TelefonoMovil_Alumno = alum.find('.TelefonoMovil_Alumno').html().toString().trim();
    var DUI_Alumno = alum.find('.DUI_Alumno').html().toString().trim();
    var Nombre_Alumno = alum.find('.Nombre_Alumno').html().toString().trim();
    var FechaNac_Alumno = alum.find('.FechaNac_Alumno').html().toString().trim();
    var Carrera_Alumno = alum.find('.Carrera_Alumno').html().toString().trim();
    var NivelAcad_Alumno = alum.find('.NivelAcad_Alumno').html().toString().trim();
    var DNombreEncargado_Alumno = alum.find('.NombreEncargado_Alumno').html().toString().trim();
    var Descripcion_Alumno = alum.find('.Descripcion_Alumno').html().toString().trim();
    var Comentarios_Alumno = alum.find('.Comentarios_Alumno').html().toString().trim();
    var Direccion_Alumno = alum.find('.Direccion_Alumno').html().toString().trim();
    var CodPart_Alumno = alum.find('.CodCat_Alumno').html().toString().trim();
    $('#AlumViewNombre').html(Nombre_Alumno);
    $('#AlumViewEmail').html(Mail_Alumno);
    $('#AlumViewTFijo').html(TelefonoFijo_Alumno);
    $('#AlumViewTMovil').html(TelefonoMovil_Alumno);
    $('#AlumViewDireccion').html(Direccion_Alumno);
    $('#AlumViewFNac').html(FechaNac_Alumno);
    $('#AlumViewCarrera').html(Carrera_Alumno);
    $('#AlumViewNivelAcad').html(NivelAcad_Alumno);
    $('#AlumViewEncargado').html(DNombreEncargado_Alumno);
    $('#AlumViewCategoria').html(CodPart_Alumno);
    $('#AlumViewDescripcion').html(Descripcion_Alumno);
    $('#AlumViewComentarios').html(Comentarios_Alumno);
    $('#AlumViewDUI').html(DUI_Alumno);
});

$('#AlumnoEditar').on('show.bs.modal', function(event) {
//                codigoUsuario = (event.target.id);
    //console.log(codigoParticipante);
    var alum = $('#alum' + codigoParticipante.substring(5));
    //console.log(alum);
    var Mail_Alumno = alum.find('.Mail_Alumno').html().toString().trim();
    var TelefonoFijo_Alumno = alum.find('.TelefonoFijo_Alumno').html().toString().trim();
    var TelefonoMovil_Alumno = alum.find('.TelefonoMovil_Alumno').html().toString().trim();
    var DUI_Alumno = alum.find('.DUI_Alumno').html().toString().trim();
    var Nombre_Alumno = alum.find('.Nombre_Alumno').html().toString().trim();
    var FechaNac_Alumno = alum.find('.FechaNac_Alumno').html().toString().trim();
    //var DCodU_Alumno = alum.find('.DCodU_Alumno').html().toString().trim();
    var Carrera_Alumno = alum.find('.Carrera_Alumno').html().toString().trim();
    var NivelAcad_Alumno = alum.find('.NivelAcad_Alumno').html().toString().trim();
    var DNombreEncargado_Alumno = alum.find('.NombreEncargado_Alumno').html().toString().trim();
    //var CodPart_Alumno = alum.find('.CodPart_Alumno').html().toString().trim();
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
    //$('#AlumnoCategoriaEDIT').val(CodPart_Alumno);
    $('#AlumnoDescripcionEDIT').val(Descripcion_Alumno);
    $('#AlumnoComentarioEDIT').val(Comentarios_Alumno);
    $('#AlumnoDUIEDIT').val(DUI_Alumno);
    // alert(codigoUsuario);
});

$('#AlumnoEliminar').on('show.bs.modal', function(event) {
    console.log("Eliminar Alumno se muestra");
    var alum = $('#alum' + codigoParticipante.substring(7));
    var Nombre_Alumno = alum.find('.Nombre_Alumno').html().toString().trim();
    $('#nombreAlumEliminar').html(Nombre_Alumno);
});


$("#frmADDAlumno").submit(function(event) {
    event.preventDefault();
    var $form = $(this), AlumnoNombre = $form.find("input[name='Nombre']").val(), AlumnoMail = $form.find("input[name='CorreoElectronico']").val(), AlumnoFijo = $form.find("input[name='TelefonoFijo']").val(), AlumnoMovil = $form.find("input[name='TelefonoCelular']").val(), AlumnoDir = $form.find("textarea[name=Direccion]").val(), AlumnoDUI = $form.find("input[name='NumeroDUI']").val(), AlumnoFNac = $form.find("input[name='FechaNacimiento']").val(), AlumnoCarrera = $form.find("input[name='Carrera']").val(), AlumnoNivel = $form.find("input[name='NivelAcademico']").val(), AlumnoNEncargado = $form.find("input[name='NombreEncargado']").val(), AlumnoCategoria = $form.find("select[name=CodigoCategoriaParticipantes]").val(), AlumnoDescripcion = $form.find("textarea[name=Descripcion]").val(), AlumnoComentario = $form.find("textarea[name=Comentarios]").val(), url = $form.attr("action");
    var posting = $.post(url, {AlumnoNombre: AlumnoNombre, AlumnoMail: AlumnoMail, AlumnoFijo: AlumnoFijo, AlumnoMovil: AlumnoMovil, AlumnoDir: AlumnoDir, AlumnoDUI: AlumnoDUI, AlumnoFNac: AlumnoFNac, AlumnoCarrera: AlumnoCarrera, AlumnoNivel: AlumnoNivel, AlumnoNEncargado: AlumnoNEncargado, AlumnoCategoria: AlumnoCategoria, AlumnoDescripcion: AlumnoDescripcion, AlumnoComentario: AlumnoComentario});
    posting.done(function(data) {
        if (data !== null) {
//console.log('No esta vacio');
            var obj = jQuery.parseJSON(data);
            //var trResult = $('#tableAlumnos tr:last').clone();
            var fila;
            fila = '<tr id="alum' + obj.CodigoParticipante + '">';
            fila = fila + '<td class="Mail_Alumno">' + obj.CorreoElectronico + '</td>';
            fila = fila + '<td class="TelefonoFijo_Alumno" style="display: none">' + obj.TelefonoFijo + '</td>';
            fila = fila + '<td class="TelefonoMovil_Alumno" style="display: none">' + obj.TelefonoCelular + '</td>';
            fila = fila + '<td class="Direccion_Alumno" style="display: none">' + obj.Direccion + '</td>';
            fila = fila + '<td class="DUI_Alumno" style="display: none">' + obj.NumeroDUI + '</td>';
            fila = fila + '<td class="Nombre_Alumno">' + obj.Nombre + '</td>';
            fila = fila + '<td class="FechaNac_Alumno" style="display: none">' + obj.FechaNacimiento + '</td>';
            fila = fila + '<td class="CodU_Alumno" style="display: none">' + obj.CodigoUniversidadProcedencia + '</td>';
            fila = fila + '<td class="Carrera_Alumno" style="display: none">' + obj.Carrera + '</td>';
            fila = fila + '<td class="NivelAcad_Alumno" style="display: none">' + obj.NivelAcademico + '</td>';
            fila = fila + '<td class="NombreEncargado_Alumno" style="display: none">' + obj.NombreEncargado + '</td>';
            fila = fila + '<td class="CodCat_Alumno">' + obj.CodigoCategoriaParticipantes + '</td>';
            fila = fila + '<td class="Descripcion_Alumno">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="Comentarios_Alumno" style="display: none">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_Alumno">';
            fila = fila + '<button id="AlumE' + obj.CodigoParticipante + '"  onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button id="alumDEL' + obj.CodigoParticipante + '" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '<button id="alumVIEW' + obj.CodigoParticipante + '" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>';
            fila = fila + '</td></tr>';
            //console.log(fila);
            $('#tableAlumnos > tbody').append(fila);
            $("#AlumnoNuevo").modal('toggle');
        }
        //console.log('data vacio');
    });
    //posting.fail(function(xhr, textStatus, errorThrown) {
    //     alert("error" + xhr.responseText);
    // });
    posting.fail(function() {
        alert("error");
    });
});


$("#frmEditarAlumno").submit(function(event) {
    event.preventDefault();
    var $form = $(this), AlumnoCodigo = codigoParticipante.substring(5), AlumnoNombre = $form.find("input[name='Nombre']").val(), AlumnoMail = $form.find("input[name='CorreoElectronico']").val(), AlumnoFijo = $form.find("input[name='TelefonoFijo']").val(), AlumnoMovil = $form.find("input[name='TelefonoCelular']").val(), AlumnoDir = $form.find("textarea[name=Direccion]").val(), AlumnoDUI = $form.find("input[name='NumeroDUI']").val(), AlumnoFNac = $form.find("input[name='FechaNacimiento']").val(), AlumnoCarrera = $form.find("input[name='Carrera']").val(), AlumnoNivel = $form.find("input[name='NivelAcademico']").val(), AlumnoNEncargado = $form.find("input[name='NombreEncargado']").val(), AlumnoCategoria = $form.find("select[name=CodigoCategoriaParticipantes]").val(), AlumnoDescripcion = $form.find("textarea[name=Descripcion]").val(), AlumnoComentario = $form.find("textarea[name=Comentarios]").val(), url = $form.attr("action");
    var posting = $.post(url, {AlumnoCodigo: AlumnoCodigo, AlumnoNombre: AlumnoNombre, AlumnoMail: AlumnoMail, AlumnoFijo: AlumnoFijo, AlumnoMovil: AlumnoMovil, AlumnoDir: AlumnoDir, AlumnoDUI: AlumnoDUI, AlumnoFNac: AlumnoFNac, AlumnoCarrera: AlumnoCarrera, AlumnoNivel: AlumnoNivel, AlumnoNEncargado: AlumnoNEncargado, AlumnoCategoria: AlumnoCategoria, AlumnoDescripcion: AlumnoDescripcion, AlumnoComentario: AlumnoComentario});
    posting.done(function(data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila;
//console.log($('#tableAlumnos > tbody').find('#alum'+obj.CodigoParticipante).html());
            fila = fila + '<td class="Mail_Alumno">' + obj.CorreoElectronico + '</td>';
            fila = fila + '<td class="TelefonoFijo_Alumno" style="display: none">' + obj.TelefonoFijo + '</td>';
            fila = fila + '<td class="TelefonoMovil_Alumno" style="display: none">' + obj.TelefonoCelular + '</td>';
            fila = fila + '<td class="Direccion_Alumno" style="display: none">' + obj.Dirreccion + '</td>';
            fila = fila + '<td class="DUI_Alumno" style="display: none">' + obj.NumeroDUI + '</td>';
            fila = fila + '<td class="Nombre_Alumno">' + obj.Nombre + '</td>';
            fila = fila + '<td class="FechaNac_Alumno" style="display: none">' + obj.FechaNacimiento + '</td>';
            fila = fila + '<td class="CodU_Alumno" style="display: none">' + obj.CodigoUniversidadProcedencia + '</td>';
            fila = fila + '<td class="Carrera_Alumno" style="display: none">' + obj.Carrera + '</td>';
            fila = fila + '<td class="NivelAcad_Alumno" style="display: none">' + obj.NivelAcademico + '</td>';
            fila = fila + '<td class="NombreEncargado_Alumno" style="display: none">' + obj.NombreEncargado + '</td>';
            fila = fila + '<td class="CodCat_Alumno">' + obj.CodigoCategoriaParticipantes + '</td>';
            fila = fila + '<td class="Descripcion_Alumno">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="Comentarios_Alumno" style="display: none">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_Alumno">';
            fila = fila + '<button id="AlumE' + obj.CodigoParticipante + '" onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button id="alumDEL' + obj.CodigoParticipante + '" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '<button id="alumVIEW' + obj.CodigoParticipante + '" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>';
            fila = fila + '</td>';
            $(document).on("click", "#alumE" + obj.CodigoParticipante.toString(), function() {
                codigoParticipante = obj.CodigoParticipante;
                $("#AlumnoEditar").modal('toggle');
            });
            $(document).on("click", "#alumDEL" + obj.CodigoParticipante.toString(), function() {
                codigoParticipante = obj.CodigoParticipante;
                $("#AlumnoEliminar").modal('toggle');
            });
            $(document).on("click", "#alumVIEW" + obj.CodigoParticipante.toString(), function() {
                codigoParticipante = obj.CodigoParticipante;
                $("#AlumnoVIEWDATA").modal('toggle');
            });
            $('#tableAlumnos > tbody').find('#alum' + obj.CodigoParticipante).html(fila);
            $("#AlumnoEditar").modal('toggle');

        }
    });
//    posting.fail(function(xhr, textStatus, errorThrown) {
//         alert("error" + xhr.responseText);
//     });
    posting.fail(function() {
        alert("error");
    });
});



$("#frmDELAlumno").submit(function(event) {
    event.preventDefault();
    var $form = $(this), AlumnoCodigo = codigoParticipante.substring(7), url = $form.attr("action");
    var posting = $.post(url, {AlumnoCodigo: AlumnoCodigo});
    posting.done(function(data) {
        if (data) {
            $("#AlumnoEliminar").modal('toggle');
            $('#tableAlumnos').find('#alum' + AlumnoCodigo).fadeOut("slow");
            $('#tableAlumnos').find('#alum' + AlumnoCodigo).remove();
        }
    });
    posting.fail(function() {
        alert("error");
    });
});


$("#frmFINDAlumno").submit(function(event) {
    event.preventDefault();
    var $form = $(this), AlumnoNombre = $form.find("input[name='NombreBuscado']").val(), url = $form.attr("action");
    var posting = $.post(url, {NombreBuscado: AlumnoNombre});
    posting.done(function(data) {
        if (data) {
            $('#tableAlumnos').html(data);
        }
    });
//    posting.fail(function() {
//        alert("error");
//    });
    posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});