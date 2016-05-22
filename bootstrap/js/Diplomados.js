//Aun no   actauliza bien la tabla 

/* global posting */

var codigoDiplomado;
var filaEdit;
$("#BtnADDiplomado").on('click', function () {
    $("#DiplomadoNuevo").modal();
});

//$('.btnmoddi').on('click', function (event) {
//codigoDiplomado = this.id;
//codigoDiplomado = codigoDiplomado.substring(5); /// esto agregue recientemente 
//$("#ModificarDiplomado").modal('show');
//});

function AddMod(fila){
  $("#DiplomadoNuevo").modal();
}

function AddModDip(fila){
  $("#NuevoModuloDip").modal();
}

function  editaDiplomado(fila){
    codigoDiplomado = fila.id;
    filaEdit = fila;
 codigoDiplomado = codigoDiplomado.substring(5);
    $("#ModificarDiplomado").modal('toggle');
}

function eliminarDiplomado(fila){
 codigoDiplomado = fila.id;
 codigoDiplomado = codigoDiplomado.substring(12);
   $('#EliminarDiplomado').modal('toggle');
   
}
//$('.btndeldip').on('click', function(event){
//    codigoDiplomado = this.id;
//    codigoDiplomado = codigoDiplomado.substring(12);
//    $('#EliminarDiplomado').modal('show');  
//});
// ESpacio solo por salud del git

$('#ModificarDiplomado').on('show.bs.modal', function (event) {
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
    $('#estado').val(estado);
    $('#CatgoriaDiplomadoEdit').val(categoriaDi);
    $('#ComentarioDiplomadoEdit').val(comentarioDi);
    
//    $('#DiplomadoNombreEdit').val(dataD.NombreDiplomado);
//    $('#DiplomadoDescripcionEdit').val(dataD.Descripcion);
//    $('#estado').val(dataD.Estado);
//    $('#CatgoriaDiplomadoEdit').val(dataD.CodigoCategoriaDiplomado);
//    $('#ComentarioDiplomadoEdit').val(dataD.Comentarios);

});

 
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
        }
    }); 
   posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});

$("#EliminarDiplomado").on('show.bs.modal',function(event){
    var dip = $('#dip' + codigoDiplomado);
    var NombreDiplomadoE = dip.find(".nombre_Diplomado").html().toString().trim();
    $('#nombreDipDel').html(NombreDiplomadoE);    
});


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
  //prueba para ver si imprime el codigo correcto    
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

$("#frmfindDip").submit(function(event){
    event.preventDefault();
    var $form = $(this), NombreDiplomado = $form.find("input[name='FindDiplomado']").val(), url = $form.attr("action");
    var posting = $.post(url,{FindDiplomado:NombreDiplomado});
    posting.done(function(data){
        if(data){
           $('#tableDiplomados').html(data); 
        }else{
         $("#DipInd").modal('toggle');   
            
        }
               
   });
     posting.fail(function(xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
     
});
});