var codigoPeriodo;
var codigoGrupoPeriodo;
var FI, FF;
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
    $('#modalNuevoGrupo').modal();
//    var $form = $(this), idPeriodo = codigoPeriodo.substring(10)
//            , HoraEntrada = $form.find("input[name='HoraEntradaGrupo']").val()
//            , HoraSalida = $form.find("input[name='HoraSalidaGrupo']").val()
//            , Aula = $form.find("input[name='Aula']").val()
//            , url = $form.attr("action");
//    var posting = $.post(url,
//            {idPeriodo: idPeriodo
//                , HoraEntrada: HoraEntrada
//                , HoraSalida: HoraSalida
//                , Aula: Aula});
//    posting.done(function (data) {
//        if (data !== null) {
//            var obj = jQuery.parseJSON(data);
//            var fila = "";
//            fila += '<tr id="GrupoPeriodo' + obj.CodigoGrupoPeriodo + '">\n';
//            fila += '<td class="Estado_Grupo">' + ((obj.Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
//            fila += '<td class="Hora_Entrada">' + obj.HoraEntrada + '</td>\n';
//            fila += '<td class="Hora_Salida">' + obj.HoraSalida + '</td>\n';
//            fila += '<td class="Aula">' + obj.Aula + '</td>\n';
//            fila += '<td class="GestionButton"><button id="gestion' + obj.CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></td>';
//            fila += '</tr>\n';
//            $('#bodytablaPeriodosGruposO').append(fila);
//            $form.find("input[name='HoraEntradaGrupo']").val("");
//            $form.find("input[name='HoraSalidaGrupo']").val("");
//            $form.find("input[name='Aula']").val("");
//        }
//    });
//    posting.fail(function (xhr, textStatus, errorThrown) {
//        alert("error" + xhr.responseText);
//    });
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
    var perio = $('#Periodo' + codigoPeriodo.substring(10));
    FI = perio.find('.fip').html().toString().trim();
    FF = perio.find('.ffp').html().toString().trim();

    var idPeriodo = codigoPeriodo.substring(10);
    $('#bodytablaPeriodosGruposO').html('');
