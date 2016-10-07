$('#btnAbrirAgregarAula').click(function(){
    $("#ModalAulaNueva").modal();
});

$('#formAgregarAula').submit(function(e){
    e.preventDefault();
    $("#ModalAulaNueva").modal('toggle');
    var posting = $.post($(this).attr('action'),{"Nombre":$('#AulaNombre').val(), 
        "Descripcion":$('#AulaDescripcion').val(), "Tipo":$('#TipoAula').val()});
    posting.done(function(data){
        if(data){
           $('#bodytablaAulas tr:first').before(data);
        }
    });
    errorPost(posting);
});

$('#frmEliminarAula').submit(function(e){
    e.preventDefault();
    var posting = $.post($(this).attr('action'),{"Id":$('#idAulaEliminar').val()});
    posting.done(function(data){
        if(data){
           $('#Aula-'+$('#idAulaEliminar').val()).hide();
           $('#ModalEliminarAula').modal('toggle');
        }
    });
    errorPost(posting);
});

$('#formModificarAula').submit(function(e){
    e.preventDefault();
    var posting = $.post($(this).attr('action'),{"Id":$('#idAulaModificar').val(),
    "Nombre":$('#AulaNombreModificar').val(), "Descripcion":$('#AulaDescripcionModificar').val(), 
    "Tipo":$('#TipoAulaModificar').val()});
    posting.done(function(data){
        if(data){
           $('#Aula-'+$('#idAulaModificar').val()).replaceWith(data);
           $('#ModalAulaModificar').modal('toggle');
        }
    });
    errorPost(posting);
});

function eliminarAula(nombre, id){
    $('#nombreAulaDel').html(nombre);
    $('#idAulaEliminar').val(id);
    $('#ModalEliminarAula').modal();
}

function editarAula(nombre, id, descripcion, tipo){
    $('#AulaNombreModificar').val(nombre);
    $('#AulaDescripcionModificar').val(descripcion);
    $('#TipoAulaModificar').val(tipo);
    $('#idAulaModificar').val(id);
    $("#ModalAulaModificar").modal();
}

function errorPost(posting){
    posting.fail(function(data) {
      alert("error" + data);
    });
}

////////////PAGINACION DE PUBLICACIONES//////////////
    
$("#AulasListContent").on("click", "#aFirstPagAulas", function (e) {
    paginarAulas("data_ini", $(this).data("datainic"));
});

$("#AulasListContent").on("click", "#aLastPagAulas", function (e) {
    paginarAulas("data_ini", $(this).data("datainic"));
});

$("#AulasListContent").on("click", "#aPrevPagAulas", function (e) {
    paginarAulas("data_inip", null);
});

$("#AulasListContent").on("click", "#aNextPagAulas", function (e) {
    paginarAulas("data_inin", null);
});

$("#AulasListContent").on("keypress", "#txtPagingSearchAulas", function (e) {
    e.stopImmediatePropagation();
    if (e.which === 13 && ($(this).val()>0)) {
         paginarAulas("data_ini", $(this).val());
    }
});


function paginarAulas(dat, op){
    var data_in = $('#txtPagingSearchAulas').data("datainic");     
    var url = 'AulasController/paginAulas/';
    var opcion="";
    if(dat==="data_inin"){
         opcion={"data_inin":data_in};
    }else if(dat==="data_inip"){
        opcion={"data_inip":data_in};
    }else if(dat==="data_ini"){
        data_in= op;
        opcion={"data_ini":data_in};
    }
    var posting = $.post(url, opcion);
    posting.done(function (data) {
        if (data !== null) {
            $('#AulasListContent').empty();
            $('#AulasListContent').html(data);
        }
    });
    posting.fail(function (data) {
        alert("Error");
    });
}

$('#btnCleanSearchAulas').click(function(e){
    e.preventDefault();
    $('#FindAulasNombre').val('');
    $('#FindAulasTipo').val('');
    paginGeneralAula();
});

$('.FindAulasClass').keyup(function(event){ //BUSCA AULA AL MODIFICAR LA CAJA DE TEXTO
        var nombre =$('#FindAulasNombre').val();
        var tipo = $('#FindAulasTipo').val();
        if(nombre.length>0 && tipo.length==0){ //FILTRA BUSQUEDA SOLO POR NOMBRE
            buscarParametrosAula('FindByNombre', nombre, tipo);
        }
        if(nombre.length==0 && tipo.length>0 ){ //FILTRA BUSQUEDA SOLO POR TIPO
            buscarParametrosAula('FindByTipo', nombre, tipo);
        }
        if(nombre.length!=0 && tipo.length!=0){ //FILTRA BUSQUEDA POR NOMBRE Y TIPO
            buscarParametrosAula('FindByNombre+Tipo', nombre, tipo);
        }
        else if(nombre.length==0 && tipo.length==0){
            buscarParametrosAula('Reset', null, null)
        }
    });

    //BUSCA PUBLICACION SEGUN LOS PARAMETROS Y CAMPOS DE TEXTO RELLENADOS
    function buscarParametrosAula(find, nombre, categoria){
        //REALIZA LA BUSQUEDA SEGUN EL TIPO DE FILTRO
        if(find=='Reset'){
            paginGeneralAula();
        }
        else{
            var opcion='';
            switch (find){
                case "FindByNombre":
                opcion={Nombre:nombre};
                break;
            case "FindByTipo": 
                opcion={Tipo:categoria};
                break;
            case 'FindByNombre+Tipo':
                opcion={Nombre:nombre, Tipo:categoria};
                break;
            }
            var posting = $.post("AulasController/buscarAulas/",opcion);
            posting.done(function(data){
                if(data){
                   $('#AulasListContent').html(data);
                }
            });
            posting.fail(function(xhr, textStatus, errorThrown) {
              alert("error" + xhr.responseText);
            });
        }
    }
    
    function paginGeneralAula(){
        var posting = $.post("AulasController/paginAulas/", {"data_ini":1});
            posting.done(function (data) {
                if (data !== null) {
                    $('#AulasListContent').empty();
                    $('#AulasListContent').html(data);
                }
            });
            posting.fail(function (data) {
                alert("Error");
            });
    }