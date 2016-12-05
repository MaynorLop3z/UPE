/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 */
var codigoPub;
$("#PubsCategoria").on("click", ".callModalPublicacion", function (e) {
//$('.callModalPublicacion').on('click', function (event) {
    codigoPub = this.id;
    var pub = $('#' + codigoPub);

    var dataP = pub.data("dimg");
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


    codigoPub = this.id;
    var pub = $('#' + codigoPub);
    var dataP = pub.data("dimg");

    $("#portfolioModal6").modal('show');

    $('#h2TituloPub').text(dataP.Titulo);
    $('#imgPub').attr("src", 'bootstrap' + dataP.Ruta);
    $('#pContenidoPub').text(dataP.Contenido);



});
$("PubName").on("click", ".callModalPublicacion", function (e) {
//$('.callModalPublicacion').on('click', function (event) {


    codigoPub = this.id;
    var pub = $('#' + codigoPub);
    var dataP = pub.data("dimg");

    $("#portfolioModal6").modal('show');

    $('#h2TituloPub').text(dataP.Titulo);
    $('#imgPub').attr("src", 'bootstrap' + dataP.Ruta);
    $('#pContenidoPub').text(dataP.Contenido);



});

$("#PubsDate").on("click", ".callModalPublicacion", function (e) {
//$('.callModalPublicacion').on('click', function (event) {

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

//            document.contactForm.selectCategoria.selectedIndex ;
    if (document.getElementById('name').value && document.getElementById('message').value) {

        var link = "mailto:rinabes@yahoo.com"
//             + "?cc=myCC"
                + "&subject= Consulta de: " + escape(document.getElementById('name').value)
                + "&body=" + escape(document.getElementById('message').value) + "\n\
          " + "Telefono de Contacto: " + escape(document.getElementById('phone').value);

        window.location.href = link;
        alert("Se abrira su gestor de correo electronico para enviar el mensaje.");
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
    var vistoname = document.getElementById('NameDiv');
    vistoname.style.display = 'none';

});

$('#opccategoria').on('click', function (event) {
//    var slect = document.getElementById('categoriaDiv').value ;
    $('#masRecientesDiv').hide();
    var vistodate = document.getElementById('DateDiv');
    vistodate.style.display = 'none';
    var vistoname = document.getElementById('NameDiv');
    vistoname.style.display = 'none';
    var visto = document.getElementById('categoriaDiv');
    visto.style.display = 'block';

});

$('#opcNombre').on('click', function (event) {
//    var slect = document.getElementById('categoriaDiv').value ;
    var vistoname = document.getElementById('NameDiv');
    vistoname.style.display = 'block';
    $('#masRecientesDiv').hide();
    var vistodate = document.getElementById('DateDiv');
    vistodate.style.display = 'none';
    var vistocat = document.getElementById('categoriaDiv');
    vistocat.style.display = 'none';


});



$('#opcDate').on('click', function (e) {

    var visto = document.getElementById('DateDiv');
    visto.style.display = 'block';
    var vistoname = document.getElementById('NameDiv');
    vistoname.style.display = 'none';
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

//esta funcion valida y cambia el formato de fecha para navegarodes que no soportan el tipo date de html5
function validarFechafire(date) {
    var x;
    fecha = date.split("/");
    var dia = fecha[0];
    var mes = fecha[1];
    var ano = fecha[2];
    x = new Date(ano, mes, dia);
    return  x;
}


$('#btndate').on('click', function (event) {
    var start = document.getElementById('fechastart').value;
    var end = document.getElementById('fechaend').value;

    if ($("#fechastart").val().trim() === '' || $("#fechaend").val().trim() === '') {
        alert('Ingrese las fechas solicitadas!!!');
    } else {
        var txtdate = document.getElementById('fechastart').type;
        if (txtdate !== "date") {
            start = validarFechafire(start);
            end = validarFechafire(end);
        } else {
            start = new Date(start);

            end = new Date(end);

        }
        var i = start.getTime();
        var e = end.getTime();
        var today = new Date();
        today = today.getTime();
        if (e >= i) {
            var url = 'index.php/wsite/listarFecha/';
            var posting = $.post(url, {
                Start: start,
                End: end
            });
        } else {
            if (e >= today) {
                alert('Ingrese una Fecha Valida');
            }
            else {
                alert('Ingrese una Fecha Valida');
            }
        }

    }
    
    posting.done(function (data) {
        if (data !== null) {
            $('#PubsDate').empty();
            $('#PubsDate').html(data);
        }
        else {
        }

    });


});