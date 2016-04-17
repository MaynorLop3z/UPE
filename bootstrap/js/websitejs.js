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

