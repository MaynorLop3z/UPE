/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 */
var codigoPub;

$('.callModalPublicacion').on('click', function (event) {
    codigoPub = this.id;
    $("#portfolioModal6").modal('show');

});


$('#portfolioModal6').on('show.bs.modal', function (event) {
    var pub = $('#' + codigoPub);
    var dataP = pub.data("dimg");


    $('#h2TituloPub').text(dataP.Titulo);
    $('#imgPub').attr("src", 'bootstrap' + dataP.Ruta);
    $('#pContenidoPub').text(dataP.Contenido);
});

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
        alert('El noombre o el mensaje esta vacio.');
    }

});

$(document).ready(function (e) {

});

$('#opccategoria').on('click', function (event) {
//    var slect = document.getElementById('categoriaDiv').value ;
//    alert(slect);
   $('#masRecientesDiv').hide();
    var visto = document.getElementById('categoriaDiv');
    visto.style.display = 'block';

});
