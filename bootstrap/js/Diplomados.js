//Aun no   actauliza bien la tabla 

/* global posting */

var codigoDiplomado;
var filaEdit;
var codi;

$(document).ready(function(){
    ///////////////BUSQUEDA POR TECLADO ///////////////
//    $('#FindDiplomado').keyup(function(event){
//        var actual=$(this).val();
//        var texto =actual;
//        if(actual===""){
//            var posting = $.post("DiplomadosController/paginDiplomados/", {"data_ini":1});
//        posting.done(function (data) {
//            if (data !== null) {
//                $('#tablaDiplomadosContent').empty();
//                $('#tablaDiplomadosContent').html(data);
//            }
//        });
//        posting.fail(function (data) {
//            alert("Error");
//        });
//        }
//        else{
//        var posting = $.post("DiplomadosController/BuscarDiplomados/",{'FindDiplomado':texto});
//      posting.done(function(data){
//          if(data){
//             $('#tablaDiplomadosContent').html(data);
//          }else{
//          }
//      });
//      posting.fail(function(xhr, textStatus, errorThrown) {
//        alert("error" + xhr.responseText);
//    });}
//    });
    
    $('#btnCleanSearchDip').click(function(e){
        e.preventDefault();
    $('#FindDiplomadoNombre').val('');
    $('#FindDiplomadoCategoria').val('');
    paginGeneralDip();
});
$('.FindDiplomadoClass').keyup(function(event){ //BUSCA PUBLICACION MODIFICAR LA CAJA DE TEXTO 'NOMBRE'
        var nombre =$('#FindDiplomadoNombre').val();
        var categoria = $('#FindDiplomadoCategoria').val();
//        alert("Nombre "+nombre+" Categoria "+categoria)
        if(nombre.length>0 && categoria.length==0){ //FILTRA BUSQUEDA SOLO POR NOMBRE
            buscarParametrosDiplomado('FindByNombre', nombre, categoria);
        }
        if(nombre.length==0 && categoria.length>0 ){ //FILTRA BUSQUEDA SOLO POR CATEGORIA
            buscarParametrosDiplomado('FindByCategoria', nombre, categoria);
        }
        if(nombre.length!=0 && categoria.length!=0){ //FILTRA BUSQUEDA POR NOMBRE Y CATEGORIA
            buscarParametrosDiplomado('FindByNombre+Categoria', nombre, categoria);
        }
        else if(nombre.length==0 && categoria.length==0){
            buscarParametrosDiplomado('Reset', null, null, null)
        }
    });

    //BUSCA DIPLOMADO SEGUN LOS PARAMETROS Y CAMPOS DE TEXTO RELLENADOS
    function buscarParametrosDiplomado(find, nombre, categoria){
        //REALIZA LA BUSQUEDA SEGUN EL TIPO DE FILTRO
        if(find=='Reset'){
            paginGeneralDip();
        }
        else{
            var opcion='';
            switch (find){
                case "FindByNombre":
                opcion={FindDiplomado:nombre};
                break;
            case "FindByCategoria": 
                opcion={Categoria:categoria};
                break;
            case 'FindByNombre+Categoria':
                opcion={FindDiplomado:nombre, Categoria:categoria};
                break;
            }
            var posting = $.post("DiplomadosController/BuscarDiplomados/",opcion);
            posting.done(function(data){
                if(data){
                   $('#tablaDiplomadosContent').html(data);
                }
            });
            posting.fail(function(xhr, textStatus, errorThrown) {
              alert("error" + xhr.responseText);
            });
        }
    }
    
    function paginGeneralDip(){
        var posting = $.post("DiplomadosController/paginDiplomados/", {"data_ini":1});
            posting.done(function (data) {
                if (data !== null) {
                    $('#tablaDiplomadosContent').empty();
                    $('#tablaDiplomadosContent').html(data);
                }
            });
            posting.fail(function (data) {
                alert("Error");
            });
    }

});

