//Aun no   actauliza bien la tabla 

/* global posting */

var codigoDiplomado;

$("#BtnADDiplomado").on('click', function () {
    $("#DiplomadoNuevo").modal();
});

$('.btnmoddi').on('click', function (event) {
codigoDiplomado = this.id;
codigoDiplomado = codigoDiplomado.substring(13); /// esto agregue recientemente 
$("#ModificarDiplomado").modal('toggle');
});


$('.btndeldip').on('click', function(event){
    $codigoDiplomado = this.id;
    //$codigoDiplomado = codigoDiplomado.substring(13);
    $('#EliminarDiplomado').modal('toggle');  
});

$('#ModificarDiplomado').on('show.bs.modal', function (event) {
    var dip = $('#dip' + codigoDiplomado);    
    var Nombre_Diplomado = dip.find('.nombre_Diplomado').html().toString().trim(); 
    var DescripcionDiplomado = dip.find('.descripcionDiplomado').html().toString().trim();
    var Estado = dip.find('.estado').html().toString().trim();
    var CategoriaDi = dip.find('.categoriaDi').html().toString().trim();
    var ComentarioDi = dip.find('.comentarioDi').html().toString().trim();
    $('#DiplomadoNombreEdit').val(Nombre_Diplomado);
    $('#DiplomadoDescripcionEdit').val(DescripcionDiplomado);
    $('#estado').val(Estado);
    $('#CatgoriaDiplomadoEdit').val(CategoriaDi);
    $('#ComentarioDiplomadoEdit').val(ComentarioDi);
});



$("EliminarDiplomado").on('show.bs.modal',function(event){
    console.log("mostrar alumno");
    var dip = $('#dip' + codigoDiplomado);
    var nombre_Diplomado = dip.find('.nombre_Diplomado').html().toString().trim();
    $('#markeliminar').html(nombre_Diplomado);    
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
        radio: radio.toString(),
        CatgoriaDiplomado: CatgoriaDiplomado,
        ComentarioDiplomado: ComentarioDiplomado
    });
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var fila;
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
            
            $(document).on("click", "#DELDiplomado"+obj.CodigoDiplomado.toString(),function(){
                codigoDiplomado = obj.CodigoDiplomado;
                $("EliminarDiplomado").modal('toggle');
            });
            
          
            $('#tableDiplomados > tbody').append(fila);
            $('#DiplomadoNuevo').modal('toggle');
        }
    });
    posting.fail(function () {
        alert("error");
    });
});



$("#formeditDiplomado").submit(function (event) {
    event.preventDefault();
    var $form = $(this), CodigoDiplomado = codigoDiplomado, 
            DiplomadoNombre = $form.find("input[name='NombreDiplomado']").val(),
            DiplomadoDescripcion = $form.find("textarea[name='Descripcion']").val(),
            radio = $form.find("input[name='estado']:checked").val(),
            // probar  con el checked
            CatgoriaDiplomado = $form.find("select[name='CodigoCategoriaDiplomado']").val(),
            ComentarioDiplomado = $form.find("textarea[name='Comentarios']").val(),
            url = $form.attr("action");
    console.log(CodigoDiplomado);  //prueba para ver si imprime el codigo correcto    
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
            var fila;
            fila = fila + '<td class="nombre_Diplomado">' + obj.NombreDiplomado + '</td>';
            fila = fila + '<td class="descripcionDiplomado">' + obj.Descripcion + '</td>';
            fila = fila + '<td class="estado">' + obj.Estado + '</td>';
            fila = fila + '<td class="categoriaDi">' + obj.CodigoCategoriaDiplomado + '</td>';
            fila = fila + '<td class="comentarioDi">' + obj.Comentarios + '</td>';
            fila = fila + '<td class="gestion_dip">';
            fila = fila + '<button id="editDiplomado' + obj.CodigoDiplomado + '" title="Editar Diplomado" class="btn btn-success btnmoddi"><span class=" glyphicon glyphicon-pencil"></span></butto n>';
            fila = fila + '<button data-toggle="modal" title="Eliminar Alumno" class="btn btn-danger" href="#AlumnoEliminar"><span class="glyphicon glyphicon-trash"></span></button>';
            fila = fila + '</td>';
            $(document).on("click", "#editDiplomado" + obj.CodigoDiplomado.toString(), function () {
                codigoDiplomado = obj.CodigoDiplomado;
                $("#ModificarDiplomado").modal('toggle');
            });
            $(document).on("click", "#DELDiplomado" + obj.CodigoDiplomado.toString(), function () {
                codigoDiplomado = obj.CodigoDiplomado;
                $("EliminarDiplomado").modal('toggle');
            });
            //$('#tableDiplomados > tbody').append(fila); recien lo quite
            $('#tableDiplomados >tbody').find('#dip'+obj.CodigoDiplomado).html(fila);
            $('#ModificarDiplomado').modal('toggle');
        }// console.log('data vacio');
    });
    posting.fail(function () {
        alert("error");
    });
});




$("#frmDELdip").submit(function(event){
    event.preventDefault();
    var $form = $(this),CodigoDiplomado = codigoDiplomado, url = $form.attr("action");;
    var posting = $.post(url,{CodigoDiplomado : CodigoDiplomado });
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
