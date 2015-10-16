

/* global posting */

var codigoDiplomado;

$("#BtnADDiplomado").on('click', function() {

    $("#DiplomadoNuevo").modal();
   
});

$('.btnmoddi').on('click', function(event) {
    codigoDiplomado = event.target.id;
    $("#ModificarDiplomado").modal('toggle');
});

$('#formgrdDiplomado').submit(function(event){
event.preventDefault();
var $form = $(this),DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
               DiplomadoDescripcion= $form.find("input[name='Descripcion']").val(),
               radio = $form.find(),
               CatgoriaDiplomado= $form.find("input[name='CodigoCategoriaDiplomado']").val(),
               ComentarioDiplomado = $form.find("input[name='Comentarios']").val(),
                url = $form.attr("action");

var posting = $.post(url,{
    DiplomadoNombre: DiplomadoNombre,
    DiplomadoDescripcion: DiplomadoDescripcion, 
    radio:radio,
    CatgoriaDiplomado: CatgoriaDiplomado,
    ComentarioDiplomado: ComentarioDiplomado
    });
posting.done(function(data){
if(data !== null){
 var obj = jQuery.paseJSON(data);
 var fila;
  fila = '<tr id="dip' + obj.CodigoDiplomado + '">'; 
  fila = fila + '<td class="nombre_Diplomado"' + obj.NombreDiplomado+'</td>';
  fila = fila + '<td class="descripcionDiplomado">'+ obj.Descripcion+'</td>';
  fila = fila + '<td class="estado"'+ obj.Estado +'</td>';
  fila = fila + '<td class="CodigoCategoriaD"'+ obj.CodigoCategoriaDiplomado+'</td>';
  fila = fila + '<td class="comentarioDi"'+ obj.Comentario + '</td>';
  $(document).on("click", "#editDiplomado" + obj.CodigoDiplomado.toString(),function(){
      codigoDiplomado = obj.CodigoDiplomado;
      $("#ModificarDiplomado").modal('toggle'); 
  });
  console.log(fila);
  $('#tableDiplomados> tbody').append(fila);
  $('#DiplomadoNuevo').modal('toggle');  
} console.log('data vacio');
    }); 
 
     posting.fail(function() {
        alert("error");
    });
    
    
});
    