//Funcion  para abrir  el modal de  agrgar  diplomado 
$("#BtnADDiplomado").on('click', function () {
    $("#DiplomadoNuevo").modal();
});
//Funcion para  abrir la modal  para editar el diplomado
function  editaDiplomado(fila){
    codigoDiplomado = fila.id;
    filaEdit = fila;
    codigoDiplomado = codigoDiplomado.substring(5);
    var dip = $('#dip' + codigoDiplomado);
    console.log(codigoDiplomado);
    
    var nombre_Diplomado = dip.find('.nombre_Diplomado').html().toString().trim();
    var descripcionDiplomado = dip.find('.descripcionDiplomado').html().toString().trim();
    var estado = dip.find('.estado').html().toString().trim();
    var categoriaDi = dip.find('.categoriaDi').html().toString().trim();
    var comentarioDi = dip.find('.comentarioDi').html().toString().trim();
   // var dataD = dip.data("dipd");
    
    $('#DiplomadoNombreEdit').val(nombre_Diplomado);
    $('#DiplomadoDescripcionEdit').val(descripcionDiplomado);
    $('#estado').prop( "checked", estado);
    $('#CatgoriaDiplomadoEdit').val(categoriaDi);
    $('#ComentarioDiplomadoEdit').val(comentarioDi);
    
    $("#ModificarDiplomado").modal('toggle');
}
//Funcion para  abrir  modla de eliminar Diplomado
function eliminarDiplomado(fila){
   codigoDiplomado = fila.id;
   codigoDiplomado = codigoDiplomado.substring(12);
   var dip = $('#dip' + codigoDiplomado);
    
   var NombreDiplomadoE = dip.find(".nombre_Diplomado").html().toString().trim();
   $('#nombreDipDel').html(NombreDiplomadoE); 
   $('#EliminarDiplomado').modal('toggle'); 
}
//funcion para ver  la info  del modulo del diplomado
function listarModulosByDiplomado(fila){
 codigoDiplomado = fila.id;
 filaEdit = fila;

 codigoDiplomado = codigoDiplomado.substring(7);
    var dip = $('#dip' + codigoDiplomado);
    var NombreDiplomadoView = dip.find(".nombre_Diplomado").html().toString().trim();
         //console.log(NombreDiplomadoView);
    console.log(codigoDiplomado);
    $('#DipViewMod').html(NombreDiplomadoView);  
    $("#ModuloView").modal();
    
    
    var posting = $.post('DiplomadosController/listarModulosByDiplomado/',{codDip:codigoDiplomado});
    posting.done(function(data){
        if(data!=null){
            $('#bdModulosDip').empty(); 
           $('#bdModulosDip').html(data); 
        }else{
         //console.log("El diplomado no contiene modulos");
            $("#NocontainsM").modal('toggle');   
            
        }
               
   });
     posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
     
});
        
    
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//// cargar Datos en las modales para editar /////////////////////////////////////////////////////////////////

//funcion para  ver los modulos agregados al Diplomado 
//$("#ModuloView").on('show.bs.modal',function(event){
//    console.log(codigoDiplomado);
////    var dip = $('#dip' + codigoDiplomado);
////    var NombreDiplomadoView = dip.find(".nombre_Diplomado").html().toString().trim();
////    $('#DipViewMod').html(NombreDiplomadoView);    
//});


