var codigoModulo;
var codigoDiplomado;
var  filaEdit;

//function AddMod(){
//  $("#NuevoModuloDip").modal('toggle');
//}

$(document).ready(function(){
//    $('#FindModulo').keyup(function(event){
//        var actual=$(this).val();
//        var texto =actual;
////        alert(escape(texto));
//        if(actual===""){
//            var posting = $.post("ModulosController/paginModulos/", {"data_ini":1});
//        posting.done(function (data) {
//            if (data !== null) {
//                $('#tablaModulosContent').empty();
//                $('#tablaModulosContent').html(data);
//            }
//        });
//        posting.fail(function (data) {
//            alert("Error");
//        });
//        }
//        else{
//        var posting = $.post("ModulosController/BuscarModulos/",{'FindModulo':texto});
//      posting.done(function(data){
//          if(data){
////              $('#tableModulos').html(data);
//             $('#tablaModulosContent').html(data);
//          }else{
//             $("#ModInd").modal('toggle');
//          }
//      });
//      posting.fail(function(xhr, textStatus, errorThrown) {
//        alert("error" + xhr.responseText);
//    });}
//    });
/////////////NUEVA BUSQUEDA/////////////////
$('#btnCleanSearchModulo').click(function(){
     $('#FindModuloNombre').val('');
     $('#FindModuloTurno').val('');
     $('#FindModuloDiplomado').val('');
     paginModulo();
});

$('.FindModuloClass').keyup(function(event){ //BUSCA MODULO AL EDITAR 
        var nombre =$('#FindModuloNombre').val();
        var turno = $('#FindModuloTurno').val();
        var diplomado = $('#FindModuloDiplomado').val();
        if(nombre.length>0 && turno.length==0 && diplomado.length==0){ //FILTRA BUSQUEDA SOLO POR NOMBRE
            buscarParametrosModulo('FindByNombre', nombre, turno, diplomado);
        }
        if(nombre.length==0 && turno.length>0 && diplomado.length==0){ //FILTRA BUSQUEDA SOLO POR CORREO
            buscarParametrosModulo('FindByTurno', nombre, turno, diplomado);
        }
        if(nombre.length==0 && turno.length==0 && diplomado.length>0){ //FILTRA BUSQUEDA SOLO POR CATEGORIA
            buscarParametrosModulo('FindByDiplomado', nombre, turno, diplomado);
        }
        else if (nombre.length>0 && turno.length>0 && diplomado.length==0){ //FILTRA BUSQUEDA POR NOMBRE Y CORREO
            buscarParametrosModulo('FindByNombre+Turno', nombre, turno, diplomado);
        }
        else if (nombre.length>0 && turno.length==0 && diplomado.length>0){ //FILTRA BUSQUEDA POR NOMBRE Y CATEGORIA
            buscarParametrosModulo('FindByNombre+Diplomado', nombre, turno, diplomado);
        }
        else if (nombre.length==0 && turno.length>0 && diplomado.length>0){ //FILTRA BUSQUEDA POR CORREO Y CATEGORIA
            buscarParametrosModulo('FindByTurno+Diplomado', nombre, turno, diplomado);
        }
        else if (nombre.length>0 && turno.length>0 && diplomado.length>0){ //FILTRA BUSQUEDA POR NOMBRE, CORREO Y CATEGORIA
            buscarParametrosModulo('FindByNombre+Turno+Diplomado', nombre, turno, diplomado);
        }
        else if(nombre.length==0 && turno.length==0 && diplomado.length==0){
            buscarParametrosModulo('Reset', null, null, null)
        }
    });

    //BUSCA MODULO SEGUN LOS PARAMETROS Y CAMPOS DE TEXTO RELLENADOS
    function buscarParametrosModulo(find, nombre, turno, diplomado){
        //REALIZA LA BUSQUEDA SEGUN EL TIPO DE FILTRO
        if(find=='Reset'){
           
            paginModulo();
        }
        else{
            var opcion='';
            switch (find){
                case "FindByNombre":
                opcion={FindModulo:nombre};
                break;
            case "FindByTurno": 
                opcion={Turno:turno};
                break;
            case "FindByDiplomado":
                opcion={Diplomado:diplomado};
                break;
            case "FindByNombre+Turno":
                opcion={FindModulo:nombre, Turno:turno};
                break;
            case 'FindByNombre+Diplomado':
                opcion={FindModulo:nombre, Diplomado:diplomado};
                break;
            case 'FindByTurno+Diplomado':
                opcion={Turno:turno, Diplomado:diplomado};
                break;
            case "FindByNombre+Turno+Diplomado":
                opcion={FindModulo:nombre, Turno:turno, Diplomado:diplomado};
                break;
            }
            var posting = $.post("ModulosController/BuscarModulos/",opcion);
            posting.done(function(data){
                if(data){
                   $('#tablaModulosContent').html(data);
                }
            });
             posting.fail(function (data) {
            //alert("El modulo no esta  Definido ");
            });
        }
    }
    
    function paginModulo(){
        var posting = $.post("ModulosController/paginModulos/", {"data_ini":1});
            posting.done(function (data) {
                if (data !== null) {
                    $('#tablaModulosContent').empty();
                    $('#tablaModulosContent').html(data);
                }
            });
            posting.fail(function (data) {
                alert("Error");
            });
    }
});

