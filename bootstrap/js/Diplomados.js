//Aun no   actauliza bien la tabla 

/* global posting */

var codigoDiplomado;

$("#BtnADDiplomado").on('click', function () {
    $("#DiplomadoNuevo").modal();
});

$('.btnmoddi').on('click', function (event) {
codigoDiplomado = this.id;
codigoDiplomado = codigoDiplomado.substring(5); /// esto agregue recientemente 
$("#ModificarDiplomado").modal('show');
});


$('.btndeldip').on('click', function(event){
    codigoDiplomado = this.id;
    codigoDiplomado = codigoDiplomado.substring(12);
    $('#EliminarDiplomado').modal('show');  
});
// ESpacio solo por salud del git

$('#ModificarDiplomado').on('show.bs.modal', function (event) {
    var dip = $('#dip' + codigoDiplomado);
    var dataD = dip.data("dipd");
    $('#DiplomadoNombreEdit').val(dataD.NombreDiplomado);
    $('#DiplomadoDescripcionEdit').val(dataD.Descripcion);
    $('#estado').val(dataD.Estado);
    $('#CatgoriaDiplomadoEdit').val(dataD.CodigoCategoriaDiplomado);
    $('#ComentarioDiplomadoEdit').val(dataD.Comentarios);
});


$('#formgrdDiplomado').submit(function (event) {
    event.preventDefault();
    var $form = $(this), DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            radio = $form.find("input[name='estado']:checked").val(),
            // probar  con el checked
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
        var posting = $.post(url, {
        DiplomadoNombre: DiplomadoNombre,
        DiplomadoDescripcion: DiplomadoDescripcion,
        radio: radio,
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
//            fila = fila + '<button id="editDiplomado' + obj.CodigoDiplomado + '" title="Editar Diplomado" class="btn btn-success btnmoddi"><span class=" glyphicon glyphicon-pencil"></span></butto n>';
//            fila = fila + '<button data-toggle="modal" title="Eliminar Diplomado" class="btn btn-danger" href="#eliminarDiplomado"><span class="glyphicon glyphicon-trash"></span></button>';
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
            var dipDip = $('#tableDiplomados > tbody').find('#dip'+obj.CodigoDiplomado);
            dipDip.data("dipd", obj);
            var tdGestionDip = dipDip.find(".gestion_dip");
            
            var divgestionDipBtn = $("#gestionDipBtn");
            if(divgestionDipBtn !== null){
                var divgestionDipBtnClone = divgestionDipBtn.clone(true);
                divgestionDipBtnClone.find(".btnmoddi_").attr("id", "btnmo" + obj.CodigoDiplomado);
                divgestionDipBtnClone.find(".btndeldip").attr("id","DELDiplomado" + obj.CodigoDiplomado);
                tdGestionDip.html(divgestionDipBtnClone);
            }
            $('#DiplomadoNuevo').modal('toggle');
        }
    }); 
    posting.fail(function (data) {
        var obj = jQuery.parseJson(data);
        alert(obj.Error);
    });
});

$("EliminarDiplomado").on('show.bs.modal',function(event){
    
    var dip = $('#dip' + codigoDiplomado);
    var noDip = dip.data('dipd');
    $('#markeliminar').html(noDip.nombreDiplomado);    
});


$("#formeditDiplomado").submit(function (event) {
    event.preventDefault();
    var $form = $(this), 
            DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            CodigoDiplomado = codigoDiplomado, 
            
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            radio = $form.find("input[name='estado']:checked").val(),
            // probar  con el checked
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
            console.log(codigoDiplomado);
  //prueba para ver si imprime el codigo correcto    
    var posting = $.post(url, {
        CodigoDiplomado : CodigoDiplomado,
        DiplomadoNombre: DiplomadoNombre,
        DiplomadoDescripcion: DiplomadoDescripcion,
        radio: radio,
        CatgoriaDiplomado: CatgoriaDiplomado,
        ComentarioDiplomado: ComentarioDiplomado
    });
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var dipDip = $('#tableDiplomados > tbody').find("#dip" + obj.CodigoDiplomado);
            dipDip.find('.nombre_Diplomado').html(obj.NombreDiplomado);
            dipDip.find('.descripcionDiplomado').html(obj.Descripcion);
            dipDip.find('.estado').html(obj.Estado);
            dipDip.find('.categoriaDi').html(obj.CodigoCategoriaDiplomado);
            dipDip.data("dipd",obj);
            $("#ModificarDiplomado").modal('toggle'); 
        }
    });
            
            
           posting.fail(function(data){
                var obj = jQuery.parseJSON(data);
                alert(obj.Error);
                
            });
            });
            
            
$("#frmDELdip").submit(function(event){
    event.preventDefault();
    var $form = $(this),CodigoDiplomado = codigoDiplomado, url = $form.attr("action");;
    var posting = $.post(url,{CodigoDiplomado : CodigoDiplomado });  //Aqui muestra el error -------------------------------------->
    posting.done(function(data){
        if(data){
            $("#EliminarDiplomado").modal('toggle');
            $('#tableDiplomados').find('#dip'+CodigoDiplomado).fadeOut("slow");
            $('#tableDiplomados').find('#dip'+CodigoDiplomado).remove();
             }
    });
    posting.fail(function(){
        alert("error");
        
    });
});
