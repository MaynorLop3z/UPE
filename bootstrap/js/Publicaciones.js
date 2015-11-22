/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var codigoUsuario;
$(document).ready(function (data) {
    console.log("Si esta llamando al js");
//funcion para guardar la img en la carpeta
    if (data !== null) {
        var obj = jQuery.parseJSON(data);
        var fila;
        fila = '<tr id="dip' + obj.CodigoPublicacion + '"';
        fila = fila + '<td class="Titulo">' + obj.Titulo + '</td>';
    }
    ;

});