function editModulo(fila) {
    codigoModulo = fila.id;
    filaEdit = fila;
     var mod = $('#mod'+ codigoModulo.substring(8));
   // codigoModulo = codigoModulo.substring(8);
   // var Mod = $('#Mod' + codigoModulo);
    //    var dataM = Mod.data("ModM");
    //    alert(Mod.ModuloNombre);
    //    
    var NombreMod = mod.find('.NombreMod').html().toString().trim();
    var ordenMo = mod.find('.ordenMo').html().toString().trim();
    var Estado = mod.find('.Estado').html().toString().trim();
    var TurnoM = mod.find('.TurnoM').html().toString().trim();
    var DipName = mod.find('.DipName').html().toString().trim();
    var ComenMo = mod.find('.ComenMo').html().toString().trim();
    
    $('#ModuloNombreEdit').val(NombreMod);
    $('#ModuloOrdenEdit').val(ordenMo);
    if(Estado==='t'){
        $('#EstadoE').prop( "checked", true );
    }else{
        $('#EstadoE').prop( "checked", false);
    }
    $('#TurnoEdit').val(TurnoM);
    $('#DiplomadonameEdit').val(DipName);
    $('#ComentarioModEdit').val(ComenMo);
     //codigoModulo = codigoModulo.substring(8);
     $("#ModificarModulo").modal('toggle');
}

function delMo(fila) {
    codigoModulo = fila.id;
    var mod = $('#mod'+ codigoModulo.substring(7));
    var Nombre_Mod = mod.find('.NombreMod').html().toString().trim();
    console.log(Nombre_Mod);
    $('#nombreModuloDel').html(Nombre_Mod);
   // codigoModulo = codigoModulo.substring(7);
    $("#EliminarModulo").modal('toggle');

}

function AddModDip(idDip){
 console.log(idDip);
   
 $('#prueba').html(idDip);   
    $("#NuevoModuloDip").modal('toggle');
}

// modificar  Modulo ----------->
//$('#ModificarModulo').on('show.bs.modal', function (event) {   
//    var mod = $('#mod'+ codigoModulo.substring(8));
//   // codigoModulo = codigoModulo.substring(8);
//   // var Mod = $('#Mod' + codigoModulo);
////    var dataM = Mod.data("ModM");
////    alert(Mod.ModuloNombre);
////    
//var NombreMod = mod.find('.NombreMod').html().toString().trim();
//var ordenMo = mod.find('.ordenMo').html().toString().trim();
//var Estado = mod.find('.Estado').html().toString().trim();
//var TurnoM = mod.find('.TurnoM').html().toString().trim();
//var DipName = mod.find('.DipName').html().toString().trim();
//var ComenMo = mod.find('.ComenMo').html().toString().trim();
//
//
//
//$('#ModuloNombreEdit').val(NombreMod);
//$('#ModuloOrdenEdit').val(ordenMo);
//$('#EstadoE').val(Estado);
//$('#TurnoEdit').val(TurnoM);
//$('#DiplomadonameEdit').val(DipName);
//$('#ComentarioModEdit').val(ComenMo);
//
//
//    
////    $('#ModuloNombreEdit').val(dataM.NombreModulo);
////    $('#ModuloOrdenEdit').val(dataM.OrdenModulo);
////    $('#EstadoE').val(dataM.Estado);
////    $('#TurnoEdit').val(dataM.CodigoTurnos);
////    $('#DiplomadonameEdit').val(dataM.CodigoDiplomados);
////    $('#ComentarioModEdit').val(dataM.Comentarios);
//});

