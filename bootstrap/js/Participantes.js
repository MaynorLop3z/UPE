var codigoParticipante;
var filaEdit;
var countColor = 1;


$(document).ready(function(){
    /////////////////busqueda///////////////////////
    $('#tbNameBuscarAlum').keyup(function(event){
        var actual=$(this).val();
        var texto =actual;
        if(actual===""){
            var posting = $.post("ParticipantesController/paginParticipantes/", {"data_ini":1});
        posting.done(function (data) {
            if (data !== null) {
                $('#tablaAlumnosContent').empty();
                $('#tablaAlumnosContent').html(data);
            }
        });
        posting.fail(function (data) {
            alert("Error");
        });
        }
        else{
        var posting = $.post("ParticipantesController/buscar/",{'NombreBuscado':texto});
      posting.done(function(data){
          if(data){
             $('#tablaAlumnosContent').html(data);
          }
      });
      posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });}
    });
});

$("#DiplomadoP").change(function () {
    $("#DiplomadoP option:selected").each(function () {
        idDiplomado = $(this).val();
        var idParticipante = codigoParticipante.substring(9);
        var posting = $.post("ParticipantesController/listarGruposPeriodos/", {idDiplomado: idDiplomado, idParticipante: idParticipante}, function (data) {
            $("#bodytablaPeriodosGrupos").html(data);
        });
        posting.fail(function (xhr, textStatus, errorThrown) {
            alert("error" + xhr.responseText);
        });
    });
});

$("#btnADDAlumno").on('click', function () {
    $("#AlumnoNuevo").modal();
});

function mostrarEditAlumno(fila) {
    codigoParticipante = fila.id;
    filaEdit = fila;
    var alum = $('#alum' + codigoParticipante.substring(5));
    var Mail_Alumno = alum.find('.Mail_Alumno').html().toString().trim();
    var TelefonoFijo_Alumno = alum.find('.TelefonoFijo_Alumno').html().toString().trim();
    var TelefonoMovil_Alumno = alum.find('.TelefonoMovil_Alumno').html().toString().trim();
    var DUI_Alumno = alum.find('.DUI_Alumno').html().toString().trim();
    var Nombre_Alumno = alum.find('.Nombre_Alumno').html().toString().trim();
    var FechaNac_Alumno = alum.find('.FechaNac_Alumno').html().toString().trim();
    var Carrera_Alumno = alum.find('.Carrera_Alumno').html().toString().trim();
    var NivelAcad_Alumno = alum.find('.NivelAcad_Alumno').html().toString().trim();
    var DNombreEncargado_Alumno = alum.find('.NombreEncargado_Alumno').html().toString().trim();
    var CodPart_Alumno = alum.find('.CodCat_Alumno').html().toString().trim();
    var Descripcion_Alumno = alum.find('.Descripcion_Alumno').html().toString().trim();
    var Comentarios_Alumno = alum.find('.Comentarios_Alumno').html().toString().trim();
    var Direccion_Alumno = alum.find('.Direccion_Alumno').html().toString().trim();
    var Genero_Alumno = alum.find('.Genero_Alumno').html().toString().trim();
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
    $('#AlumnoGeneroEDIT').val(Genero_Alumno);
    $("#AlumnoEditar").modal('toggle');
}

function mostrarInfoAlumno(fila) {
    codigoParticipante = fila.id;
    var alum = $('#alum' + codigoParticipante.substring(8));
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
    var CodPart_Alumno = alum.find('.NameCat_Alumno').html().toString().trim();
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
    $("#AlumnoVIEWDATA").modal('toggle');
}

function mostrarDelAlumno(fila) {
    codigoParticipante = fila.id;
    var alum = $('#alum' + codigoParticipante.substring(7));
    var Nombre_Alumno = alum.find('.Nombre_Alumno').html().toString().trim();
    $('#nombreAlumEliminar').html(Nombre_Alumno);
    $("#AlumnoEliminar").modal('toggle');
}

function mostrarGruposPeriodos(fila) {
    codigoParticipante = fila.id;
    $("#AlumnoGrupoPeriodo").modal('toggle');
}

