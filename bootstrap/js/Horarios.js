$(document).ready(function(){
    $nomTurno=$('#TurnosList').find(":selected").text();
    $listTitle = $('#gruposListTurno').html();
    $('#gruposListTurno').html($listTitle+" "+$nomTurno);
});

$('#TurnosList').change(function(){
    $('#gruposListTurno').html("Grupos, Turno " + $(this).find(":selected").text());
});