//$("#EliminarModulo").on('show.bs.modal',function(event){
//    
//     var mod = $('#mod'+ codigoModulo.substring(7));
//     var Nombre_Mod = mod.find('.NombreMod').html().toString().trim();
//     console.log(Nombre_Mod);
//       $('#nombreModuloDel').html(Nombre_Mod);
//});
///// Funcion donde  se ingresa el modulo desde la pestaña de diplomados //
$("#formgrdMo").submit(function (event) {
   
    event.preventDefault();
    
    var $form = $(this), ModuloNombre = $form.find("input[name='NombreModulo']").val(),
            ModuloOrden = $form.find("input[name='ordenM']").val(),
            Estado = $form.find("input[name='Activo']").prop('checked'),
            Turno = $form.find("select[name='Turno']").val(),
            CodDiplomado = $form.find("input[name='CodigoDiplomado']").val(),
            ComentarioMod = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
            //console.log(Estado);
    //alert(CodDiplomado);
    var posting = $.post(url, {
        ModuloNombre: ModuloNombre,
        ModuloOrden: ModuloOrden,
        Estado: Estado,
        Turno: Turno,
        CodDiplomado: CodDiplomado,
        ComentarioMod: ComentarioMod
    });
    if (posting === null) {
        console.log("es nulo");
    }
    posting.done(function (data) {

        if (data !== null) {
            var obj = jQuery.parseJSON(data);

            var fila = '<tr id="$Mod' + obj.CodigoModulo + '">';
            fila = fila + '<td class="NombreMod" >' + obj.NombreModulo + '</td>';
            fila = fila + '<td class="ordenMo" >' + obj.OrdenModulo + '</td>';
            fila = fila + '<td class="Estado" >' + obj.Estado + '</td>';
            fila = fila + '<td class="TurnoM" >' + obj.CodigoTurno + '</td>';
            fila = fila + '<td class="DipName" >' + obj.CodigoDiplomado + '</td>';
            fila = fila + '<td class="ComenMo" >' + obj.Comentarios + '</td>';
            fila = fila + '<td style="text-align:center"  class="gestion_Mod">';
            fila = fila + '<button id="btnModiM' + obj.CodigoModulo + '" onclick="editModulo(this)" title="Editar Modulo" class="btn_modificar_Mod btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button>';
            fila = fila + '<button id="btnDELM' + obj.CodigoModulo + '"onclick="delMo(this)" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td></tr>';
            $('#tableModulos >tbody').append(fila);
//            var ModMod = $('#tableModulos > tbody').find("#Mod" + obj.CodigoModulo);
//            ModMod.data("Modd".obj);
//            var tdGestionModulos = ModMod.find(".gestion_Mod");
//
//            var divgestionModBtn = $("#gestion_Mod");
//            if (divgestionModBtn !== null) {
//                alert('prueba');
//                var divgestionModBtnClone = divgestionModBtn;
//                divgestionModBtnClone.find(".btn_modificar_Mod").attr("id", "btnModiM" + obj.CodigoModulo);
//                divgestionModBtnClone.find(".btn_eliminar_Mod").attr("id", "btnDELM" + obj.CodigoModulo);
//                tdGestionModulos.html(divgestionModBtnClone);
//
           
          $('#NuevoModulo').modal('toggle');
          alert("Diplomado ok");
       
        }
        
    });
    
    posting.fail(function(xhr, textStatus, errorThrown) {
      alert("error" + xhr.responseText);
//    posting.fail(function () {
//        alert("error");
    });
});



