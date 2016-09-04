var idUser;
var comment;

function cargarComentarios(){
    var claseListaCom='.comment-toggler .Archivo, .comment-toggler .Publicado, .comment-toggler .Descripcion';
    $(claseListaCom).css('cursor', 'pointer').click(function () {
        var pid=$(this).parent().attr('id');
        var id=pid.substring(3);
        $('#comment-'+id).html('');
        $(this).parent().parent().children('#comment-'+pid).toggle("slow",
            function(){
                if($('#comment-'+pid).is(':visible')){
                    $('#comment-'+id).html('<center><img src="../bootstrap/images/loading.gif" width=100 ></center>');
                    var load=$.post("ComentariosController/obtenerComentarios/",{publicacion:id});
                    load.done(function (data){
                        str = "No hay comentarios";
                        if(data!==null){
//                            alert(data);
                            var json_obj = $.parseJSON(data);
                            $('#comment-'+id).html('');
                            var str='';
                            $.each( json_obj.PComentarios, function( key, val ) {
                                str=str+comentarios(val);
                            });
    //                        alert("comentarios = "+json_obj.CComentarios[0].totalcom+" Paginas="+json_obj.CComentarios[0].totalpag)
                            str+=cargarPaginador(id,json_obj.CComentarios[0].totalcom, 
                                json_obj.CComentarios[0].totalpag, 
                                json_obj.CComentarios[0].totact, json_obj.CComentarios[0].top);
                        }
//                            alert(json_obj.CComentarios[0].totalcom+" "+json_obj.CComentarios[0].top);
                        $('#comment-'+id).html(str);
                        
                    });
                    load.fail(function(xhr, textStatus, errorThrown){
                        alert("No se pudo cargar los comentarios");
                    });
                }
            }
        );
    });
}
$(document).ready(function () {
    //ACCIONES VISUALES DE COMENTARIOS
    $('.comment').toggle(false).css('background','#ddd');
    //CARGAR LOS COMENTARIOS
    cargarComentarios();
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

//FORMATEAR COMENTARIO
function comentarios(val){
    var type="";
    if (val.ComentarioPadre!==null){
        type="margin-left:3opx;";
    }
    var st='<div class="list-group" style="'+type+'"><div class="row">'+
                '<div class="col-sm-12"><div class="panel panel-default">'+
                    '<div class="panel-heading">'+
                        '<strong>'+val.NombrePublica+'</strong>'+
                        '<span class="text-muted" style="margin-left:30px;margin-right:30px;">'+val.FechaComentario+'</span>'+
                        '<span> a las '+val.HoraComentario+'</span>'+
                        '<span class="btn btn-info" style="float:right;"><span class="glyphicon glyphicon-pencil"></span></span> '+
                        '<span  data-toggle="context" data-target="#context-menu" class="ctx_menu btn btn-info" style="float:right;"><span class="glyphicon glyphicon-cog"></span></span>'+
                        '</div><div class="panel-body">'+
                        val.Cuerpo+
                        '</div><!-- /panel-body --></div><!-- /panel panel-default -->'+
                    '</div><!-- /col-sm-5 -->'+
                '</div><!-- /row -->'+
            '</div><!-- /container -->';
    return st ;
}

function cargarPaginador(id, tcom, tpag, tota, top){
    var pie='';
    if(tcom>0 && tcom>top){
        pie='<div class="row">'+
            '<ul class="pager" id="footpagerCommentsPub'+id+'">'+
               '<li><button data-datainic="1" id="aFirstPagCommentsPub'+id+'"" >&lt;&lt;</button></li>'+
                '<li><button id="aPrevPagCommentsPub'+id+'"" >&lt;</button></li>'+
                '<li><input data-datainic="1" type="text" value="1" id="txtPagingSearchCommentsPub'+id+'"" name="txtNumberPag" size="5">/' +tpag+ '</li>'+
                '<li><button id="aNextPagCommentsPub'+id+'"">&gt;</button></li>'+
                '<li><button id="aLastPagCommentsPub'+id+'"" data-datainic="' +tpag+ '" >&gt;&gt;</button></li>'+
                '<li>[1 - ' + tota + ' / ' + tcom+ ']</li></ul></div>';
    }
    return pie;
}

///paginar AlumnosArchivosGrupo
function goFirstPaginAlumno(group){
    paginarArchivosGrupo("data_ini", $('#aFirstPagArchivosAlumnoGrupo'+group).data("datainic"), group, null);
}
function goBackPaginAlumno(group){
    paginarArchivosGrupo("data_inip", null, group, null);
}
function goNextPaginAlumno(group){
    paginarArchivosGrupo("data_inin", null, group, null);
}
function goLastPaginAlumno(group){
    paginarArchivosGrupo("data_ini", $('#aLastPagArchivosAlumnoGrupo'+group).data("datainic"), group, null);
}

//paginador de archivos por grupo
function paginarArchivosGrupo(dat, op, group, who){
    var content='', data_in='', url='', la=who;
    if(who===null){
        content = '#ArchivosGrupoAlumnoContent'+group;
        data_in = $('#txtPagingSearchArchivosAlumnoGrupo'+group).data("datainic");
        la = 'a'; //la: lavel access, a = Alumno
    }else{
        content = '#ArchivosGrupoMaestroContent'+group;
        data_in = $('#txtPagingSearchArchivosMaestroGrupo'+group).data("datainic");
    }
    url = 'ArchivosController/paginArchivosGrupo/';
    var opcion="";
    if(dat==="data_inin"){
         opcion={"data_inin":data_in, "grupo":group, "la": la}; 
    }else if(dat==="data_inip"){
        opcion={"data_inip":data_in, "grupo":group, "la": la};
    }else if(dat==="data_ini"){
        data_in= op;
        opcion={"data_ini":data_in, "grupo":group, "la": la};
    }
    var posting = $.post(url, opcion);
    posting.done(function (data) {
        if (data !== null) {
            $(content).empty();
            $(content).html(data);
            $('.comment').toggle(false);
            cargarComentarios();
        }
    });
    posting.fail(function (data) {
        alert("Error");
    });
}