//    var posting = $.post("PeriodosController/listarGrupos/", {idPeriodo: idPeriodo});
    var posting = $.post("PeriodosController/listarGruposHorarios/", {idPeriodo: idPeriodo});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var tabla = "", acumHE = '', acumHS = '', acumA = '', acumD = '';
            var dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
            var gactual = '';
            for (var x = 0; x < obj.length; x++) {

                if (gactual != obj[x].CodigoGrupoPeriodo) {
                    acumHE = obj[x].HoraEntrada, acumHS = obj[x].HoraSalida, acumA = obj[x].NombreAula, acumD = dias[obj[x].Dia - 1];
                    var y = Number(x) + 1, z = Number(obj.length) - 1;

                    for (var i = y; i < obj.length; i++) {

                        if (i < obj.length && obj[i].CodigoGrupoPeriodo == obj[x].CodigoGrupoPeriodo) {
                            gactual = obj[i].CodigoGrupoPeriodo;
                            acumHE = acumHE + "<br>" + obj[i].HoraEntrada;
                            acumHS = acumHS + "<br>" + obj[i].HoraSalida;
                            acumA = acumA + "<br>" + obj[i].NombreAula;
                            acumD = acumD + "<br>" + dias[obj[i].Dia - 1];
                        }
                    }
//                   
                    tabla += '<tr id="GrupoPeriodo' + obj[x].CodigoGrupoPeriodo + '">\n';
                    tabla += '<td class="Codigo_Grupo">' + obj[x].CodigoGrupoPeriodo + '</td>\n';
                    tabla += '<td class="Estado_Grupo">' + ((obj[x].Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';

                    if (acumHS != null || acumHS != null) {
                        tabla += '<td class="Hora_Entrada">' + acumHE + '</td>\n';
                        tabla += '<td class="Hora_Salida">' + acumHS + '</td>\n';
                        tabla += '<td class="Aula">' + acumA + '</td>\n';
                        tabla += '<td class="Dia">' + acumD + '</td>\n';
                    } else {
                        tabla += "<td colspan=4>Sin horario asignado</td>"
                    }
//<<<<<<< Updated upstream
                    
                    tabla += '<td class="GestionButton"><button id="gestion' + obj[x].CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Grupo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button>\n\
                                                        <button id="impr' + obj[x].CodigoGrupoPeriodo + '" onclick="printDetailGrupo(this)" title="Imprimir detalle" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-print"></span></button></td>';
                    
//=======
//
//                    tabla += '<td class="GestionButton"><button id="gestion' + obj[x].CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></td>';
//>>>>>>> Stashed changes
                    tabla += '</tr>\n';
                }

//                tabla += '<tr id="GrupoPeriodo' + obj[x].CodigoGrupoPeriodo + '">\n';
//                tabla += '<td class="Codigo_Grupo">' + obj[x].CodigoGrupoPeriodo + '</td>\n';
//                tabla += '<td class="Estado_Grupo">' + ((obj[x].Estado === 't') ? 'Activo' : 'Inactivo') + '</td>\n';
//                tabla += '<td class="Hora_Entrada">' + obj[x].HoraEntrada + '</td>\n';
//                tabla += '<td class="Hora_Salida">' + obj[x].HoraSalida + '</td>\n';
//                tabla += '<td class="Aula">' + obj[x].Aula + '</td>\n';
//                tabla += '<td class="GestionButton"><button id="gestion' + obj[x].CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></td>';
//                tabla += '</tr>\n';
            }
            $('#bodytablaPeriodosGruposO').html(tabla);
            $("#PeriodoGestion").modal('toggle');
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
}

function printDetailGrupo(fila) {
    codigoGrupoPeriodo = fila.id;
    var idPeriodoGrupo = codigoGrupoPeriodo.substring(4);
    
//    var posting = $.post("PeriodosController/crearReporteDetalleGrupo/", {idPeriodoGrupo: idPeriodoGrupo}); 
//    posting.done(function (data) {
//        window.open(data);
//    });
//    posting.fail(function (xhr, textStatus, errorThrown) {
//        alert("error" + xhr.responseText);
//    });

window.open('PeriodosController/crearReporteDetalleGrupo/?idPeriodoGrupo='+idPeriodoGrupo);
    
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
            //$("#gestionGrupoModal").modal('toggle');
        }
    });
    posting2.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
    var postinga = $.post("HorariosController/cargarAulas/", {Aulas: "Aulas"});
    postinga.done(function (data) {
        if (data !== null) {
            $('#AulaHorarioGrupo').html(data);
        }
    });
    postinga.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
    var posting3 = $.post("HorariosController/cargarxGrupo/", {Grupo: idPeriodoGrupo, GA: "GA"});
    posting3.done(function (data) {
        if (data !== null) {
            $('#HorarioDelGrupoPeriodo').html(data);
            $('#PeriodoGestion').modal('hide')
            $("#gestionGrupoModal").modal('toggle');

        }
    });
    posting2.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
}
$('#FindAlumnoNombre').keyup(function (event) { //BUSCA USUARIO AL EDITAR 
    var actual = $(this).val();
    var filtro = $('#FindAlumnoNombre').val();
    //console.log(filtro);
    var idPeriodoGrupo = codigoGrupoPeriodo.substring(7);
    var posting2 = $.post("PeriodosController/listarEstudiantesFiltrados/", {idPeriodoGrupo: idPeriodoGrupo, filtro: filtro});
    posting2.done(function (data) {
        if (data !== null) {
            $('#EstudiantesGrupoPeriodo').html(data);
        }
    });
    posting2.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});
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
        } else {
            property.className = "btn_agregar_alumno btn btn-danger";
            property.title = "Quitar alumno al periodo";
            $("#" + fila.id).html('<span class="glyphicon glyphicon-remove"></span>');
        }
    });
}
;

function asignarDocente(fila) {
    var idUsuario = fila.id.substring(15);
    var idGrupoPeriodo = $('#gestionGrupoModalTitle').html().substring(7);
    var url = "PeriodosController/inscribirDocente/";
    var posting = $.post(url, {idUsuario: idUsuario, idGrupoPeriodo: idGrupoPeriodo});
    posting.done(function (data) {
        var property = document.getElementById(fila.id);
        var obj = jQuery.parseJSON(data);
        if (obj[0].Inscripcion === "3") {
            property.className = "btn_agregar_docente btn btn-success";
            property.title = "Asignar docente al periodo";
            $("#" + fila.id).html('<span class="glyphicon glyphicon-ok"></span>');
        } else {
            property.className = "btn_agregar_docente btn btn-danger";
            property.title = "Desasignar docente al periodo";
            $("#" + fila.id).html('<span class="glyphicon glyphicon-remove"></span>');
        }
    });
}
;

