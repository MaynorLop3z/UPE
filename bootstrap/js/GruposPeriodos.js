var codigoPeriodo;
$("#frmADDPeriodo").submit(function(event) {
    event.preventDefault();
    var $form = $(this), idModulo = $form.find("select[name='CodigoModulo']").val(), FechaInicio = $form.find("input[name='FechaInicioPeriodo']").val(), FechaFin = $form.find("input[name='FechaFinPeriodo']").val(), ComentariosPeriodo = $form.find("textarea[name=ComentariosPeriodo]").val(), url = $form.attr("action"), estadoPeriodo = true;
    console.log(idModulo);
    var posting = $.post(url, {idModulo: idModulo, FechaInicio: FechaInicio, FechaFin: FechaFin, ComentariosPeriodo: ComentariosPeriodo, estadoPeriodo: estadoPeriodo});
    posting.done(function(data) {
        if (data !== null) {
            $("#PeriodoNuevo").modal('toggle');
        }
    });
    posting.fail(function() {
        alert("error");
    });
});
$('#PeriodoEliminar').on('show.bs.modal', function(event) {
    var perio = $('#Periodo' + codigoPeriodo.substring(10));
    var Fecha_Inicio = perio.find('.fip').html().toString().trim();
    var Fecha_Fin = perio.find('.fip').html().toString().trim();
    $('#nombrePeriodoEliminar').html(Fecha_Inicio + " al " + Fecha_Fin);
});
$('#PeriodoModificar').on('show.bs.modal', function(event) {
    var perio = $('#Periodo' + codigoPeriodo.substring(8));
    var Fecha_Inicio = perio.find('.fip').html().toString().trim();
    var Fecha_Fin = perio.find('.ffp').html().toString().trim();
    var Comentarios = perio.find('.cp').html().toString().trim();
    var Estado = perio.find('.ep').html().toString().trim();
    //console.log(Estado);
    //console.log((Estado === "Activado"));
    if (Estado === "Activo") {
        $("#EstadoPeriodoE").prop("checked", true);
    } else {
        $("#EstadoPeriodoE").prop("checked", false);
    }
//                $('#nombrePeriodoEliminar').html(Fecha_Inicio + " al " + Fecha_Fin);
    $('#FechaInicioPeriodoE').val(Fecha_Inicio);
    $('#FechaFinPeriodoE').val(Fecha_Fin);
    $('#ComentariosPeriodoE').val(Comentarios);
});
$("#frmDELPeriodo").submit(function(event) {
    event.preventDefault();
    var $form = $(this), PeriodoCodigo = codigoPeriodo.substring(10), url = $form.attr("action");
    console.log(PeriodoCodigo);
    var posting = $.post(url, {PeriodoCodigo: PeriodoCodigo});
    posting.done(function(data) {
        console.log(data);
        if (data) {
            console.log(data);
            $("#PeriodoEliminar").modal('toggle');
            $('#tablaPeriodos').find('#Peridoo' + PeriodoCodigo).fadeOut("slow");
            $('#tablaPeriodos').find('#Periodo' + PeriodoCodigo).remove();
        }
    });
    posting.fail(function() {
        alert("error");
    });
});
$("#frmEditPeriodo").submit(function(event) {
    event.preventDefault();
    var $form = $(this), idPeriodo = codigoPeriodo.substring(8)
            , FechaInicio = $form.find("input[name='FechaInicioPeriodo']").val()
            , FechaFinal = $form.find("input[name='FechaFinPeriodo']").val()
            , Comentarios = $form.find("textarea[name='ComentariosPeriodo']").val()
            , Estado = $("#EstadoPeriodoE").prop("checked")
            , url = $form.attr("action");
    console.log(Estado);
    var posting = $.post(url,
            {idPeriodo: idPeriodo
                , FechaInicio: FechaInicio
                , FechaFinal: FechaFinal
                , Comentarios: Comentarios
                , Estado: (Estado) ? 1 : 0});
    posting.done(function(data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var trPeriodo = $('#bodytablaPeriodos').find("#Periodo" + obj.CodigoPeriodo);
            trPeriodo.find('.ffp').html(obj.FechaFinPeriodo);
            trPeriodo.find('.fip').html(obj.FechaInicioPeriodo);
            trPeriodo.find('.cp').html(obj.Comentario);
//                        console.log(obj.Estado);
            if (obj.Estado === '1') {
//                            console.log("in");
                trPeriodo.find('.ep').html("Activo");
            } else {
                console.log("out");
                trPeriodo.find('.ep').html("Inactivo");
            }
            $("#PeriodoModificar").modal('toggle');
        }
    });
    posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});
