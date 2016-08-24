var idUser;
var comment;

$(document).ready(function () {
    //ACCIONES VISUALES DE COMENTARIOS
    var claseListaCom='.comment-toggler .Archivo, .comment-toggler .Publicado, .comment-toggler .Descripcion';
    $(claseListaCom).css('cursor', 'pointer').click(function () {
        var pid=$(this).parent().attr('id');
        $(this).parent().parent().children('#comment-'+pid).toggle("slow",
            function(){
                if($('#comment-'+pid).is(':visible')){
                    var id=pid.substring(3);
                    var load=$.post("ComentariosController/obtenerComentarios/",{publicacion:id});
                    load.done(function (data){
                        var json_obj = $.parseJSON(data);
                        $('#comment-'+id).html('');
                        var str='';
                        $.each( json_obj, function( key, val ) {
                            str=str+comentarios(val);
                        });
                        $('#comment-'+id).html(str);
                        
                    });
                    load.fail(function(xhr, textStatus, errorThrown){
                        alert("No se pudo cargar los comentarios");
                    });
                }
            }
        );

    });
    $('.comment').toggle(false).css('background','#ddd');
    
    //ENVIAR COMENTARIO
    $(".inputComment").keypress(function(e) {
        if(e.which === 13) {
            if ($(this).val() !== "") {
                var id=$(this).parent().parent().attr('id').substring(11);
                $('#comment-'+id).last().after('<ul><li style="color:#FFFFFF;background-color:#428bca;" class="tree list-group-item node-treeview5 node-selected">'+$(this).val()+'</li></ul>');
                var envio = $.post("ComentariosController/comentar/", {Comentario: $(this).val(),IdC: id});
                envio.done(function (data) {           
                   $(this).val('');
                   alert(data);
                });
                envio.fail(function (xhr, textStatus, errorThrown) {
                    alert("error" + xhr.responseText);
                });
            }else{
                $(this).blur();
            }
        }
    });
    
});

function comentarios(val){
    var st='<div class="list-group"><div class="row">'+
                '<div class="col-sm-12"><div class="panel panel-default">'+
                    '<div class="panel-heading">'+
                        '<strong>'+val.NombrePublica+'</strong>'+
                        '<span class="text-muted" style="margin-left:30px;margin-right:30px;">'+val.FechaComentario+'</span>'+
                        '<span> a las '+val.HoraComentario+'</span>'+
                        '<span  class="btn btn-info" style="float:right;"><span class="glyphicon glyphicon-cog"></span></span>'+
                        '</div><div class="panel-body">'+
                        val.Cuerpo+
                        '</div><!-- /panel-body --></div><!-- /panel panel-default -->'+
                    '</div><!-- /col-sm-5 -->'+
                '</div><!-- /row -->'+
            '</div><!-- /container -->';
    return st ;
}