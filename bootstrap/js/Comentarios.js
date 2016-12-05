var idUser;
var comment;
var pager=0;

function prepararComentarios(){
    var claseListaCom='.comment-toggler .Archivo, .comment-toggler .Publicado, .comment-toggler .Descripcion';
    $(claseListaCom).css('cursor', 'pointer');
}

function cargarComentarios(pid){
        var id=pid.substring(3);
        $('#comment-'+id).html('');
        $('#comment-'+pid).toggle("slow",
            function(){
                if($('#comment-'+pid).is(':visible')){
                    $('#'+pid).css('background','#8BCCED');
                    $('#comment-'+id).html('<center><img src="../bootstrap/images/loading.gif" width=100 ></center>');
                    var load=$.post("ComentariosController/obtenerComentarios/",{publicacion:id});
                    $('.comment').css('background','#ddd');
                    load.done(function (data){
                        str = "No hay comentarios";
                        var p='';
                        
                        if(data!==null){
//                            alert(data);
                            var json_obj = $.parseJSON(data);
                            $('#comment-'+id).html('');
                            var str='';
                            
                            if(json_obj.MComentarios[0]!==undefined){
                                p=json_obj.MComentarios[0];
                            }
                            $.each( json_obj.PComentarios, function( key, val ) {
                                str=str+comentarios(val,p);
                            });
    //                        alert("comentarios = "+json_obj.CComentarios[0].totalcom+" Paginas="+json_obj.CComentarios[0].totalpag)
                            str+=cargarPaginador(id,json_obj.CComentarios[0].totalcom, 
                                json_obj.CComentarios[0].totalpag, 
                                json_obj.CComentarios[0].totact, json_obj.CComentarios[0].top);
                        }
//                            alert(json_obj.CComentarios[0].totalcom+" "+json_obj.CComentarios[0].top);
                        $('#comment-'+id).html(str);
                        if(p!==''){adminC(id)};
                        pager=2;
                        //cargar acciones de comentarios
                        $(".inputComment").keypress(function(e) {
                            
                            if(e.which === 13) {

                                if ($(this).val() !== "") {
                                    var id=$(this).parent().parent().attr('id').substring(11);
//                                    
//                                    $('#comment-'+id+' tr:first').append('<tr><td style="color:#FFFFFF;background-color:#428bca;" class="tree list-group-item">'+$(this).val()+'</td></tr>');
                                    var envio = $.post("ComentariosController/comentar/", {Comentario: $(this).val(),IdC: id});
                                    
                                    envio.done(function (data) {
                                       $('#comment-'+id).html('');
                                       $('#'+pid).css('background','#8BCCED');
                                            $('#comment-'+id).html('<center><img src="../bootstrap/images/loading.gif" width=100 ></center>');
                                            var load=$.post("ComentariosController/obtenerComentarios/",{publicacion:id});
                                            $('.comment').css('background','#ddd');
                                            load.done(function (data){
                                                str = "No hay comentarios";
                                                var p='';

                                                if(data!==null){
                        //                            alert(data);
                                                    var json_obj = $.parseJSON(data);
                                                    $('#comment-'+id).html('');
                                                    var str='';

                                                    if(json_obj.MComentarios[0]!==undefined){
                                                        p=json_obj.MComentarios[0];
                                                    }
                                                    $.each( json_obj.PComentarios, function( key, val ) {
                                                        str=str+comentarios(val,p);
                                                    });
                            //                        alert("comentarios = "+json_obj.CComentarios[0].totalcom+" Paginas="+json_obj.CComentarios[0].totalpag)
                                                    str+=cargarPaginador(id,json_obj.CComentarios[0].totalcom, 
                                                        json_obj.CComentarios[0].totalpag, 
                                                        json_obj.CComentarios[0].totact, json_obj.CComentarios[0].top);
                                                }
                                                $('#comment-'+id).html(str);
                                                if(p!==''){adminC(id)};
                                       $('.inputComment').val('');
                                       pager=2;
                                        });
                                       alert(data);
                                    });
                                    
                                    //cargarComentarios(pid);
                                    envio.fail(function (xhr, textStatus, errorThrown) {
                                        alert("error" + xhr.responseText);
                                    });
                                }else{
                                    $(this).blur();
                                }
                            }
                        });
                        
                    });
                    load.fail(function(xhr, textStatus, errorThrown){
                        alert("No se pudo cargar los comentarios");
                    });
                }else{
                    $('#'+pid).css('background','#f9f9f9');
                }
            }
        );
}


$(document).ready(function () {
    //ACCIONES VISUALES DE COMENTARIOS
    $('.comment').toggle(false).css('background','#ddd');
    //CARGAR LOS COMENTARIOS
    prepararComentarios();
    //ENVIAR COMENTARIO
    
    
});

