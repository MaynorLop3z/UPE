//Aun no   actauliza bien la tabla 

/* global posting */

var codigoDiplomado;

$("#BtnADDiplomado").on('click', function () {
    $("#DiplomadoNuevo").modal();
});

$('.btnmoddi').on('click', function (event) {
//codigoDiplomado = event.target.id;
codigoDiplomado = this.id;

codigoDiplomado = codigoDiplomado.substring(13);
if(codigoDiplomado !==null){
    console.log(codigoDiplomado);
}
$("#ModificarDiplomado").modal('toggle');
});

//Botn Eliminar le diplomado


$('#ModificarDiplomado').on('show.bs.modal', function (event) {
  //     codigoDiplomado =(event.target.id);
    console.log("codigo al abrir modal "+codigoDiplomado);
   
    var dip = $('#dip' + codigoDiplomado);    
    var dataDip = dip.data("dipd");
    
    
    
    if(dataDip !== null){
        console.log(dataDip.NombreDiplomado.toString().trim());
       
}
        //console.log(dip);
        
    var Nombre_Diplomado = dip.find('.nombre_Diplomado').html().toString().trim(); 
    var DescripcionDiplomado = dip.find('.descripcionDiplomado').html().toString().trim();
    var Estado = dip.find('.estado').html().toString().trim();
    var CategoriaDi = dip.find('.categoriaDi').html().toString().trim();
    var ComentarioDi = dip.find('.comentarioDi').html().toString().trim();
    var dataDipl = dip.data("dipd");
    if(dataDipl !== null){}
    console.log(ComentarioDi);
     
//     if(ComentarioDi !== null){
//         console.log(String(ComentarioDi));
//     }else{ console.log("El campo esta vacio"); 
//         }
    
    $('#DiplomadoNombreEdit').val(Nombre_Diplomado);
    $('#DiplomadoDescripcionEdit').val(DescripcionDiplomado);
    $('#estado').val(Estado);
    $('#CatgoriaDiplomadoEdit').val(CategoriaDi);
    $('#ComentarioDiplomadoEdit').val(ComentarioDi);
   
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
     var $form = $(this),
     //CodigoDiplomado = codigoDiplomado.substring(13), 
            DiplomadoNombre  = $form.find("input[name='NombreDiplomado']").val(),
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            radio = $form.find("input[name='estado']:checked").val(),
            // probar  con el checked
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
    
    var posting = $.post(url,{
        //CodigoDiplomado: CodigoDiplomado, 
        DiplomadoNombre: DiplomadoNombre,
        DiplomadoDescripcion: DiplomadoDescripcion,
        radio: radio,
        CatgoriaDiplomado: CatgoriaDiplomado,
        ComentarioDiplomado: ComentarioDiplomado });
   
    posting.done(function(data){
        if (data !== null) {
             var obj = jQuery.parseJSON(data);
            
            console.log(obj);
            var fila;
            
            fila = fila + '<td class="nombre_Diplomado">' + obj.NombreDiplomado + '</td>';
            fila = fila + '<td class="descripcionDiplomado">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="estado">' + obj.Estado + '</td>';
            fila = fila + '<td class="categoriaDi">' + obj.CodigoCategoriaDiplomado + '</td>';
            fila = fila + '<td class="comentarioDi">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_dip">';
            fila = fila + '<button id="editDiplomado' + obj.CodigoDiplomado + '" title="Editar Diplomado" class="btn btn-success btnmoddi"><span class=" glyphicon glyphicon-pencil"></span></butto n>';
            fila = fila + '<button data-toggle="modal" title="Eliminar Alumno" class="btn btn-danger" href="#EliminarDiplomado"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td>';          
            $(document).on("click", "#editDiplomado" + obj.CodigoDiplomado.toString(),function(){
                    codigoDiplomado= obj.CodigoDiplomado;
                    $("#ModificarDiplomado").modal('toggle');
                });        
            $('#tableDiplomados > tbody').find('#dip' + obj.CodigoDiplomado).html(fila);
            $('#ModificarDiplomado').modal('toggle');
        }   

    });
    
    posting.fail(function(data){
        var obj = jQuery.parseJSON(data);
          alert(obj.Error);
        
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
$('.btndeldip').on('click', function(event) {
   CodigoDiplomado = event.target.id;
   console.log("El DIplomado a eliminar es:" + CodigoDiplomado);
    $("#EliminarDiplomado").modal('toggle');
});
