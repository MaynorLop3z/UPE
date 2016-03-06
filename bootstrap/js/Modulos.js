var codigoModulo;
$("#btnAddModulo").on('click', function () {
    $("#NuevoModulo").modal();
});

$('#btnFindDip').on('click', function() { ///    boton pra encontrar el diplomado del select
   console.log("Hola");
});

$('.btn_modificar_Mod').on('click',function(event){
    codigoModulo = this.id;
    $("#ModificarModulo").modal('show');
});

$('.btn_eliminar_Mod').on('click',function(event){
    codigoModulo = this.id;
    codigoModulo = codigoModulo.substring();
    $("#EliminarModulo").modal('show');
});

// modificar  Modulo ----------->
$('.btn_modificar_Mod').on('show.bs.modal',function(event){
    var tr = $('#tr'+ codigoModulo);
    var dataM = tr.data("Modd");
    
    $('#ModuloEditNombre').val(dataM.NombreModulo);
    $('#ModuloEditOrden').val(dataM.OrdenModulo);
    $('#Estado').val(dataM.Estado);
    $('#TurnoEDit').val(dataM.CodigoTurno);
    $('#NombreEditDiplomado').val(dataM.CodigoDiplomado);
    $('#ComentarioEditMod').val(dataM.Comentarios);
    
});
$("#formgrdMo").submit(function(event){
    event.preventDefault();
    var $form = $(this), 
   ModuloNombre = $form.find("input[name='NombreModulo']").val(),
    ModuloOrden = $form.find("input[name='ordenM']").val(),
    Estado = $form.find("input[name='Activo']").val(),
    Turno= $form.find("select[name='Turno']").val(),
    NombreDiplomado = $form.find("select[name='Diplomadoname']").val(),
    ComentarioMod = $form.find("textarea[name='Comentarios']").val(),
    url = $form.attr("action");
    if(NombreDiplomado !== null){console.log("no es nulo");} ////// prueba  de  nulidad u.u 
            var posting = $.post(url, {
               ModuloNombre:ModuloNombre,
               ModuloOrden:ModuloOrden,
               Estado:Estado,
               Turno:Turno,
               NombreDiplomado:NombreDiplomado,
               ComentarioMod:ComentarioMod               
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
                            var trMod = $('#tableModulos > tbody').find("#tr" + obj.CodigoModulo);
                            trMod.data("Modd".obj);
                            var tdGestionModulos = trMod.find(".gestion_Mod");
                            var divgestionModBtn = $("#gestion_Mod");
                            
                            if(divgestionModBtn !== null){
                                alert('crea el div');
                                var divgestionModBtnClone = divgestionModBtn;
                                divgestionModBtnClone.find(".btn_modificar_Mod").attr("id","btnModiM"+obj.CodigoModulo);
                                divgestionModBtnClone.find(".btn_eliminar_Mod").attr("id","btnDELM" + obj.CodigoModulo);
                                tdGestionModulos.html(divgestionModBtnClone);
                            }
                                $("#NuevoModulo").modal('toggle');
                        }
                    });
            posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
});  
    







// modificar  Modulo ----------->
$('.btn_modificar_Mod').on('show.bs.modal',function(event){
    var tr = $('#tr'+ codigoModulo);
    var dataM = tr.data("Modd");
    
    $('#ModuloEditNombre').val(dataM.NombreModulo);
    $('#ModuloEditOrden').val(dataM.OrdenModulo);
    $('#Estado').val(dataM.Estado);
    $('#TurnoEDit').val(dataM.CodigoTurno);
    $('#NombreEditDiplomado').val(dataM.CodigoDiplomado);
    $('#ComentarioEditMod').val(dataM.Comentarios);
    
});
$("#formgrdMo").submit(function(event){
    event.preventDefault();
    var $form = $(this), 
   ModuloNombre = $form.find("input[name='NombreModulo']").val(),
    ModuloOrden = $form.find("input[name='ordenM']").val(),
    Estado = $form.find("input[name='Activo']").val(),
    Turno= $form.find("select[name='Turno']").val(),
    NombreDiplomado = $form.find("select[name='Diplomadoname']").val(),
    ComentarioMod = $form.find("textarea[name='Comentarios']").val(),
    url = $form.attr("action");
    if(NombreDiplomado !== null){console.log("no es nulo");} ////// prueba  de  nulidad u.u 
            var posting = $.post(url, {
               ModuloNombre:ModuloNombre,
               ModuloOrden:ModuloOrden,
               Estado:Estado,
               Turno:Turno,
               NombreDiplomado:NombreDiplomado,
               ComentarioMod:ComentarioMod               
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
                            var trMod = $('#tableModulos > tbody').find("#tr" + obj.CodigoModulo);
                            trMod.data("Modd".obj);
                            var tdGestionModulos = trMod.find(".gestion_Mod");
                            var divgestionModBtn = $("#gestion_Mod");
                            
                            if(divgestionModBtn !== null){
                                alert('crea el div');
                                var divgestionModBtnClone = divgestionModBtn;
                                divgestionModBtnClone.find(".btn_modificar_Mod").attr("id","btnModiM"+obj.CodigoModulo);
                                divgestionModBtnClone.find(".btn_eliminar_Mod").attr("id","btnDELM" + obj.CodigoModulo);
                                tdGestionModulos.html(divgestionModBtnClone);
                            }
                                $("#NuevoModulo").modal('toggle');
                        }
                    });
            posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
});  
