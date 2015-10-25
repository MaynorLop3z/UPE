//Aun no   actauliza bien la tabla 

/* global posting */

var codigoDiplomado;

$("#BtnADDiplomado").on('click', function () {
    $("#DiplomadoNuevo").modal();
});

$('.btnmoddi').on('click', function (event) {
 CodigoDiplomado = event.target.id;
//    console.log('editar  el participante'+ CodigoDiplomado); //Verificar cuales id toma 
    $("#ModificarDiplomado").modal('toggle');
});

$('.btndelDi').on('click', function (event) {
    $("#EliminarDiplomado").modal('toggle');
});



$('#ModificarDiplomado').on('show.bs.modal', function (event) {
    
    var dip = $('#dip' + CodigoDiplomado.substring(13));
    var nombre_Diplomado = dip.find('.nombre_Diplomado').html().toString().trim();
    var descripcionDiplomado = dip.find('.descripcionDiplomado').html().toString().trim();
    var estado = dip.find('.estado').html().toString().trim();
    var categoriaDi = dip.find('.categoriaDi').html().toString().trim();
    var comentarioDi = dip.find('.comentarioDi').html().toString().trim();
     
        
    $('#DiplomadoNombreEdit').val(nombre_Diplomado);
    console.log(nombre_Diplomado);
    
    $('#DiplomadoDescripcionEdit').val(descripcionDiplomado);
    $('.estado').val(estado);
    $('#CatgoriaDiplomadoEdit').val(categoriaDi);
    $('#ComentarioDiplomadoEdit').val(comentarioDi);
});

//$("EliminarDiplomado").on('show.bs.modal',function(event){
//    var dip = $('#dip' + codigoDiplomado.substring(13));
//    var nombre_Diplomado = dip.find('.nombre_Diplomado').html().toString().trim();
//    $('#SelectDiEliminar').html(nombre_Diplomado);    
//});


$('#formgrdDiplomado').submit(function (event) {
    event.preventDefault();
    var $form = $(this), DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            radio = $form.find("input[name='estado']:checked").val(),
            // probar  con el checked
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
    console.log(radio.toString());
    var posting = $.post(url, {
        DiplomadoNombre: DiplomadoNombre,
        DiplomadoDescripcion: DiplomadoDescripcion,
        radio: radio.toString(),
        CatgoriaDiplomado: CatgoriaDiplomado,
        ComentarioDiplomado: ComentarioDiplomado
    });
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila;
//            if(obj.NombreDiplomado!=null){
//                console.log("No soy nulo");
//            }else{ console.log("soy nulo");}
            fila = '<tr id="dip' + obj.CodigoDiplomado + '">';
            fila = fila + '<td class="nombre_Diplomado">' + obj.NombreDiplomado + '</td>';
            fila = fila + '<td class="descripcionDiplomado">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="estado">' + obj.Estado + '</td>';
            fila = fila + '<td class="categoriaDi">' + obj.CodigoCategoriaDiplomado + '</td>';
            fila = fila + '<td class="comentarioDi">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_dip">';
            fila = fila + '<button id="editDiplomado' + obj.CodigoDiplomado + '" title="Editar Diplomado" class="btn btn-success btnmoddi"><span class=" glyphicon glyphicon-pencil"></span></butto n>';
            fila = fila + '<button data-toggle="modal" title="Eliminar Alumno" class="btn btn-danger" href="#AlumnoEliminar"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td></tr>';
            $(document).on("click", "#editDiplomado" + obj.CodigoDiplomado.toString(), function () {
                codigoDiplomado = obj.CodigoDiplomado;
                $("#ModificarDiplomado").modal('toggle');
            });

          
            $('#tableDiplomados > tbody').append(fila);
            $('#DiplomadoNuevo').modal('toggle');
        }// console.log('data vacio');
    });

    posting.fail(function () {
        alert("error");
    });
});

$("#formeditDiplomado").submit(function (event) {
    event.preventDefault();
    var $form = $(this), CodigoDiplomado = codigoDiplomado.substring(13), 
            DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            radio = $form.find("input[name='estado']:checked").val(),
            // probar  con el checked
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
    
    var posting = $.post(url,{DiplomadoNombre: DiplomadoNombre,
        DiplomadoDescripcion: DiplomadoDescripcion,
        radio: radio.toString(),
        CatgoriaDiplomado: CatgoriaDiplomado,
        ComentarioDiplomado: ComentarioDiplomado
    });
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila;
            
            fila = fila + '<td class="nombre_Diplomado">' + obj.NombreDiplomado + '</td>';
            fila = fila + '<td class="descripcionDiplomado">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="estado">' + obj.Estado + '</td>';
            fila = fila + '<td class="categoriaDi">' + obj.CodigoCategoriaDiplomado + '</td>';
            fila = fila + '<td class="comentarioDi">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_dip">';
            fila = fila + '<button id="editDiplomado' + obj.CodigoDiplomado + '" title="Editar Diplomado" class="btn btn-success btnmoddi"><span class=" glyphicon glyphicon-pencil"></span></butto n>';
            fila = fila + '<button data-toggle="modal" title="Eliminar Alumno" class="btn btn-danger" href="#EliminarDiplomado"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td></tr>';          
                        
            $('#tableDiplomados > tbody').find('#dip' + obj.CodigoDiplomado).html(fila);
            $('#ModificarDiplomado').modal('toggle');
        }
    });
    
    posting.fail(function(){
        alert("error");
        
    });
});
$("#EliminarDiplomado").submit(function(event){
    event.preventDefault();
    var $form = $(this),CodigoDiplomado = codigoDiplomado.substring(13), url = $form.attr("action");;
    var posting = $.post(url,{CodigoDiplomado : CodigoDiplomado });
    posting.done(function(data){
        if(data){
            
            $('#tableDiplomados').remove('#dip'+CodigoDiplomado);
            $("#EliminarDiplomado").modal('toggle');
            
        }
        
    });
    posting.fail(function(){
        alert("error");
        
    });
});