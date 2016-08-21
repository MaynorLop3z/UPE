var idUser;
var comment;
var Loaded=false;

$(document).ready(function () {
    //ACCIONES VISUALES DE COMENTARIOS
    var claseListaCom='.comment-toggler .Archivo, .comment-toggler .Publicado, .comment-toggler .Descripcion';
    $(claseListaCom).css('cursor', 'pointer').click(function () {
        var id=$(this).parent().attr('id');
        $(this).parent().parent().children('#comment-'+id).toggle(300);
    });
    $('.comment').toggle(false).css('background','#ddd');
    
    //ENVIAR COMENTARIO
    $(".inputComment").keypress(function(e) {
        if(e.which === 13) {
            if ($(this).val() !== null) {
                //alert("Cuerpo de Cristo: "+$(this).val()+"\nPublicacion # "+$(this).parent().parent().attr('id').substring(11));
                id=$(this).parent().parent().attr('id').substring(11);
                var envio = $.post("ComentariosController/comentar/", {Comentario: $(this).val(),IdC: id});
                envio.done(function (data) {           
                   $(this).val('');
                   alert(data);
                });
                envio.fail(function (xhr, textStatus, errorThrown) {
                    alert("error" + xhr.responseText);
                });
            }
        }
    });
    
});

