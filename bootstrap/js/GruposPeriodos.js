var codigoPeriodo;
var codigoGrupoPeriodo;
$("#frmADDPeriodo").submit(function (event) {
    event.preventDefault();
    var $form = $(this), idModulo = $form.find("select[name='CodigoModulo']").val(), FechaInicio = $form.find("input[name='FechaInicioPeriodo']").val(), FechaFin = $form.find("input[name='FechaFinPeriodo']").val(), ComentariosPeriodo = $form.find("textarea[name=ComentariosPeriodo]").val(), url = $form.attr("action"), estadoPeriodo = true;
    console.log(idModulo);
    var posting = $.post(url, {idModulo: idModulo, FechaInicio: FechaInicio, FechaFin: FechaFin, ComentariosPeriodo: ComentariosPeriodo, estadoPeriodo: estadoPeriodo});
    posting.done(function (data) {
        if (data !== null) {
            $("#PeriodoNuevo").modal('toggle');
        }
    });
    posting.fail(function () {
        alert("error");
    });
});

$("#frmDELPeriodo").submit(function (event) {
    event.preventDefault();
    var $form = $(this), PeriodoCodigo = codigoPeriodo.substring(10), url = $form.attr("action");
    console.log(PeriodoCodigo);
    var posting = $.post(url, {PeriodoCodigo: PeriodoCodigo});
    posting.done(function (data) {
        if (data) {
            $("#PeriodoEliminar").modal('toggle');
            $('#tablaPeriodos').find('#Peridoo' + PeriodoCodigo).fadeOut("slow");
            $('#tablaPeriodos').find('#Periodo' + PeriodoCodigo).remove();
        }
    });
    posting.fail(function () {
        $("#PeriodoEliminar").modal('toggle');
        var msj = "<div class='alert alert-danger alert-dismissible fade in' role='alert' >";
        msj += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
        msj += "<strong>Error!</strong> Existen grupos asociados al periodo, debe eliminarlos antes de continuar.</div>";
        $('#MsjErrorPeriodo').html(msj);
//        alert("error, existen grupos asociados al periodo, elimine todos los grupos del periodo");
    });
});

$("#frmEditPeriodo").submit(function (event) {
    event.preventDefault();
    var $form = $(this), idPeriodo = codigoPeriodo.substring(8)
            , FechaInicio = $form.find("input[name='FechaInicioPeriodo']").val()
            , FechaFinal = $form.find("input[name='FechaFinPeriodo']").val()
            , Comentarios = $form.find("textarea[name='ComentariosPeriodo']").val()
            , Estado = $("#EstadoPeriodoE").prop("checked")
            , url = $form.attr("action");
    var posting = $.post(url,
            {idPeriodo: idPeriodo
                , FechaInicio: FechaInicio
                , FechaFinal: FechaFinal
                , Comentarios: Comentarios
                , Estado: (Estado) ? 1 : 0});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var trPeriodo = $('#bodytablaPeriodos').find("#Periodo" + obj.CodigoPeriodo);
            trPeriodo.find('.ffp').html(obj.FechaFinPeriodo);
            trPeriodo.find('.fip').html(obj.FechaInicioPeriodo);
            trPeriodo.find('.cp').html(obj.Comentario);
            if (obj.Estado === '1') {
                trPeriodo.find('.ep').html("Activo");
            } else {
                trPeriodo.find('.ep').html("Inactivo");
            }
            $("#PeriodoModificar").modal('toggle');
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});

