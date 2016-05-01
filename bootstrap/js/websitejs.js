/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
    $('#imgPub').attr("src", '../bootstrap' + dataP.Ruta);
    $('#pContenidoPub').text(dataP.Contenido);
});

$('#btnSend').on('click', function(event){
      var link = "mailto:griss@hotmail.com"
//             + "?cc=myCC"
             + "&subject= Consulta de: " + escape(document.getElementById('name').value)
             + "&body=" + escape(document.getElementById('message').value) +"\n\
          "+"Telefono de Contacto: " + escape(document.getElementById('phone').value);

    window.location.href = link;
    
});

