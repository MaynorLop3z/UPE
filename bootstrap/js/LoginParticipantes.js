
$(document).ready(function () {
    
});

$('#frmLoginParticipantes').submit(function(){
    event.preventDefault();
    var $form = $(this), Titulo = "frmLoginParticipantes",
            Participante = $form.find("input[name='login_name']").val(),
            url = $form.attr("action"),
            Password = $form.find("input[name='login_password']").val()
    var posting = $.post(url, {
        Titulo: Titulo,
        Participante: Participante,
        Password: Password
        
    });
});