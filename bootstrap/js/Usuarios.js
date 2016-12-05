var codigoUsuario;
var postSend=false;

$(document).ready(function(){
//    $('#txtNombrePersonaModificar').filter_input({regex:'[a-zA-Z_]'});
    $('#txtNombrePersonaModificar').bind('keyup blur',function(){ 
        var node = $(this);
        node.val(node.val().replace(/[^a-z]/g,'') ); }
    );$
});

$("#btnUsuarioNuevo").on('click', function () {
    $("#usuarioNuevo").modal();
});

$("#containerTablePaging").on("click", ".btn_modificar_user", function (e) {
    var tr = $(this).parent().parent().parent();
    var dataU = tr.data("userd");
    codigoUsuario = dataU;
    $("#usuarioModifica").modal('show');
    var url = 'UsuarioController/getUsrByCod/';
    var posting = $.post(url, {codUser: codigoUsuario});

    posting.done(function (data) {

        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            $('#txtUserModificar').val(obj.NombreUsuario);
            $('#txtNombrePersonaModifica').val(obj.Nombre);
            $('#Emailmodificar').val(obj.CorreoUsuario);
            $('#Passwordmodificar').val(obj.ContraseniaUsuario);
            $('#Password2modificar').val(obj.ContraseniaUsuario);
            $('#txtAreaUserComent').val(obj.Comentarios);
        }
    });
    posting.fail(function (data) {
        alert("error");
    });
});

$("#containerTablePaging").on("click", ".btn_eliminar_user", function (e) {
    var tr = $(this).parent().parent().parent();
    var dataU = tr.data("userd");
    codigoUsuario = dataU;
    $("#usuarioElimina").modal('show');
       var tr = $('#tr' + codigoUsuario);
    var dataU = tr.data("userd");
    $('#nombreUserEliminar').html(dataU.Nombre);
});

$("#containerTablePaging").on("click", ".btn_rls_user", function (e) {
    var tr = $(this).parent().parent().parent();
    var dataU = tr.data("userd");
    codigoUsuario = dataU;
    $("#usuarioRoles").modal('show');
     var url = 'UsuarioController/rolByUsr/';
    var posting = $.post(url, {cod_usr: codigoUsuario});

    posting.done(function (data) {
        if (data !== null) {
            $("#bodyTableUsrRol").html(data);
        }
    });
    posting.fail(function (data) {
        alert("error");
    });
});

//$('#usuarioModifica').on('show.bs.modal', function (event) {
//
//    
//
//});

//$('#usuarioRoles').on('show.bs.modal', function (event) {
//   
//});


