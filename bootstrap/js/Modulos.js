var codigoModulo;
$("#btnAddModulo").on('click', function () {
    $("#NuevoModulo").modal();
});

function editModulo(fila){
    codigoModulo =  fila.id;
    filaEdit = fila;
    codigoModulo = codigoModulo.substring(7);
    $("#ModificarModulo").modal('toggle');
}

function delMo(fila){
    codigoModulo =  fila.id;
    codigoModulo = codigoModulo.substring(5);
    $("#EliminarModulo").modal('toggle');
    
}


// modificar  Modulo ----------->
$('.btn_modificar_Mod').on('show.bs.modal',function(event){
    var Mod = $('#Mod'+ codigoModulo);
    var dataM = Mod.data("ModM");
    
   $('#ModuloNombreEdit').val(dataM.NombreModulo);
   $('#ModuloOrdenEdit').val(dataM.ordenM);
   $('#EstadoE').val(dataM.Estado);
   $('#TurnoEdit').val(dataM.Turno);
   $('#DiplomadonameEdit').val(dataM.Diplomadoname);
   $('#ComentarioModEdit').val(dataM.Comentarios);
//  

});
$("#formgrdMo").submit(function(event){
    event.preventDefault();
    var $form = $(this), ModuloNombre = $form.find("input[name='NombreModulo']").val(),
    ModuloOrden = $form.find("textarea[name='ordenM']").val(),
    Estado = $form.find("input[name='Activo']:checked").val(),// para ver si el checked  es la falla
    Turno= $form.find("select[name='Turno']").val(),
    NombreDiplomado = $form.find("select[name='Diplomadoname']").val(),
    ComentarioMod = $form.find("textarea[name='Comentarios']").val(),
    url = $form.attr("action");
             var posting = $.post(url, { 
               ModuloNombre:ModuloNombre,
               ModuloOrden:ModuloOrden,
               Estado:Estado,
               Turno:Turno,
               NombreDiplomado:NombreDiplomado,
               ComentarioMod:ComentarioMod 
           });
           if(posting === null){
            console.log("es nulo");}
                    posting.done(function(data){
                       
                        if(data !== null) {
                            var obj = jQuery.parseJSON(data);
                            
                            var fila  = '<tr id="$Mod' + obj.CodigoModulo + '">';
                            fila = fila + '<td class="NombreMod" >' + obj.NombreModulo + '</td>';
                            fila = fila + '<td class="ordenMo" >' + obj.OrdenModulo + '</td>';
                            fila = fila + '<td class="Estado" >' + obj.Estado + '</td>';
                            fila = fila + '<td class="TurnoM" >' + obj.CodigoTurno + '</td>';
                            fila = fila + '<td class="DipName" >' + obj.CodigoDiplomado + '</td>';
                            fila = fila + '<td class="ComenMo" >' + obj.Comentarios + '</td>';
                            fila = fila + '<td style="text-align:center"  class="gestion_Mod">';
                            fila = fila + '<button id="ModEdit' + obj.CodigoModulo +'" onclick="editModulo(this)" title="Editar Modulo" class="btn_modificar_Mod btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button>';
                            fila = fila + '<button id="ModDe'+ obj.CodigoDiplomado +'"onclick="delMo(this)" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                            fila = fila + '</td></tr>';
                            $('#tableModulos >tbody').append(fila);
                            var ModMod = $('#tableModulos > tbody').find("#Mod" + obj.CodigoModulo);
                            ModMod.data("Modd".obj);
                            var tdGestionModulos = ModMod.find(".gestion_Mod");
                           
                            var divgestionModBtn = $("#gestion_Mod");
                            if(divgestionModBtn !== null){
                                alert('prueba');
                                var divgestionModBtnClone = divgestionModBtn;
                                divgestionModBtnClone.find(".btn_modificar_Mod").attr("id","btnModiM"+obj.CodigoModulo);
                                divgestionModBtnClone.find(".btn_eliminar_Mod").attr("id","btnDELM" + obj.CodigoModulo);
                                tdGestionModulos.html(divgestionModBtnClone);
                            
                            }
                            $("#NuevoModulo").modal('toggle');
                        }
                    });
            posting.fail(function () {
        alert("error");
    });
});  
    







// modificar  Modulo ----------->
$('.btn_modificar_Mod').on('show.bs.modal',function(event){
    var Mod = $('#Mod'+ codigoModulo);
    var dataM = Mod.data("Modd");
    
//    $('#ModuloEditNombre').val(dataM.NombreModulo);
//    $('#ModuloEditOrden').val(dataM.OrdenModulo);
//    $('#Estado').val(dataM.Estado);
//    $('#TurnoEDit').val(dataM.CodigoTurno);
//    $('#NombreEditDiplomado').val(dataM.CodigoDiplomado);
//    $('#ComentarioEditMod').val(dataM.Comentarios);


    
});

 
