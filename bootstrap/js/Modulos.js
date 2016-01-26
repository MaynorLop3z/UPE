var codigoModulo;
$("#btnAddModulo").on('click', function () {
    $("#NuevoModulo").modal();
});

$('.btn_modificar_Mod').on('click',function(event){
    codigoModulo = this.id;
    $("#ModificarModulo").modal('show');
});

$('.btn_eliminar_Mod').on('click',function(event){
    codigoModulo = this.id;
    codigoModulo = codigoModulo.substring();
    $("#EliminarModulo").modal();
});

// modificar  Modulo ----------->
$("#formgrdMo").submit(function(event){
    event.preventDefault();
    var $form = $(this), 
    moduloName = $form.find("input[name='NombreModulo']").val(),
    moduloOrden = $form.find("input[name='ordenM']").val(),
    estadoMo = $form.find("input[name='radio']").val(),
    turnoMo= $form.find("select[name='Turno']").val(),
    nombreDiplomado = $form.find("select[name='NombreDiplomado']").val(),
    comentarioMod = $form.find("textarea[name='Comentarios']").val(),
    url = $form.attr("action");
            var posting = $.post(url,{
               moduloName:moduloName,
               moduloOrden:moduloOrden,
               estadoMo:estadoMo,
               turnoMo:turnoMo,
               nombreDiplomado:nombreDiplomado,
               comentarioMod:comentarioMod               
            });
                    posting.done(function(data){
                        if(data !== null){
                            var obj = jQuery.parseJSON(data);
                            var fila = '<tr id="tr' + obj.CodigoModulo + '">';
                            fila = fila + '<td class="NombreMod" >' + obj.NombreModulo + '</td>';
                            fila = fila + '<td class="ordenMo" >' + obj.NombreModulo + '</td>';
                            fila = fila + '<td class="Estado" >' + obj.NombreModulo + '</td>';
                            fila = fila + '<td class="TurnoM" >' + obj.NombreModulo + '</td>';
                            fila = fila + '<td class="DipName" >' + obj.NombreModulo + '</td>';
                            fila = fila + '<td class="ComenMo" >' + obj.NombreModulo + '</td>';
                            fila = fila + '<td style="text-align:center"  class="gestion_User">';
            fila = fila + '</td></tr>';
                            $('#tableModulos >tbody').append(fila);
                            var trMod = $('#tableModulos >tbody').find("#tr" + obj.CodigoModulo);
                            trMod.data("Modd".obj);
                            var tdGestionModulos = trMod.find("gestion_Mod");
                            var divgestionModBtn = $("#")
                        }
                    });
            
    
});