$('#ModificarDiplomado').on('click', function (event) {
//    var dip = $('#dip' + codigoDiplomado);
//    console.log(codigoDiplomado);
//    
//    var nombre_Diplomado = dip.find('.nombre_Diplomado').html().toString().trim();
//    var descripcionDiplomado = dip.find('.descripcionDiplomado').html().toString().trim();
//    var estado = dip.find('.estado').html().toString().trim();
//    var categoriaDi = dip.find('.categoriaDi').html().toString().trim();
//    var comentarioDi = dip.find('.comentarioDi').html().toString().trim();
//   // var dataD = dip.data("dipd");
//    
//    $('#DiplomadoNombreEdit').val(nombre_Diplomado);
//    $('#DiplomadoDescripcionEdit').val(descripcionDiplomado);
//    $('#estado').val(estado);
//    $('#CatgoriaDiplomadoEdit').val(categoriaDi);
//    $('#ComentarioDiplomadoEdit').val(comentarioDi);
//    
//    $('#DiplomadoNombreEdit').val(dataD.NombreDiplomado);
//    $('#DiplomadoDescripcionEdit').val(dataD.Descripcion);
//    $('#estado').val(dataD.Estado);
//    $('#CatgoriaDiplomadoEdit').val(dataD.CodigoCategoriaDiplomado);
//    $('#ComentarioDiplomadoEdit').val(dataD.Comentarios);

});
///////cargar inf en la modal  para Eliminar  Diplomados /////////////////////////////////////////////////////////
$("#EliminarDiplomado").on('click',function(event){
//    var dip = $('#dip' + codigoDiplomado);
//    
//    var NombreDiplomadoE = dip.find(".nombre_Diplomado").html().toString().trim();
//    $('#nombreDipDel').html(NombreDiplomadoE);    
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Guardar Diplomado ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#formgrdDiplomado').submit(function (event) {
    event.preventDefault();
    var $form = $(this), DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            Estado = $form.find("input[name='Activo']").prop('checked'),
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
        var posting = $.post(url, {
        DiplomadoNombre: DiplomadoNombre,
        DiplomadoDescripcion: DiplomadoDescripcion,
        Estado: Estado,
        CatgoriaDiplomado: CatgoriaDiplomado,
        ComentarioDiplomado: ComentarioDiplomado
    });
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            
            var fila = '<tr id="dip' + obj.CodigoDiplomado + '">';
            fila = fila + '<td class="nombre_Diplomado">' + obj.NombreDiplomado + '</td>';
            fila = fila + '<td class="descripcionDiplomado">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="estado">' + obj.Estado + '</td>';
            fila = fila + '<td class="categoriaDi">' + obj.CodigoCategoriaDiplomado + '</td>';
            fila = fila + '<td class="comentarioDi">' + obj.Comentarios + '</td>';
            fila = fila + '<td style="text-aling:center"  class="gestion_dip">';
            fila = fila + '<button id="btnmo' + obj.CodigoDiplomado + '" onclick="editaDiplomado(this)" title="Editar Diplomado" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button id="DELDiplomado' + obj.CodigoDiplomado + '" onclick="eliminarDiplomado(this)" title="Eliminar Diplomado" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '<button id="Addmod'+ obj.CodigoDiplomado +'"onclick="AddModDip(this)"  title="Agregar Modulos" class="btnAddMod btn btn-info" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span></button>';
            fila = fila + '<button id="ModViewphp' + obj.CodigoDiplomado + '"onclick="listarModulosByDiplomado(this)"  title="Ver modulos" class="btnVIewMod btn btn-warning" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-eye-open" ></span></button>';   
            
            
            fila = fila + '</td></tr>';
                        
//            $(document).on("click", "#editDiplomado" + obj.CodigoDiplomado.toString(), function () {
//                codigoDiplomado = obj.CodigoDiplomado;
//                $("#ModificarDiplomado").modal('toggle');
//            });
//            
//            $(document).on("click", "#DELDiplomado"+obj.CodigoDiplomado.toString(),function(){
//                codigoDiplomado = obj.CodigoDiplomado;
//                $("EliminarDiplomado").modal('toggle');
//            });
//            
          
            $('#tableDiplomados > tbody').append(fila);
//            var dipDip = $('#tableDiplomados > tbody').find('#dip'+obj.CodigoDiplomado);
//            dipDip.data("dipd", obj);
//            var tdGestionDip = dipDip.find(".gestion_dip");
//            
//            var divgestionDipBtn = $("#gestionDipBtn");
//            if(divgestionDipBtn !== null){
//                var divgestionDipBtnClone = divgestionDipBtn;
//                divgestionDipBtnClone.find(".btnmoddi_").attr("id", "btnmo" + obj.CodigoDiplomado);
//                divgestionDipBtnClone.find(".btndeldip").attr("id","DELDiplomado" + obj.CodigoDiplomado);
//                tdGestionDip.html(divgestionDipBtnClone);
//            }
            $('#DiplomadoNuevo').modal('toggle');
        }else{
            console.log("El Modulos no se ha podido  guardar");
        }
    }); 
   posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});