//FORMATEAR COMENTARIO
function comentarios(val, p){
    var type="", user="", state="#8BCCED", f="";
    if(val.UsuarioComenta!==null){
        if(p!==''){
            user="Yo";
            f=p.actions+p.f1+p.f2+p.f3+p.f5;
            if(val.Aprobado==="t"){
                f=f.replace("Aprobar comentario","Aprobado");
            }
        }
        else{
            user="Profesor/a";
        }   
    }
    else{
        if(p!==''){
            f=p.actions+p.f1+p.f2+p.f3+p.f5;
            if(val.Aprobado==="t"){
                f=f.replace("Aprobar comentario","Aprobado");
            }
        }
        user=val.NombrePublica;
    }
    if(val.Aprobado!=="t"){
        state="#FF3333";
    }
    var st='<div class="list-group filaComentario" style="'+type+'" id="idcom'+val.CodigoComentarios+'"><div class="row">'+
                '<div class="col-sm-12"><div class="panel panel-default" style="border: 1px solid '+state+'; margin-bottom:0px;">'+
                    '<div class="panel-heading">'+
                        '<strong>'+user+'</strong>'+
                        '<span class="text-muted" style="margin-left:30px;margin-right:30px;">'+val.FechaComentario+'</span>'+
                        '<span> a las '+val.HoraComentario+'</span>'+f +
                        '</div><div class="panel-body">'+
                        val.Cuerpo+
                        '</div><!-- /panel-body --></div><!-- /panel panel-default -->'+
                    '</div><!-- /col-sm-5 -->'+
                '</div><!-- /row -->'+
                '<input value="'+val.ParticipanteComenta+'" type="hidden" id="userComenta'+val.CodigoComentarios+'">'+
            '</div><!-- /container -->';
    return st ;
}

function cargarPaginador(id, tcom, tpag, tota, top){
    var pie='';
    if(tcom>0 && tcom>top){
        pie='<div class="comments-pager">'+
            '<ul class="pager" id="footpagerCommentsPub'+id+'">'+
                '<li><input data-datainic="'+tota+'" type="hidden" value="'+tota+'" id="txtPagingSearchCommentsPub'+id+'" name="txtNumberPag" size="2">'/* +tpag+ */+'</li>'+
                '<li><button id="aNextPagCommentsPub'+id+'" onclick="cargarMas(\''+id+'\')" >Cargar más</button></li>'+
//                '<li><button id="aLastPagCommentsPub'+id+'"" data-datainic="' +tpag+ '" >Ultimos</button></li>'+
                '<li id="numeracionC'+id+'">(<strong id="num1'+id+'">' + tota + '</strong> de <strong id="num2'+id+'">' + tcom+ '</strong>)</li></ul></div>';
    }
    return pie;
}

function cargarMas(pid){
//    var id=pid.substring(3);
//alert(pid)
    var data_in = $("#txtPagingSearchCommentsPub"+pid).data("datainic");
    var posting = $.post("ComentariosController/paginComentarios", {"data_inin":pager,"pub":pid});
        posting.done(function (data) {
            if (data !== null) {
//                $('#tablaModulosContent').empty();
               if(data!==null){
//                            alert(data);
                            var p='';
                            var json_obj = $.parseJSON(data);
//                            $('#comment-'+pid).html('');
                            var str='';
                            
                            if(json_obj.MComentarios[0]!==undefined){
                                p=json_obj.MComentarios[0];
                            }
                            $.each( json_obj.PComentarios, function( key, val ) {
                                str=str+comentarios(val,p);
                            });
    //                        alert("comentarios = "+json_obj.CComentarios[0].totalcom+" Paginas="+json_obj.CComentarios[0].totalpag)
//                            $('#num1'+pid).html(json_obj.CComentarios[0].totact+1);
                            var n1=$('#num1'+pid).html();
                            $('#num1'+pid).html(eval(n1)+json_obj.CComentarios[0].totact);
                            var n2=eval($('#num2'+pid).html());
//                            str+=cargarPaginador(pid,json_obj.CComentarios[0].totalcom, 
//                                json_obj.CComentarios[0].totalpag, 
//                                , json_obj.CComentarios[0].top);
                            $(str).insertBefore('#footpagerCommentsPub'+pid).parent();
//                            alert("Esto vale n1 "+(eval(n1)+1)+" y esto vale n2 "+n2);
                            if((eval(n1)+json_obj.CComentarios[0].totact)===n2){
                                $('#aNextPagCommentsPub'+pid).hide();
                            }
                        }
//                            alert(json_obj.CComentarios[0].totalcom+" "+json_obj.CComentarios[0].top);
                        
                        if(p!==''){adminC(pid)};
            }
            pager=pager+2;
        });
        posting.fail(function (data) {
            alert("Error");
        });
}

//function cargarPaginador(id, tcom, tpag, tota, top){
//    var pie='';
//    if(tcom>0 && tcom>top){
//        pie='<div class="row">'+
//            '<ul class="pager" id="footpagerCommentsPub'+id+'">'+
//               '<li><button data-datainic="1" id="aFirstPagCommentsPub'+id+'"" >&lt;&lt;</button></li>'+
//                '<li><button id="aPrevPagCommentsPub'+id+'"" >&lt;</button></li>'+
//                '<li><input data-datainic="1" type="text" value="1" id="txtPagingSearchCommentsPub'+id+'"" name="txtNumberPag" size="5">/' +tpag+ '</li>'+
//                '<li><button id="aNextPagCommentsPub'+id+'"">&gt;</button></li>'+
//                '<li><button id="aLastPagCommentsPub'+id+'"" data-datainic="' +tpag+ '" >&gt;&gt;</button></li>'+
//                '<li>[1 - ' + tota + ' / ' + tcom+ ']</li></ul></div>';
//    }
//    return pie;
//}

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
function AlumnoGoTo(e, group){
    e.stopImmediatePropagation();
    var th=$("#txtPagingSearchArchivosAlumnoGrupo"+group).val();
    if (e.which === 13 && (th>0)) {
        paginarArchivosGrupo("data_ini", th, group, null);
    }
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
            prepararComentarios();
//        jQuery.ready();
        }
    });
    posting.fail(function (data) {
        alert("Error");
    });
}


