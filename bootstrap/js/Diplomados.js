//Aun no   actauliza bien la tabla 

/* global posting */

var codigoDiplomado;
var FilaEdit;
$("#BtnADDiplomado").on('click', function () {

    $("#DiplomadoNuevo").modal();

});

$('.btnmoddi').on('click', function (event) {
    codigoDiplomado = event.target.id;
    FilaEdit=$(this);
    console.log('clic en ediar al codigo:' + codigoDiplomado)
    $("#ModificarDiplomado").modal('toggle');
});

$('#formgrdDiplomado').submit(function (event) {
    event.preventDefault();
    var $form = $(this), DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            radio = $form.find("input[name='estado']").val(),
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
            var fila;
            
            if(obj.NombreDiplomado!=null){
                console.log("No soy nulo");
            }else{ console.log("soy nulo");}
            
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
            $(document).on("click", "#editDiplomado" + obj.CodigoDiplomado.toString(),function(){
              codigoDiplomado = obj.CodigoDiplomado;
            $("#ModificarDiplomado").modal('toggle'); 
             });
             console.log(fila);
            //if (obj.CodigoDiplomado != null) {
              //  console.log("No soy nulo")
           // } else {
             //   console.log("soy nullo")
            //}
            
            $('#tableDiplomados > tbody').append(fila);
            $('#DiplomadoNuevo').modal('toggle');
        }// console.log('data vacio');
    });

    posting.fail(function () {
        alert("error");
    });


});


$("#formeditDiplomado").submit(function(event){
    event.preventDefault();
    var $form =$(this),CodigoDiplomado = codigoDiplomado.substring(5), 
                        DiplomadoNombre= $form.find("input[name='NombreDiplomado']").val(),
                        DiplomadoDescripcion=$form.find("textarea[name='Descripcion']").val(),
                        optionsActivo=$form.find("input[name='Estado']").val(),
                        CatgoriaDiplomado= $form.find("select[name='CodigoCategoriaDiplomado']").val(),
                        ComentarioDiplomado=$form.find("textarea[name='Comentarios']").val(),
                        url =$form.attr("action");
            
     var posting = $.post(url,{CodigoDiplomado:CodigoDiplomado,
         DiplomadoNombre:DiplomadoNombre,
         DiplomadoDescripcion:DiplomadoDescripcion,
         optionsActivo:optionsActivo,
         CatgoriaDiplomado:CatgoriaDiplomado,
         ComentarioDiplomado:ComentarioDiplomado
     }); 
     posting.done(function(data){
         if(data !== null){
             
         }
         
         
     })
});