//Editar  Diplomado//
$("#formeditDiplomado").submit(function (event) {
    event.preventDefault();
    var $form = $(this), 
            DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            CodigoDiplomado = codigoDiplomado,   
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            Estado = $form.find("input[name='Activo']").prop('checked'),
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
            console.log(DiplomadoNombre);
  
    var posting = $.post(url, {
        CodigoDiplomado : CodigoDiplomado,
        DiplomadoNombre: DiplomadoNombre,
        DiplomadoDescripcion: DiplomadoDescripcion,
        Estado: Estado,
        CatgoriaDiplomado: CatgoriaDiplomado,
        ComentarioDiplomado: ComentarioDiplomado
    });
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
         
            var fila ;
            fila = fila + '<td class="nombre_Diplomado">' + obj.NombreDiplomado + '</td>';
            fila = fila + '<td class="descripcionDiplomado">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="estado">' + obj.Estado + '</td>';
            fila = fila + '<td class="categoriaDi">' + obj.CodigoCategoriaDiplomado + '</td>';
            fila = fila + '<td class="comentarioDi">' + obj.Comentarios + '</td>';
            fila = fila + '<td style="text-aling:center"  class="gestion_dip">';
            fila = fila + '<button id="btnmo' + obj.CodigoDiplomado + '" onclick="editaDiplomado(this)" title="Editar Diplomado" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>';
            fila = fila + '<button id="DELDiplomado' + obj.CodigoDiplomado + '" onclick="eliminarDiplomado(this)" title="Eliminar Diplomado" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '<button id="Addmod'+ obj.CodigoDiplomado +'"onclick="AddModDip(this)"  title="Agregar Modulos" class="btnAddMod btn btn-info" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span></button>';
            fila = fila + '<button id="ModViewphp' + obj.CodigoDiplomado + '"onclick="listarModulosByDiplomado(this)"  title="Ver modulos" class="btnVIewMod btn btn-warning" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-eye-open" ></span></button>';   
            fila = fila + '</td></tr>';
//            var dipDip = $('#tableDiplomados > tbody').find("#dip" + obj.CodigoDiplomado);
//            dipDip.find('.nombre_Diplomado').html(obj.NombreDiplomado);
//            dipDip.find('.descripcionDiplomado').html(obj.Descripcion);
//            dipDip.find('.estado').html(obj.Estado);
//            dipDip.find('.categoriaDi').html(obj.CodigoCategoriaDiplomado);
//            dipDip.data("dipd",obj);
//            $("#ModificarDiplomado").modal('toggle'); 
//        $(document).on("click", "#btnmo" + obj.CodigoDiplomado.toString(), function() {
//                codigoDiplomado = obj.CodigoDiplomado;
//                $("#ModificarDiplomado").modal('toggle');
//                 });
//         $(document).on("click", "#DELDiplomado" + obj.CodigoDiplomado.toString(), function() {
//                codigoDiplomado = obj.CodigoDiplomado;
//                $("#EliminarDiplomado").modal('toggle');
//           });     
           $('#tableDiplomados > tbody').find('#dip' + obj.CodigoDiplomado).html(fila);
            $("#ModificarDiplomado").modal('toggle');

        }
    });
             
            
           posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
                
            });
            });
            
 // Eliminar Diplomado//    
