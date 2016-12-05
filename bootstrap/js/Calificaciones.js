$(document).ready(function(){
   $('.calificacion').maskMoney();
});

function guardarC(parti){
    var calif=$('#calificacion'+parti).val();
    var posting = $.post("CalificacionesController/guardarCalificacion/", {Calif:calif,Parti:parti});
    posting.done(function (data) {
        if (data !== null) {
            $('#calificacion'+parti).prop('disabled', true);
            $('#btnGuardarCalificacion'+parti).prop('disabled', true);
        }
    });
    posting.fail(function (data) {
        alert("Error al guardar");
    });
}

function editarC(parti){
    $('#calificacion'+parti).prop('disabled', false);
    $('#btnGuardarCalificacion'+parti).prop('disabled', false);
}