////////////PAGINACION DE ALUMNOS INSCRIBIR//////////////

$("#G").on("click", "#aFirstPagParticipantesInscribir", function (e) {
    paginarParticipantesInscribir("data_ini", $(this).data("datainic"), codigoGrupoPeriodo.substring(7));
});

$("#EstudiantesGrupoPeriodo").on("click", "#aLastPagParticipantesInscribir", function (e) {
    paginarParticipantesInscribir("data_ini", $(this).data("datainic"), codigoGrupoPeriodo.substring(7));
});

$("#EstudiantesGrupoPeriodo").on("click", "#aPrevPagParticipantesInscribir", function (e) {
    paginarParticipantesInscribir("data_inip", null, codigoGrupoPeriodo.substring(7));
});

$("#EstudiantesGrupoPeriodo").on("click", "#aNextPagParticipantesInscribir", function (e) {
    paginarParticipantesInscribir("data_inin", null, codigoGrupoPeriodo.substring(7));
});

$("#EstudiantesGrupoPeriodo").on("keypress", "#txtPagingSearchParticipantesInscribir", function (e) {
    e.stopImmediatePropagation();
    if (e.which === 13 && ($(this).val() > 0)) {
        paginarParticipantesInscribir("data_ini", $(this).val(), codigoGrupoPeriodo.substring(7));
    }
});

function paginarParticipantesInscribir(dat, op, gr) {
    var data_in = $('#txtPagingSearchParticipantesInscribir').data("datainic");
    var url = 'PeriodosController/paginEstudiantes/';
    var opcion = "";
    if (dat === "data_inin") {
        opcion = {"data_inin": data_in, idPeriodoGrupo: gr};
    } else if (dat === "data_inip") {
        opcion = {"data_inip": data_in, idPeriodoGrupo: gr};
    } else if (dat === "data_ini") {
        data_in = op;
        opcion = {"data_ini": data_in, idPeriodoGrupo: gr};
    }
    var posting = $.post(url, opcion);
    posting.done(function (data) {
        if (data !== null) {
            $('#EstudiantesGrupoPeriodo').empty();
            $('#EstudiantesGrupoPeriodo').html(data);
        }
    });
    posting.fail(function (data) {
        alert("Error");
    });
}
var idGrupoPer
//para horarios
function eliminarHorarioGrupo(id) {
    idGrupoPer = id;
    $('#frmEliminarHorario').modal();
}
$('#btnEliminarHorarioDeGrupo').click(function () {
    var posting = $.post("HorariosController/eliminarHorario/", {"Id": idGrupoPer});
    posting.done(function (data) {
        if (data !== null) {
            $('#horario' + idGrupoPer).hide();
            $('#frmEliminarHorario').modal('toggle');
        }
    });
});
$('#btnEnviarGrupoHADD').click(function (e) {
    e.preventDefault();
    var $form = $(this), idPeriodo = codigoPeriodo.substring(10)
            , HoraEntrada = '00:00:00'
            , HoraSalida = '00:00:00'
            , Aula = 'XXX'
            , url = 'PeriodosController/insertGrupo/';
    var posting = $.post(url,
            {idPeriodo: idPeriodo
                , HoraEntrada: HoraEntrada
                , HoraSalida: HoraSalida
                , Aula: Aula});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila = "";
            fila += '<tr id="GrupoPeriodo' + obj.CodigoGrupoPeriodo + '">';
            fila += '<td class="Estado_Grupo">' + ((obj.Estado === 't') ? 'Activo' : 'Inactivo') + '</td>';
            fila += '<td class="Hora_Entrada" colspan=4>Sin horario asignado</td>';
            fila += '<td class="GestionButton"><button id="gestion' + obj.CodigoGrupoPeriodo + '" onclick="testShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></td>';
            fila += '</tr>\n';
            $('#bodytablaPeriodosGruposO').append(fila);
            $('#modalNuevoGrupo').modal('toggle');
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});
$('#formAgregarHorarioGrupo').submit(function (e) {
    e.preventDefault();
//        alert(FI+" - "+FF);
    var add = false;
    var inicio = horaFormateada($("#HorarioInicioHoraGrupo").val(), $('#HoraInicioAmPmGrupo').val(), $('#HorarioInicioMinutosGrupo').val());
    var fin = horaFormateada($("#HorarioFinHoraGrupo").val(), $('#HoraFinAmPmGrupo').val(), $('#HorarioFinMinutosGrupo').val());
    var aula = $('#AulaHorarioGrupo').find(':selected').val();
    var naula = $('#AulaHorarioGrupo').find(':selected').text();
    var turno = $('#TurnoHorarioGrupo').find(':selected').val();
    var dia = $('#DiaHorarioGrupo').find(':selected').val();
    var grupo = codigoGrupoPeriodo.substring(7);

    var tiempo = new Date("2016-01-01 " + inicio);
    tiempo.setSeconds(tiempo.getSeconds() + 1);
    var HinicioComp = tiempo.getHours() + ':' + tiempo.getMinutes() + ':' + tiempo.getSeconds();
    tiempo = new Date("2016-01-01 " + fin);
    tiempo.setSeconds(tiempo.getSeconds() - 1);
    var HfinComp = tiempo.getHours() + ':' + tiempo.getMinutes() + ':' + tiempo.getSeconds();

    if ((new Date("2016-01-01 " + fin)) > (new Date("2016-01-01 " + inicio))) {
        var posting = $.post("HorariosController/comprobarHorario/", {"H1": HinicioComp, "H2": HfinComp, "Aula": aula, "Turno": turno, "Dia": dia, "Grupo": grupo, "FI": FI, "FF": FF});
        posting.done(function (data) {
            if (data !== "") {
                var choque = $.parseJSON(data);
                alert("No se puede agregar ese horario porque choca con el siguiente:\nHora Inicio:" +
                        formato12("May 01, 2016 " + choque[0].HoraEntrada) + "\nHora Fin: " + formato12("May 01, 2016  " + choque[0].HoraSalida));
            } else {
                var pos = $.post($('#formAgregarHorarioGrupo').attr('action'), {"Entrada": inicio, "Salida": fin, "Aula": aula, "Turno": turno, "Dia": dia, "Grupo": grupo, naula: naula, GA: "GA"});
                pos.done(function (dat) {
                    if (dat !== "") {
                        $('#HorarioDelGrupoPeriodo').append(dat);
                        $('#ModalHorarioNuevoGrupo').modal('toggle');

                    } else {
                        alert("No se pudo agregar");
                    }
                });
                pos.fail(function (xhr, textStatus, errorThrown) {
                    alert("error al intentar agregar");
                });
            }
        });
        posting.fail(function (xhr, textStatus, errorThrown) {
            alert("error" + xhr.responseText);
        });
    } else {
        alert("La hora de finalización debe ser mayor que la hora de inicio");
    }
});

