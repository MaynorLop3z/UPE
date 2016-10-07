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