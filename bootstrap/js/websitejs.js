/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 */
var codigoPub;
$("#PubsCategoria").on("click", ".callModalPublicacion", function (e) {
//$('.callModalPublicacion').on('click', function (event) {

    alert("show modal");
    codigoPub = this.id;
    alert(codigoPub);
    var pub = $('#' + codigoPub);

    var dataP = pub.data("dimg");
    alert(dataP);
    if (dataP) {
        $("#portfolioModal6").modal('show');
        $('#h2TituloPub').text(dataP.Titulo);
        $('#imgPub').attr("src", 'bootstrap' + dataP.Ruta);
        $('#pContenidoPub').text(dataP.Contenido);
    }
    else {
        alert("something went wrong!!!!!!!");
    }


});



//Pubsrecie
$("#Pubsrecie").on("click", ".callModalPublicacion", function (e) {
//$('.callModalPublicacion').on('click', function (event) {

    alert("show modal");
    codigoPub = this.id;
    var pub = $('#' + codigoPub);
    var dataP = pub.data("dimg");

    $("#portfolioModal6").modal('show');

    $('#h2TituloPub').text(dataP.Titulo);
    $('#imgPub').attr("src", 'bootstrap' + dataP.Ruta);
    $('#pContenidoPub').text(dataP.Contenido);


    alert("something went wrong!!!!!!!");


});

$("#PubsDate").on("click", ".callModalPublicacion", function (e) {
//$('.callModalPublicacion').on('click', function (event) {

    alert("show modal");
    codigoPub = this.id;
    var pub = $('#' + codigoPub);
    var dataP = pub.data("dimg");
    if (typeof dataP !== undefined) {
        $("#portfolioModal6").modal('show');
        $('#h2TituloPub').text(dataP.Titulo);
        $('#imgPub').attr("src", 'bootstrap' + dataP.Ruta);
        $('#pContenidoPub').text(dataP.Contenido);
    }
    else {
        alert("something went wrong!!!!!!!");
    }

});

//$('#portfolioModal6').on('show.bs.modal', function (event) {
//
//    $('#h2TituloPub').text(dataP.Titulo);
//    $('#imgPub').attr("src", 'bootstrap' + dataP.Ruta);
//    $('#pContenidoPub').text(dataP.Contenido);
//});


$('#btnSend').on('click', function (event) {
//    alert("Se abrira su gestor de correo electronico para enviar el mensaje.");
    var select = document.getElementById('selectCategoria');
    var indice = select.options[select.selectedIndex].value;
//            document.contactForm.selectCategoria.selectedIndex ;
    if (document.getElementById('name').value !== null && document.getElementById('message').value !== null) {

        var link = "mailto:griss@hotmail.com"
//             + "?cc=myCC"
                + "&subject= Consulta de: " + escape(document.getElementById('name').value)
                + "&body=" + escape(document.getElementById('message').value) + "\n\
          " + "Telefono de Contacto: " + escape(document.getElementById('phone').value);

        window.location.href = link;
    } else {
        alert('El nombre o el mensaje esta vacio.');
    }

});

$('#opcReciente').on('click', function (event) {
//$('#masRecientesDiv').style.display = 'block';
    $('#masRecientesDiv').show();
    var visto = document.getElementById('categoriaDiv');
    visto.style.display = 'none';
    var vistodate = document.getElementById('DateDiv');
    vistodate.style.display = 'none';

});

$('#opccategoria').on('click', function (event) {
//    var slect = document.getElementById('categoriaDiv').value ;
//    alert(slect);
    $('#masRecientesDiv').hide();
    var vistodate = document.getElementById('DateDiv');
    vistodate.style.display = 'none';
    var visto = document.getElementById('categoriaDiv');
    visto.style.display = 'block';

});

$('#opcDate').on('click', function (e) {

    var visto = document.getElementById('DateDiv');
    visto.style.display = 'block';
    $('#masRecientesDiv').hide();
    var vistocat = document.getElementById('categoriaDiv');
    vistocat.style.display = 'none';
    var fecha = document.getElementById('fechastart').type;

    if (fecha !== "date") {
        $fecha = $('#fechastart');

        
        $fecha.datepicker();
        $fechaend = $('#fechaend');
        $fechaend.datepicker();

    }

});

$('#selectCategoriaBusqueda').on('change', function (event) {
    //post con la categoria
    var select = document.getElementById('selectCategoriaBusqueda');
    var categoria = select.options[select.selectedIndex].value;
    var url = 'index.php/wsite/listar/';

    var posting = $.post(url, {
        Categoria: categoria
    });

    posting.done(function (data) {
        if (data !== null) {
            $('#PubsCategoria').empty();
            $('#PubsCategoria').html(data);
        }
        else {
        }

    });
});