// modificar  Modulo ----------->
$("#formEditMod").submit(function (event) {
    event.preventDefault();

    var $form = $(this),
    CodigoModulo = codigoModulo.substring(8),
    ModuloNombre = $form.find("input[name='NombreModulo']").val(),
            ModuloOrden = $form.find("input[name='ordenM']").val(),
            Estado = $form.find("input[name='Activo']").prop('checked'), // para ver si el checked  es la falla
            Turno = $form.find("select[name='Turno']").val(),
            CodDiplomado = $form.find("select[name='Diplomadoname']").val(),
            ComentarioMod = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");

            console.log(CodDiplomado);
     var posting = $.post(url, {
         CodigoModulo:CodigoModulo,
        ModuloNombre: ModuloNombre,
        ModuloOrden: ModuloOrden,
        Estado: Estado,
        Turno: Turno,
        CodDiplomado: CodDiplomado,
        ComentarioMod: ComentarioMod

    });

    posting.done(function (data) {

        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila;
            fila = fila + '<td class=NombreMod>' + obj.NombreModulo + '</td>';
            fila = fila + '<td class=ordenMo>' + obj.OrdenModulo + '</td>';
            fila = fila + '<td class=Estado>' + obj.Estado + '</td>';
            fila = fila + '<td class=TurnoM>' + obj.CodigoTurno + '</td>';
            fila = fila + '<td class=DipName>' + obj.CodigoDiplomado + '</td>';
            fila = fila + '<td class=ComenMo>' + obj.Comentarios + '</td>';
            fila = fila + '<td class=gestion_Mod>';
            fila = fila + '<button id="btnModiM' + obj.CodigoModulo + '" onclick="editModulo(this)" title="Editar Modulo" class="btn_modificar_Mod btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button>';
            fila = fila + '<button id="btnDELM' + obj.CodigoModulo + '" onclick="delMo(this)" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td>';


//            $(document).on("click", "#btnModiM" + obj.CodigoModulo.toString(), function () {
//                codigoModulo = obj.CodigoModulo;
//                $("#ModificarModulo").modal('toggle');
//            });
//            $(document).on("click", "#btnDELM" + obj.CodigoModulo.toString(), function () {
//                codigoModulo = obj.CodigoModulo;
//                $("#EliminarModulo").modal('toggle');
//            });
            $('#tableModulos > tbody').find('#mod' + obj.CodigoModulo).html(fila);
            $("#ModificarModulo").modal('toggle');
        }


        });
        posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
                });
                
                
    });           
                
                
                

$("#frmDelMod").submit(function(event) {
    event.preventDefault();
    
    var $form = $(this), CodigoModulo = codigoModulo.substring(7), url = $form.attr("action");
    var posting = $.post(url, {CodigoModulo: CodigoModulo});
    posting.done(function(data) {
        if (data) {
            var obj = jQuery.parseJSON(data);
            $("#EliminarModulo").modal('toggle');
            $("#tableModulos").find('#mod' + CodigoModulo).fadeOut("slow");
            $("#tableModulos").find('#mod' + CodigoModulo).remove();
        }
    });
    
     posting.fail(function(xhr, textStatus, errorThrown) {
      alert("error" + xhr.responseText);
    });
 });
 
 
 $("#frmfindMod").submit(function(event){
     event.preventDefault();
     var $form = $(this), NombreModulo = $form.find("input[name='FindModulo']").val(), url = $form.attr("action");
      var posting = $.post(url,{FindModulo:NombreModulo});
      posting.done(function(data){
          if(data){
//              $('#tableModulos').html(data);
             $('#tablaModulosContent').html(data);
          }else{
             $("#ModInd").modal('toggle');
          }
      });
      posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
     
 });
 
 ////////////PAGINACION DE MODULOS//////////////
    
    $("#tablaModulosContent").on("click", "#aFirstPagModulos", function (e) {
        paginarModulos("data_ini", $(this).data("datainic"));
    });

    $("#tablaModulosContent").on("click", "#aLastPagModulos", function (e) {
        paginarModulos("data_ini", $(this).data("datainic"));
    });

    $("#tablaModulosContent").on("click", "#aPrevPagModulos", function (e) {
        paginarModulos("data_inip", null);
    });

    $("#tablaModulosContent").on("click", "#aNextPagModulos", function (e) {
        paginarModulos("data_inin", null);
    });
    
    $("#tablaModulosContent").on("keypress", "#txtPagingSearchModulos", function (e) {
        e.stopImmediatePropagation();
        if (e.which === 13 && ($(this).val()>0)) {
             paginarModulos("data_ini", $(this).val());
        }
    });
    
    function paginarModulos(dat, op){

        var data_in = $('#txtPagingSearchModulos').data("datainic");     
        var url = 'ModulosController/paginModulos/';
                
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
                $('#tablaModulosContent').empty();
                $('#tablaModulosContent').html(data);
            }
        });
        posting.fail(function (data) {
            alert("Error");
        });
    }