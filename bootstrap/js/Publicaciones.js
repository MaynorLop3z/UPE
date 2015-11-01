/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var codigoUsuario;
$(document).ready(function () {
    console.log("Si esta llamando al js");



//funcion para guardar la img en la carpeta
    $("#divPub").submit(function (event)
    
    {
        console.log("entro a la funcion");
        event.preventDefault();
        var $div = $(this);
        Titulo = $div.find("input[name='tituloPub']").val();
        console.log(Titulo),
        Contenido = $div.children("textarea[name='cuerpoPub']").val();
        console.log(Contenido);
//        url = base_url("index.php/PublicacionesController/do_upload");
        url=".../application/controllers/PublicacionesController/do_upload";
        console.log(url);
        var posting = $.post(url, {titulo: Titulo, contenido: Contenido});
        console.log(posting);
        



    });

});