$("#frmGrupoAdd").submit(function(event) {
    event.preventDefault();
    var $form = $(this), idPeriodo = codigoPeriodo.substring(10)
            , HoraEntrada = $form.find("input[name='HoraEntradaGrupo']").val()
            , HoraSalida = $form.find("input[name='HoraSalidaGrupo']").val()
//                        , Estado = $("#EstadoPeriodoE").prop("checked")
            , Aula = $form.find("input[name='Aula']").val()
            , url = $form.attr("action");
//                console.log(Estado);
    var posting = $.post(url,
            {idPeriodo: idPeriodo
                , HoraEntrada: HoraEntrada
                , HoraSalida: HoraSalida
                , Aula: Aula});
    posting.done(function(data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila = "";
            fila += '<tr id="GrupoPeriodo' + obj.CodigoGrupoPeriodo + '">\n';
            fila += '<td class="Estado_Grupo">' + ((obj.Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
            fila += '<td class="Hora_Entrada">' + obj.HoraEntrada + '</td>\n';
            fila += '<td class="Hora_Salida">' + obj.HoraSalida + '</td>\n';
            fila += '<td class="Aula">' + obj.Aula + '</td>\n';
            fila += '</tr>\n';
//                        console.log(fila);
            $('#bodytablaPeriodosGruposO').append(fila);
//                        $(this).trigger("reset");
            $form.find("input[name='HoraEntradaGrupo']").val("");
            $form.find("input[name='HoraSalidaGrupo']").val("");
            $form.find("input[name='Aula']").val("");
            //$("#PeriodoGestion").modal('toggle');
        }
    });
    posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});
$('#PeriodoGestion').on('show.bs.modal', function(event) {
    var idPeriodo = codigoPeriodo.substring(10);
    //var url = "PeriodosController/listarGrupos/";
    var posting = $.post("PeriodosController/listarGrupos/", {idPeriodo: idPeriodo});
    posting.done(function(data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var tabla = "";
            for (x in obj) {
                tabla += '<tr id="GrupoPeriodo' + obj[x].CodigoGrupoPeriodo + '">\n';
                tabla += '<td class="Estado_Grupo">' + ((obj[x].Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
                tabla += '<td class="Hora_Entrada">' + obj[x].HoraEntrada + '</td>\n';
                tabla += '<td class="Hora_Salida">' + obj[x].HoraSalida + '</td>\n';
                tabla += '<td class="Aula">' + obj[x].Aula + '</td>\n';
                tabla += '</tr>\n';
//                            for (y in obj[x]) {
//                                console.log(obj[x][y]);
//                            }
            }
                        console.log(tabla);
            $('#bodytablaPeriodosGruposO').html(tabla);

        }
    });
    posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
    //$('#nombrePeriodoEliminar').html(Fecha_Inicio + " al " + Fecha_Fin);
});
function NuevoPeriodoModalShow() {
    $("#PeriodoNuevo").modal();
}
function DeletePeriodoShow(fila) {
    codigoPeriodo = fila.id;
    $("#PeriodoEliminar").modal('toggle');
}
function EditPeriodoShow(fila) {
    codigoPeriodo = fila.id;
    $("#PeriodoModificar").modal('toggle');
}
function GestionPeriodoShow(fila) {
    codigoPeriodo = fila.id;
    $("#PeriodoGestion").modal('toggle');
}