$("#frmDELdip").submit(function(event){
    event.preventDefault();
    var $form = $(this),CodigoDiplomado = codigoDiplomado, url = $form.attr("action");;
    var posting = $.post(url,{CodigoDiplomado : CodigoDiplomado });  //Aqui muestra el error -------------------------------------->
    posting.done(function(data){
        if(data){
            var obj = jQuery.parseJSON(data);
            $("#EliminarDiplomado").modal('toggle');
            $('#tableDiplomados').find('#dip'+CodigoDiplomado).fadeOut("slow");
            $('#tableDiplomados').find('#dip'+CodigoDiplomado).remove();
             }
    });
   posting.fail(function(xhr, textStatus, errorThrown) {
      alert("error" + xhr.responseText);
    });
});


// Buscar el DIplomado //
$("#frmfindDip").submit(function(event){
    event.preventDefault();
    var $form = $(this), NombreDiplomado = $form.find("input[name='FindDiplomado']").val(), url = $form.attr("action");
    var posting = $.post(url,{FindDiplomado:NombreDiplomado});
    posting.done(function(data){
        if(data){
//           $('#tableDiplomados').html(data);
            $('#tablaDiplomadosContent').html(data);
        }else{
         $("#DipInd").modal('toggle');   
            
        }
               
   });
     posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
     
});
});


// mostrar los Modulos AGregados al diplomado //////////////////////
//$("#ModDip").submit(function(event){
//     
//    event.preventDefault();
//    var $form = $(this), NombreDiplomado = $form.find("input[name='DipViewMod']").val(), url = $form.attr("action");
//    var posting = $.post(url,{DipViewMod:NombreDiplomado});
//    posting.done(function(data){
//        if(data){
//           $('#tableMoVi').html(data); 
//        }else{
//         $("#NocontainsM").modal('toggle');   
//            
//        }
//               
//   });
//     posting.fail(function(xhr, textStatus, errorThrown) {
//        alert("error" + xhr.responseText);
//     
//});
//});

////////////PAGINACION DE DIPLOMADOS//////////////
    
    $("#tablaDiplomadosContent").on("click", "#aFirstPagDiplomados", function (e) {
        paginarDiplomados("data_ini", $(this).data("datainic"));
    });

    $("#tablaDiplomadosContent").on("click", "#aLastPagDiplomados", function (e) {
        paginarDiplomados("data_ini", $(this).data("datainic"));
    });

    $("#tablaDiplomadosContent").on("click", "#aPrevPagDiplomados", function (e) {
        paginarDiplomados("data_inip", null);
    });

    $("#tablaDiplomadosContent").on("click", "#aNextPagDiplomados", function (e) {
        paginarDiplomados("data_inin", null);
    });
    
    $("#tablaDiplomadosContent").on("keypress", "#txtPagingSearchDiplomados", function (e) {
        e.stopImmediatePropagation();
        if (e.which === 13 && ($(this).val()>0)) {
             paginarDiplomados("data_ini", $(this).val());
        }
    });
    
    function paginarDiplomados(dat, op){

        var data_in = $('#txtPagingSearchDiplomados').data("datainic");     
        var url = 'DiplomadosController/paginDiplomados/';
                
        var opcion="";
        if(dat==="data_inin"){
             opcion={"data_inin":data_in};
        }else if(dat==="data_inip"){
            opcion={"data_inip":data_in};
        }else if(dat==="data_ini"){
            data_in= op;
            opcion={"data_ini":data_in};
        }
        var posting = $.post(url, opcion);
        posting.done(function (data) {
            if (data !== null) {
                $('#tablaDiplomadosContent').empty();
                $('#tablaDiplomadosContent').html(data);
            }
        });
        posting.fail(function (data) {
            alert("Error");
        });
    }
    
    $('#btnActualizarDi').click(function(){
         var posting = $.post("DiplomadosController/paginDiplomados/", {"data_ini":1});
         posting.done(function (data) {
            if (data !== null) {
                $('#tablaDiplomadosContent').empty();
                $('#tablaDiplomadosContent').html(data);
            }
         });
    });