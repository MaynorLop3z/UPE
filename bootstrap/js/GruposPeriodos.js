var codigoPeriodo;
var codigoGrupoPeriodo;
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
        //console.log(data);
        if (data) {
            //console.log(data);
            $("#PeriodoEliminar").modal('toggle');
            $('#tablaPeriodos').find('#Peridoo' + PeriodoCodigo).fadeOut("slow");
            $('#tablaPeriodos').find('#Periodo' + PeriodoCodigo).remove();
        }
    });
    posting.fail(function() {
        $("#PeriodoEliminar").modal('toggle');
        var msj = "<div class='alert alert-danger alert-dismissible fade in' role='alert' >";
            msj += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
            msj +=  "<strong>Error!</strong> Existen grupos asociados al periodo, debe eliminarlos antes de continuar.</div>";
            $('#MsjErrorPeriodo').html(msj);
//        alert("error, existen grupos asociados al periodo, elimine todos los grupos del periodo");
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
    //console.log(Estado);
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
                //console.log("out");
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
            fila += '<td class="GestionButton"><button id="gestion' + obj.CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></td>';
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
    $('#bodytablaPeriodosGruposO').html('');
    var posting = $.post("PeriodosController/listarGrupos/", {idPeriodo: idPeriodo});
    posting.done(function(data) {
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

        }
    });
    posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});
$('#gestionGrupoModal').on('show.bs.modal', function(event) {
   var idPeriodoGrupo = codigoGrupoPeriodo.substring(7);
   var posting = $.post("PeriodosController/listarDocentes/", {idPeriodoGrupo: idPeriodoGrupo});
   posting.done(function(data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var tabla = "";
            for (var x in obj) {
                tabla += '<tr id="GrupoUser' + obj[x].codigousuario + '">\n';
                tabla += '<td class="DocenteIdUsuario">' + obj[x].codigousuario + '</td>\n';
                tabla += '<td class="DocenteUsuario">' + obj[x].nombre + '</td>\n';
                tabla += '<td class="DocenteInscrito">' + obj[x].inscrito + '</td>\n';
                tabla += '</tr>\n';

        }
        
            $('#DocentesGrupoPeriodo').html(tabla);
        }
    });
    posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
    
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
function testShow(fila) {
    codigoGrupoPeriodo = fila.id;
    $("#gestionGrupoModal").modal('toggle');
}
