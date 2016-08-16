
$(document).ready(function () {
    
    $('#frmLoginParticipantes').submit(function (event){
    event.preventDefault();

    var $form = $(this), Titulo = "frmLoginParticipantes",
        Participante = $form.find("input[name='login_name']").val(),
        url = $form.attr("action"),
        Password = $form.find("input[name='login_password']").val();
  
    if (Participante!=="" & Password!=="") {
        message = $("<span class='before'>Entrando...</span>");
        showMessage(message);
        
        var posting = $.post(url, {
            titulo: Titulo,
            url: url,
            participante: Participante,
            password:Password
        });
        
        posting.done(function (data) {
           // alert(data);
                //var obj = jQuery.parseJSON(data);
                if (data!='0'){
                    window.location.replace('Dashboard');
//                    message = $("<span class='success' style='color:#00b33b;'>Bienvenid@. "+obj+" </span>");
//                    showMessage(message);
                }else {
                     message = $("<span class='success' style='color:#bb0033;'>Error de usuario o contraseña </span>");
                    showMessage(message);
                }
        });
        
        posting.fail(function (xhr, textStatus, errorThrown) {
            alert("error" + xhr.responseText);
        });
        }
        else{
            message = $("<span class='success' style='color:#bb0000;'>Los campos no se pueden enviar vacios.</span>");
            showMessage(message);
            $('.messages').fadeOut(3000);
        }
        
            
});
function showMessage(message) {
        $(".messages").html("").show();
        $(".messages").html(message);
    }
});