function horaFormateada(inicio, turno, minutos) {
    var ini = Number(inicio);
    var Horas = (turno == "P.M." && ini < 12) ? (ini + 12) : ini;
    Horas = (Horas == 12 && turno == "A.M.") ? "0" : Horas;
    Horas = (Number(Horas) < 10) ? "0" + Horas : Horas;
    var Minutos = (Number(minutos) < 10) ? "0" + minutos : minutos;
    var format = Horas + ":" + Minutos + ":00";
    return format;
}

function formato12(date) {
    var d = new Date(date);
    var hh = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    var dd = "AM";
    var h = hh;
    if (h >= 12) {
        h = hh - 12;
        dd = "PM";
    }
    if (h == 0) {
        h = 12;
    }
    m = m < 10 ? "0" + m : m;
    s = s < 10 ? "0" + s : s;
    h = h < 10 ? "0" + h : h;
    var patron = new RegExp("0?" + hh + ":" + m + ":" + s);
    var reemplazo = h + ":" + m;
    reemplazo += " " + dd;

    return date.replace(patron, reemplazo).substring(12);
}
//
//$('.FindAlumnoClass').keyup(function(event){
//    var idPeriodoGrupo = codigoGrupoPeriodo.substring(7);
//    var posting2 = $.post("PeriodosController/listarEstudiantes/", {idPeriodoGrupo: idPeriodoGrupo});
//    posting2.done(function (data) {
//        if (data !== null) {
//            $('#EstudiantesGrupoPeriodo').html(data);
//            //$("#gestionGrupoModal").modal('toggle');
//        }
//    });
//});