$("#frmGrupoAdd").submit(function (event) {
    event.preventDefault();
    var $form = $(this), idPeriodo = codigoPeriodo.substring(10)
            , HoraEntrada = $form.find("input[name='HoraEntradaGrupo']").val()
            , HoraSalida = $form.find("input[name='HoraSalidaGrupo']").val()
            , Aula = $form.find("input[name='Aula']").val()
            , url = $form.attr("action");
    var posting = $.post(url,
            {idPeriodo: idPeriodo
                , HoraEntrada: HoraEntrada
                , HoraSalida: HoraSalida
                , Aula: Aula});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila = "";
            fila += '<tr id="GrupoPeriodo' + obj.CodigoGrupoPeriodo + '">\n';
            fila += '<td class="Estado_Grupo">' + ((obj.Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
            fila += '<td class="Hora_Entrada">' + obj.HoraEntrada + '</td>\n';
            fila += '<td class="Hora_Salida">' + obj.HoraSalida + '</td>\n';
            fila += '<td class="Aula">' + obj.Aula + '</td>\n';
            fila += '<td class="GestionButton"><button id="gestion' + obj.CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></td>';
            fila += '</tr>\n';
            $('#bodytablaPeriodosGruposO').append(fila);
            $form.find("input[name='HoraEntradaGrupo']").val("");
            $form.find("input[name='HoraSalidaGrupo']").val("");
            $form.find("input[name='Aula']").val("");
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});

function NuevoPeriodoModalShow() {
    $("#PeriodoNuevo").modal();
}

function DeletePeriodoShow(fila) {
    codigoPeriodo = fila.id;
    var perio = $('#Periodo' + codigoPeriodo.substring(10));
    var Fecha_Inicio = perio.find('.fip').html().toString().trim();
    var Fecha_Fin = perio.find('.fip').html().toString().trim();
    $('#nombrePeriodoEliminar').html(Fecha_Inicio + " al " + Fecha_Fin);
    $("#PeriodoEliminar").modal('toggle');
}

function EditPeriodoShow(fila) {
    codigoPeriodo = fila.id;
    var perio = $('#Periodo' + codigoPeriodo.substring(8));
    var Fecha_Inicio = perio.find('.fip').html().toString().trim();
    var Fecha_Fin = perio.find('.ffp').html().toString().trim();
    var Comentarios = perio.find('.cp').html().toString().trim();
    var Estado = perio.find('.ep').html().toString().trim();
    if (Estado === "Activo") {
        $("#EstadoPeriodoE").prop("checked", true);
    } else {
        $("#EstadoPeriodoE").prop("checked", false);
    }
    $('#FechaInicioPeriodoE').val(Fecha_Inicio);
    $('#FechaFinPeriodoE').val(Fecha_Fin);
    $('#ComentariosPeriodoE').val(Comentarios);
    $("#PeriodoModificar").modal('toggle');
}

function GestionPeriodoShow(fila) {
    codigoPeriodo = fila.id;
    var idPeriodo = codigoPeriodo.substring(10);
    $('#bodytablaPeriodosGruposO').html('');
    var posting = $.post("PeriodosController/listarGrupos/", {idPeriodo: idPeriodo});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var tabla = "";
            for (var x in obj) {
                tabla += '<tr id="GrupoPeriodo' + obj[x].CodigoGrupoPeriodo + '">\n';
                tabla += '<td class="Estado_Grupo">' + ((obj[x].Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
                tabla += '<td class="Hora_Entrada">' + obj[x].HoraEntrada + '</td>\n';
                tabla += '<td class="Hora_Salida">' + obj[x].HoraSalida + '</td>\n';
                tabla += '<td class="Aula">' + obj[x].Aula + '</td>\n';
                tabla += '<td class="GestionButton"><button id="gestion' + obj[x].CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></td>';
                tabla += '</tr>\n';
            }
            $('#bodytablaPeriodosGruposO').html(tabla);
            $("#PeriodoGestion").modal('toggle');
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });

}

function testShow(fila) {
    codigoGrupoPeriodo = fila.id;
    var idPeriodoGrupo = codigoGrupoPeriodo.substring(7);
    var posting = $.post("PeriodosController/listarDocentes/", {idPeriodoGrupo: idPeriodoGrupo});
    posting.done(function (data) {
        if (data !== null) {
            $('#gestionGrupoModalTitle').html('Grupo #' + idPeriodoGrupo);
            $('#DocentesGrupoPeriodo').html(data);
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
    var posting2 = $.post("PeriodosController/listarEstudiantes/", {idPeriodoGrupo: idPeriodoGrupo});
    posting2.done(function (data) {
        if (data !== null) {
            $('#EstudiantesGrupoPeriodo').html(data);
            $("#gestionGrupoModal").modal('toggle');
        }
    });
    posting2.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
}
function inscribirAlumnoGrupo(fila) {
    var idParticipante = fila.id.substring(14);
    var idGrupoPeriodo = $('#gestionGrupoModalTitle').html().substring(7);
    var url = "ParticipantesController/inscribirAlumno/";
    var posting = $.post(url, {idParticipante: idParticipante, idGrupoPeriodo: idGrupoPeriodo});
    posting.done(function (data) {
        var property = document.getElementById(fila.id);
        var obj = jQuery.parseJSON(data);
        if (obj[0].Inscripcion === "3") {
            property.className = "btn_agregar_alumno btn btn-success";
            property.title = "Agregar alumno al periodo";
            $("#" + fila.id).html('<span class="glyphicon glyphicon-ok"></span>');
        }
        else {
            property.className = "btn_agregar_alumno btn btn-danger";
            property.title = "Quitar alumno al periodo";
            $("#" + fila.id).html('<span class="glyphicon glyphicon-remove"></span>');
        }
    });
}
;