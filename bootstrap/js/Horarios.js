$(document).ready(function(){
    $nomTurno=$('#TurnosList').find(":selected").text();
    $listTitle = $('#gruposListTurno').html();
    $('#gruposListTurno').html($listTitle+" "+$nomTurno);
});

$('#TurnosList').change(function(){
    $('#gruposListTurno').html("Grupos, Turno " + $(this).find(":selected").text());
    var turno = $(this).find(":selected").val();
    var posting = $.post("HorariosController/buscarxTurno/",{"Turno":turno});
    posting.done(function(data){
       if (data !== null) {
           $('#bodytablaGruposTurno').empty();
           $('#bodytablaGruposTurno').html(data);
       }
    });
});

$('#btnAbrirAgregarHorario').click(function(){
    $('#ModalHorarioNuevo').modal();
});

$('#formAgregarHorario').submit(function(e){
    e.preventDefault();
    var add=false;
    var inicio=horaFormateada($("#HorarioInicioHora").val(),$('#HoraInicioAmPm').val(), $('#HorarioInicioMinutos').val());
    var fin=horaFormateada($("#HorarioFinHora").val(),$('#HoraFinAmPm').val(), $('#HorarioFinMinutos').val());
    var aula=$('#AulaHorario').find(':selected').val();
    var turno=$('#TurnoHorario').find(':selected').val();
    var dia=$('#DiaHorario').find(':selected').val();
    var grupo=$('#GrupoHorario').find(':selected').val();
    
    var tiempo = new Date("2016-01-01 "+inicio);
    tiempo.setSeconds(tiempo.getSeconds() + 1);
    var HinicioComp=tiempo.getHours() + ':' +tiempo.getMinutes() + ':' + tiempo.getSeconds();
    tiempo = new Date("2016-01-01 "+fin);
    tiempo.setSeconds(tiempo.getSeconds() - 1);
    var HfinComp=tiempo.getHours() + ':' +tiempo.getMinutes() + ':' + tiempo.getSeconds();
    
    if((new Date("2016-01-01 "+fin))>(new Date("2016-01-01 "+inicio))){
        var posting=$.post("HorariosController/comprobarHorario/",{"H1":HinicioComp, "H2":HfinComp, "Aula":aula, "Turno":turno, "Dia":dia, "Grupo":grupo });
        posting.done(function(data){
           if (data !== "") {
               var choque = $.parseJSON(data);
               alert("No se puede agregar ese horario porque choca con el siguiente:\nHora Inicio:"+
                       formato12("May 01, 2016 "+choque[0].HoraEntrada)+"\nHora Fin: "+formato12("May 01, 2016  "+choque[0].HoraSalida));
           }else{
                var pos=$.post($('#formAgregarHorario').attr('action'),{"Entrada":inicio, "Salida":fin, "Aula":aula, "Turno":turno, "Dia":dia, "Grupo":grupo });
               pos.done(function(dat){
               if (dat !== "") {
                   $('#CuerpoTablaHorario').append(dat);
               }else{
                   alert("No se pudo agregar");
               }
               });
               pos.fail(function(xhr, textStatus, errorThrown) {
                alert("error al intentar agregar");
               });
           }
        });
        posting.fail(function(xhr, textStatus, errorThrown) {
            alert("error" + xhr.responseText);
        });
    }else{
        alert("La hora de finalización debe ser mayor que la hora de inicio");
    }
});

function horaFormateada(inicio,turno, minutos){
    var ini=Number(inicio);
    var Horas = (turno=="P.M." && ini<12)?(ini+12):ini;
    Horas = (Horas==12 && turno=="A.M.")?"0":Horas;
    Horas = (Number(Horas)<10)?"0"+Horas:Horas;
    var Minutos = (Number(minutos)<10)?"0"+minutos:minutos;
    var format = Horas+":"+Minutos+":00";
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
        h = hh-12;
        dd = "PM";
    }
    if (h == 0) {
        h = 12;
    }
    m = m<10?"0"+m:m;
    s = s<10?"0"+s:s;
    h = h<10?"0"+h:h; 
    var patron = new RegExp("0?"+hh+":"+m+":"+s);
    var reemplazo = h+":"+m;
    reemplazo += " "+dd;    

    return date.replace(patron,reemplazo).substring(12); 
}
$('#btnGuardarHorario').click(function(e){
    e.preventDefault();
    var posting = $.post("HorariosController/buscarxTurno/",{"Turno":"NULL"});
    posting.done(function(data){
       if (data !== null) {
           $('#bodytablaGruposTurno').empty();
           $('#bodytablaGruposTurno').html(data);
       }
    });
});

$('#GrupoHorario').change(function(e){
    var posting = $.post("HorariosController/cargarxGrupo/",{"Turno":"NULL", "Grupo":$(this).find(':selected').val()});
    posting.done(function(data){
       if (data !== null) {
           $('#CuerpoTablaHorario').empty();
           $('#CuerpoTablaHorario').html(data);
       }
    });
});

function eliminarHorario(id){
    var posting = $.post("HorariosController/eliminarHorario/",{"Id":id});
    posting.done(function(data){
       if (data !== null) {
           $('#CuerpoTablaHorario').remove('#horario'+id)
       }
    });
}