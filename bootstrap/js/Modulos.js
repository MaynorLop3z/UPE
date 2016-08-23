var codigoModulo;
var codigoDiplomado;
var  filaEdit;




//function AddMod(){
//  $("#NuevoModuloDip").modal('toggle');
//}




function editModulo(fila) {
    codigoModulo = fila.id;
    filaEdit = fila;
     //codigoModulo = codigoModulo.substring(8);
     $("#ModificarModulo").modal('toggle');
}

function delMo(fila) {
    codigoModulo = fila.id;
   // codigoModulo = codigoModulo.substring(7);
    $("#EliminarModulo").modal('toggle');

}


function AddModDip(idDip){
 $("#modDiplomadohidde").val(idDip);   
    $("#NuevoModuloDip").modal('toggle');
}

// modificar  Modulo ----------->
$('#ModificarModulo').on('show.bs.modal', function (event) {   
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
$('#EstadoE').val(Estado);
$('#TurnoEdit').val(TurnoM);
$('#DiplomadonameEdit').val(DipName);
$('#ComentarioModEdit').val(ComenMo);


    
//    $('#ModuloNombreEdit').val(dataM.NombreModulo);
//    $('#ModuloOrdenEdit').val(dataM.OrdenModulo);
//    $('#EstadoE').val(dataM.Estado);
//    $('#TurnoEdit').val(dataM.CodigoTurnos);
//    $('#DiplomadonameEdit').val(dataM.CodigoDiplomados);
//    $('#ComentarioModEdit').val(dataM.Comentarios);
});

$("#EliminarModulo").on('show.bs.modal',function(event){
    
     var mod = $('#mod'+ codigoModulo.substring(7));
     var Nombre_Mod = mod.find('.NombreMod').html().toString().trim();
     console.log(Nombre_Mod);
       $('#nombreModuloDel').html(Nombre_Mod);
});
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
              $('#tableModulos').html(data);
              
          }else{
             $("#ModInd").modal('toggle');
          }
      });
      posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
     
 });