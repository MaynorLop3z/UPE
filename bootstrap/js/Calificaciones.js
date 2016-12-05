$(document).ready(function(){
    $('.calificacion').maskMoney({'allowZero':'true'});
//   $('.calificacion').mask('00.00', {reverse: true});
});

function guardarC(parti){
    var calif=$('#calificacion'+parti).val();
    if(Number(calif)>10){
        alert("Ingrese una calificación válida (entre 0.0 y 10.0)");
    }else{
        var posting = $.post("CalificacionesController/guardarCalificacion/", {Calif:calif,Parti:parti});
        posting.done(function (data) {
            if (data !== null) {
                $('#calificacion'+parti).prop('disabled', true);
                $('#btnEditarCalificacion'+parti).prop('disabled', false);
                $('#btnGuardarCalificacion'+parti).prop('disabled', true);
                
            }
        });
        posting.fail(function (data) {
            alert("Error al guardar");
        });
    }
}

function editarC(parti){
    $('#calificacion'+parti).prop('disabled', false);
    $('#btnGuardarCalificacion'+parti).prop('disabled', false);
    $('#btnEditarCalificacion'+parti).prop('disabled', true);
}