function inscribirUsaurio(fila) {
    var codigoDiplomado = fila.id;
    var idGrupoPeriodo = codigoDiplomado.substring(15);
    var idParticipante = codigoParticipante.substring(9);
    var url = "ParticipantesController/inscribirAlumno/";
    var posting = $.post(url, {idParticipante: idParticipante, idGrupoPeriodo: idGrupoPeriodo});
    posting.done(function (data) {
        var property = document.getElementById(codigoDiplomado);
        var obj = jQuery.parseJSON(data);
        //console.log(obj[0]);
        if (obj[0].Inscripcion === "3") {
            property.className = "btn_agregar_periodo btn btn-success";
            property.title = "Agregar alumno al periodo";
            $("#" + codigoDiplomado).html('<span class="glyphicon glyphicon-ok"></span>');
        }
        else {
            property.className = "btn_agregar_periodo btn btn-danger";
            property.title = "Eliminar alumno al periodo";
            $("#" + codigoDiplomado).html('<span class="glyphicon glyphicon-remove"></span>');
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
}
;

$("#frmADDAlumno").submit(function (event) {
    event.preventDefault();
    var $form = $(this), AlumnoNombre = $form.find("input[name='Nombre']").val(), AlumnoMail = $form.find("input[name='CorreoElectronico']").val(), AlumnoFijo = $form.find("input[name='TelefonoFijo']").val(), AlumnoMovil = $form.find("input[name='TelefonoCelular']").val(), AlumnoDir = $form.find("textarea[name=Direccion]").val(), AlumnoDUI = $form.find("input[name='NumeroDUI']").val(), AlumnoFNac = $form.find("input[name='FechaNacimiento']").val(), AlumnoCarrera = $form.find("input[name='Carrera']").val(), AlumnoNivel = $form.find("input[name='NivelAcademico']").val(), AlumnoNEncargado = $form.find("input[name='NombreEncargado']").val(), AlumnoCategoria = $form.find("select[name=CodigoCategoriaParticipantes]").val(), AlumnoDescripcion = $form.find("textarea[name=Descripcion]").val(), AlumnoComentario = $form.find("textarea[name=Comentarios]").val(), AlumnoGenero = $form.find("select[name=GeneroParticipante]").val(), url = $form.attr("action");
    var categorias = document.getElementById("AlumnoCategoria");
    var nombreCategoria = categorias.options[categorias.selectedIndex].text;
    var posting = $.post(url, {AlumnoNombre: AlumnoNombre, AlumnoMail: AlumnoMail, AlumnoFijo: AlumnoFijo, AlumnoMovil: AlumnoMovil, AlumnoDir: AlumnoDir, AlumnoDUI: AlumnoDUI, AlumnoFNac: AlumnoFNac, AlumnoCarrera: AlumnoCarrera, AlumnoNivel: AlumnoNivel, AlumnoNEncargado: AlumnoNEncargado, AlumnoCategoria: AlumnoCategoria, AlumnoDescripcion: AlumnoDescripcion, AlumnoComentario: AlumnoComentario, AlumnoGenero: AlumnoGenero});
    posting.done(function (data) {
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
            fila = fila + '<td class="Genero_Alumno" style="display: none">' + obj.Genero + '</td>';
            fila = fila + '<td class="Nombre_Alumno">' + obj.Nombre + '</td>';
            fila = fila + '<td class="FechaNac_Alumno" style="display: none">' + obj.FechaNacimiento + '</td>';
            fila = fila + '<td class="CodU_Alumno" style="display: none">' + obj.CodigoUniversidadProcedencia + '</td>';
            fila = fila + '<td class="Carrera_Alumno" style="display: none">' + obj.Carrera + '</td>';
            fila = fila + '<td class="NivelAcad_Alumno" style="display: none">' + obj.NivelAcademico + '</td>';
            fila = fila + '<td class="NombreEncargado_Alumno" style="display: none">' + obj.NombreEncargado + '</td>';
            fila = fila + '<td class="CodCat_Alumno" style="display: none">' + obj.CodigoCategoriaParticipantes + '</td>';
            fila = fila + '<td class="NameCat_Alumno">' + nombreCategoria + '</td>';
            fila = fila + '<td class="Descripcion_Alumno">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="Comentarios_Alumno" style="display: none">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_Alumno">';
            fila = fila + '<button id="AlumE' + obj.CodigoParticipante + '"  onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button id="alumDEL' + obj.CodigoParticipante + '" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '<button id="alumVIEW' + obj.CodigoParticipante + '" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>';
            fila = fila + '<button id="alumGROUP' + obj.CodigoParticipante + '" onclick="mostrarGruposPeriodos(this)" title="Agregar a Grupo" class="btn_grouo_add btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span></button>';
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
    posting.fail(function () {
        alert("error");
    });
});

$("#frmEditarAlumno").submit(function (event) {
    event.preventDefault();
    var $form = $(this), AlumnoCodigo = codigoParticipante.substring(5), AlumnoNombre = $form.find("input[name='Nombre']").val(), AlumnoMail = $form.find("input[name='CorreoElectronico']").val(), AlumnoFijo = $form.find("input[name='TelefonoFijo']").val(), AlumnoMovil = $form.find("input[name='TelefonoCelular']").val(), AlumnoDir = $form.find("textarea[name=Direccion]").val(), AlumnoDUI = $form.find("input[name='NumeroDUI']").val(), AlumnoFNac = $form.find("input[name='FechaNacimiento']").val(), AlumnoCarrera = $form.find("input[name='Carrera']").val(), AlumnoNivel = $form.find("input[name='NivelAcademico']").val(), AlumnoNEncargado = $form.find("input[name='NombreEncargado']").val(), AlumnoCategoria = $form.find("select[name=CodigoCategoriaParticipantes]").val(), AlumnoGenero = $form.find("select[name=GeneroParticipante]").val(), AlumnoDescripcion = $form.find("textarea[name=Descripcion]").val(), AlumnoComentario = $form.find("textarea[name=Comentarios]").val(), url = $form.attr("action");
    var categorias = document.getElementById("AlumnoCategoriaEDIT");
    var nombreCategoria = categorias.options[categorias.selectedIndex].text;
    var posting = $.post(url, {AlumnoCodigo: AlumnoCodigo, AlumnoNombre: AlumnoNombre, AlumnoMail: AlumnoMail, AlumnoFijo: AlumnoFijo, AlumnoMovil: AlumnoMovil, AlumnoDir: AlumnoDir, AlumnoDUI: AlumnoDUI, AlumnoFNac: AlumnoFNac, AlumnoCarrera: AlumnoCarrera, AlumnoNivel: AlumnoNivel, AlumnoNEncargado: AlumnoNEncargado, AlumnoCategoria: AlumnoCategoria, AlumnoDescripcion: AlumnoDescripcion, AlumnoComentario: AlumnoComentario, AlumnoGenero: AlumnoGenero});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila;
            //          console.log(obj);
//console.log($('#tableAlumnos > tbody').find('#alum'+obj.CodigoParticipante).html());
            fila = fila + '<td class="Mail_Alumno">' + obj.CorreoElectronico + '</td>';
            fila = fila + '<td class="TelefonoFijo_Alumno" style="display: none">' + obj.TelefonoFijo + '</td>';
            fila = fila + '<td class="TelefonoMovil_Alumno" style="display: none">' + obj.TelefonoCelular + '</td>';
            fila = fila + '<td class="Direccion_Alumno" style="display: none">' + obj.Direccion + '</td>';
            fila = fila + '<td class="DUI_Alumno" style="display: none">' + obj.NumeroDUI + '</td>';
            fila = fila + '<td class="Genero_Alumno" style="display: none">' + obj.Genero + '</td>';
            fila = fila + '<td class="Nombre_Alumno">' + obj.Nombre + '</td>';
            fila = fila + '<td class="FechaNac_Alumno" style="display: none">' + obj.FechaNacimiento + '</td>';
            fila = fila + '<td class="CodU_Alumno" style="display: none">' + obj.CodigoUniversidadProcedencia + '</td>';
            fila = fila + '<td class="Carrera_Alumno" style="display: none">' + obj.Carrera + '</td>';
            fila = fila + '<td class="NivelAcad_Alumno" style="display: none">' + obj.NivelAcademico + '</td>';
            fila = fila + '<td class="NombreEncargado_Alumno" style="display: none">' + obj.NombreEncargado + '</td>';
            fila = fila + '<td class="CodCat_Alumno" style="display: none">' + obj.CodigoCategoriaParticipantes + '</td>';
            fila = fila + '<td class="NameCat_Alumno">' + nombreCategoria + '</td>';
            fila = fila + '<td class="Descripcion_Alumno">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="Comentarios_Alumno" style="display: none">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_Alumno">';
            fila = fila + '<button id="AlumE' + obj.CodigoParticipante + '" onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button id="alumDEL' + obj.CodigoParticipante + '" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '<button id="alumVIEW' + obj.CodigoParticipante + '" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>';
            fila = fila + '<button id="alumGROUP' + obj.CodigoParticipante + '" onclick="mostrarGruposPeriodos(this)" title="Agregar a Grupo" class="btn_grouo_add btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span></button>';
            fila = fila + '</td>';
//            $(document).on("click", "#alumE" + obj.CodigoParticipante.toString(), function() {
//                codigoParticipante = obj.CodigoParticipante;
//                $("#AlumnoEditar").modal('toggle');
//            });
//            $(document).on("click", "#alumDEL" + obj.CodigoParticipante.toString(), function() {
//                codigoParticipante = obj.CodigoParticipante;
//                $("#AlumnoEliminar").modal('toggle');
//            });
//            $(document).on("click", "#alumVIEW" + obj.CodigoParticipante.toString(), function() {
//                codigoParticipante = obj.CodigoParticipante;
//                $("#AlumnoVIEWDATA").modal('toggle');
//            });
            $('#tableAlumnos > tbody').find('#alum' + obj.CodigoParticipante).html(fila);
            $("#AlumnoEditar").modal('toggle');

        }
    });
//    posting.fail(function(xhr, textStatus, errorThrown) {
//         alert("error" + xhr.responseText);
//     });
    posting.fail(function () {
        alert("error");
    });
});

$("#frmDELAlumno").submit(function (event) {
    event.preventDefault();
    var $form = $(this), AlumnoCodigo = codigoParticipante.substring(7), url = $form.attr("action");
    var posting = $.post(url, {AlumnoCodigo: AlumnoCodigo});
    posting.done(function (data) {
        if (data) {
            $("#AlumnoEliminar").modal('toggle');
            $('#tableAlumnos').find('#alum' + AlumnoCodigo).fadeOut("slow");
            $('#tableAlumnos').find('#alum' + AlumnoCodigo).remove();
        }
    });
    posting.fail(function () {
        alert("error");
    });
});

$("#frmFINDAlumno").submit(function (event) {
    event.preventDefault();
    var $form = $(this), AlumnoNombre = $form.find("input[name='NombreBuscado']").val(), url = $form.attr("action");
    var posting = $.post(url, {NombreBuscado: AlumnoNombre});
    posting.done(function (data) {
        if (data!==null) {
//            $('#tableAlumnos').html(data);
            $('#tablaAlumnosContent').html(data);
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});

////////////PAGINACION DE ALUMNOS//////////////
    
    $("#tablaAlumnosContent").on("click", "#aFirstPagParticipantes", function (e) {
        paginarParticipantes("data_ini", $(this).data("datainic"));
    });

    $("#tablaAlumnosContent").on("click", "#aLastPagParticipantes", function (e) {
        paginarParticipantes("data_ini", $(this).data("datainic"));
    });

    $("#tablaAlumnosContent").on("click", "#aPrevPagParticipantes", function (e) {
        paginarParticipantes("data_inip", null);
    });

    $("#tablaAlumnosContent").on("click", "#aNextPagParticipantes", function (e) {
        paginarParticipantes("data_inin", null);
    });
    
    function paginarParticipantes(dat, op){

        var data_in = $('#txtPagingSearchParticipantes').data("datainic");     
        var url = 'ParticipantesController/paginParticipantes/';
                
        var opcion="";
        if(dat==="data_inin"){
             opcion={"data_inin":data_in};
        }else if(dat==="data_inip"){
            opcion={"data_inip":data_in};
        }else if(dat==="data_ini"){
            data_in= op;
            opcion={"data_ini":data_in};
        }
        var posting = $.post(url, opcion);
        posting.done(function (data) {
            if (data !== null) {
                $('#tablaAlumnosContent').empty();
                $('#tablaAlumnosContent').html(data);
            }
        });
        posting.fail(function (data) {
            alert("Error");
        });
    }
    
    