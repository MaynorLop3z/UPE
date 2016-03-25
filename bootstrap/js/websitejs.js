/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#Ingresar').submit(function (event) {
    event.preventDefault();
    var $form = $(this), Nombre = $form.find("input[name='user']").val(),
            Pass = $form.find("input[name='password']").val(),
                        url = $form.attr("action");
        var posting = $.post(url, {
        Nombre: Nombre,
        Pass: Pass,
        
    });
     posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);

        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJson(data);
        alert(obj.Error);
    });
});