$("#frmGuardarUSer").submit(function (event) {
    event.preventDefault();
//    if(!postSend){
//        postSend=true;
    var $form = $(this), UsuarioNombre = $form.find("input[name='UsuarioNombre']").val(),
            UsuarioPassword = $form.find("input[name='UsuarioPassword']").val(),
            UsuarioEmail = $form.find("input[name='UsuarioEmail']").val(),
            UsuarioNombreReal = $form.find("input[name='UsuarioNombreReal']").val(),
            Comentarios = $form.find("textarea[name='Comentarios']").val(),
            url = 'UsuarioController/guardarUsuario/';
    var posting = $.post(url, {UsuarioNombre: UsuarioNombre,
        UsuarioPassword: UsuarioPassword,
        UsuarioEmail: UsuarioEmail,
        Comentarios: Comentarios,
        UsuarioNombreReal: UsuarioNombreReal});
    posting.done(function (data) {
    
        if (data !== null) {
            
            $('#containerTablePaging').empty();
            $('#containerTablePaging').html(data);
            $("#usuarioNuevo").modal('toggle');

//          $("#usuarioNuevo").modal().hide();
        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
//    }
});

$("#frmEditarUser").submit(function (event) {
    event.preventDefault();
    var form = $(this), UsuarioNombre = form.find("input[name='UsuarioNombre']").val(),
            CodigoUsuario = codigoUsuario,
            UsuarioPassword = form.find("input[name='UsuarioPassword']").val(),
            UsuarioEmail = form.find("input[name='UsuarioEmail']").val(),
            UsuarioNombreReal = form.find("input[name='UsuarioNombreReal']").val(),
            Comentarios = form.find("textarea[name='Comentarios']").val(),
            url = form.attr("action");
    var posting = $.post(url, {CodigoUsuario: CodigoUsuario, UsuarioNombre: UsuarioNombre,
        UsuarioPassword: UsuarioPassword,
        UsuarioEmail: UsuarioEmail,
        Comentarios: Comentarios,
        UsuarioNombreReal: UsuarioNombreReal});
    posting.done(function (data) {
        if (data !== null) {
            
            $('#containerTablePaging').empty();
            $('#containerTablePaging').html(data);

            $("#usuarioModifica").modal('toggle');
        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
});

$("#frmEliminarUser").submit(function (event) {
    event.preventDefault();
    var $form = $(this), CodigoUsuario = codigoUsuario, url = $form.attr("action");
    var posting = $.post(url, {CodigoUsuario: CodigoUsuario});
    posting.done(function (data) {
        if (data) {
            $("#usuarioElimina").modal('toggle');
            $('#tableUsers').find('#tr' + codigoUsuario).fadeOut("slow");
            $('#tableUsers').find('#tr' + codigoUsuario).remove();
        }
    });
    posting.fail(function () {
        alert("El usuario contiene bitacoras en el sistema las cuales impiden borrarlo.");
    });
});

//$('#usuarioElimina').on('show.bs.modal', function (event) {
//
// 
//});

$("#containerTablePaging").on("keypress", "#txtPagingSearchUsr", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13 && ($(this).val()>0)) {

        //var data_in = $('#txtPagingSearchUsr').data("datainic");
        var data_in = $('#txtPagingSearchUsr').val();

        var url = 'UsuarioController/paginUsers/';
        var posting = $.post(url, {"data_ini": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $('#containerTablePaging').empty();
                $('#containerTablePaging').html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    }
});


$("#frmRolUser").submit(function (event) {
    event.preventDefault();
    var url = 'UsuarioController/AplyRmvRols/';
    jsonRolsUsr = [];

    $('#bodyTableUsrRol tr').each(function () {
        var checkR = $(this).find(".gestion_UserR").find(".checkR");
        var r = checkR.data("rold");
        if (r != null) {
            rlObj = {};
            rlObj ["CodigoUsuario"] = codigoUsuario;
            rlObj ["CodigoRol"] = r.CodigoRol;

            if (checkR.is(":checked"))
            {
                rlObj ["Sta"] = "add";
            } else {
                rlObj ["Sta"] = "del";
            }

            jsonRolsUsr.push(rlObj);
        }
    });
    jsonString = JSON.stringify(jsonRolsUsr);

    var posting = $.post(url, {"rolesUserSelect": jsonRolsUsr});
    posting.done(function (data) {
        if (data !== null) {
            $("#usuarioRoles").modal('toggle');

//            $('#tableUsers').find('#tr' + codigoUsuario).fadeOut("slow");
//            $('#tableUsers').find('#tr' + codigoUsuario).remove();
        } else {

        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});



$("#containerTablePaging").on("click", "#aFirstPag", function (e) {
    
    
    var data_in= $(this).data("datainic");
       
        var url = 'UsuarioController/paginUsers/';
        var posting = $.post(url, {"data_ini": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $('#containerTablePaging').empty();
                $('#containerTablePaging').html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    
});

$("#containerTablePaging").on("click", "#aLastPag", function (e) {
    
    var data_in= $(this).data("datainic");
       
        var url = 'UsuarioController/paginUsers/';
        var posting = $.post(url, {"data_ini": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $('#containerTablePaging').empty();
                $('#containerTablePaging').html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    
});

$("#containerTablePaging").on("click", "#aPrevPag", function (e) {
    
   var data_in = $('#txtPagingSearchUsr').data("datainic");
       // var data_in = $('#txtPagingSearchUsr').val();
        var url = 'UsuarioController/paginUsers/';
        var posting = $.post(url, {"data_inip": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $('#containerTablePaging').empty();
                $('#containerTablePaging').html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    
});

$("#containerTablePaging").on("click", "#aNextPag", function (e) {
    
    var data_in = $('#txtPagingSearchUsr').data("datainic");
        //var data_in = $('#txtPagingSearchUsr').val();
     
        var url = 'UsuarioController/paginUsers/';
        var posting = $.post(url, {"data_inin": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $('#containerTablePaging').empty();
                $('#containerTablePaging').html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    
});

//BUSQUEDA
$('#frmfindUsuario').submit(function(event){
    event.preventDefault();
});
$('#btnCleanSearchUsuarios').click(function(){
     $('#FindUsuario').val('');
     $('#FindUsuarioCorreo').val('');
     $('#FindUsuarioNick').val('');
     paginGeneral();
});

$('.FindUsuarioClass').keyup(function(event){ //BUSCA USUARIO AL EDITAR LA CAJA DE TEXTO 'NOMBRE'
        var actual=$(this).val();
        var nombre =$('#FindUsuario').val();
        var correo = $('#FindUsuarioCorreo').val();
        var nick = $('#FindUsuarioNick').val();
        if(nombre.length>0 && correo.length==0 && nick.length==0){ //FILTRA BUSQUEDA SOLO POR NOMBRE
            buscarParametrosUsuario('FindByNombre', nombre, correo, nick);
        }
        if(nombre.length==0 && correo.length>0 && nick.length==0){ //FILTRA BUSQUEDA SOLO POR CORREO
            buscarParametrosUsuario('FindByCorreo', nombre, correo, nick);
        }
        if(nombre.length==0 && correo.length==0 && nick.length>0){ //FILTRA BUSQUEDA SOLO POR NOMBRE DE USUARIO
            buscarParametrosUsuario('FindByNick', nombre, correo, nick);
        }
        else if (nombre.length>0 && correo.length>0 && nick.length==0){ //FILTRA BUSQUEDA POR NOMBRE Y CORREO
            buscarParametrosUsuario('FindByNombre+Correo', nombre, correo, nick);
        }
        else if (nombre.length>0 && correo.length==0 && nick.length>0){ //FILTRA BUSQUEDA POR NOMBRE Y NOMBRE DE USUARIO
            buscarParametrosUsuario('FindByNombre+Nick', nombre, correo, nick);
        }
        else if (nombre.length==0 && correo.length>0 && nick.length>0){ //FILTRA BUSQUEDA POR CORREO Y NOMBRE DE USUARIO
            buscarParametrosUsuario('FindByCorreo+Nick', nombre, correo, nick);
        }
        else if (nombre.length>0 && correo.length>0 && nick.length>0){ //FILTRA BUSQUEDA POR NOMBRE, CORREO Y NOMBRE DE USUARIO
            buscarParametrosUsuario('FindByNombre+Correo+Nick', nombre, correo, nick);
        }
        else if(nombre.length==0 && correo.length==0 && nick.length==0){
            buscarParametrosUsuario('Reset', null, null, null)
        }
    });

    //BUSCA USUARIO SEGUN LOS PARAMETROS Y CAMPOS DE TEXTO RELLENADOS
    function buscarParametrosUsuario(find, texto, correo, nick){
        //REALIZA LA BUSQUEDA SEGUN EL TIPO DE FILTRO
        if(find=='Reset'){
            paginGeneral();
        }
        else{
            var opcion='';
            switch (find){
                case "FindByNombre":
                opcion={FindUsuario:texto};
                break;
            case "FindByCorreo": 
                opcion={Correo:correo};
                break;
            case "FindByNick":
                opcion={Nick:nick};
                break;
            case "FindByNombre+Correo":
                opcion={FindUsuario:texto, Correo:correo};
                break;
            case 'FindByNombre+Nick':
                opcion={FindUsuario:texto, Nick:nick};
                break;
            case 'FindByCorreo+Nick':
                opcion={Correo:correo, Nick:nick};
                break;
            case "FindByNombre+Correo+Nick":
                opcion={FindUsuario:texto, Correo:correo, Nick:nick};
                break;
            }
            var posting = $.post("UsuarioController/BuscarUsuario/",opcion);
            posting.done(function(data){
                if(data){
                   $('#containerTablePaging').html(data);
                }
            });
            posting.fail(function(xhr, textStatus, errorThrown) {
              alert("error" + xhr.responseText);
            });
        }
    }
    
    function paginGeneral(){
        var posting = $.post("UsuarioController/paginUsers/", {"data_ini":1});
            posting.done(function (data) {
                if (data !== null) {
                    $('#containerTablePaging').empty();
                    $('#containerTablePaging').html(data);
                }
            });
            posting.fail(function (data) {
                alert("Error");
            });
    }