/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var codigoUsuario;
var fileExtension = "";
var fileName;
$(document).ready(function () {
//    console.log("Si esta llamando al js");
////funcion para  mostrar la tablaa
//    if (data !== null) {
//        var obj = jQuery.parseJSON(data);
//        var fila;
//        fila = '<tr id="dip' + obj.CodigoPublicacion + '"';
//        fila = fila + '<td class="Titulo">' + obj.Titulo + '</td>';
//         $('#tableTitulo > tbody').append(fila);
//    }
//    ;
    $(".messages").hide();
    //queremos que esta variable sea global


    $(':file').change(function ()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        $('#nombreImg').val(fileName);
        $('#extImg').val(fileExtension);

        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: " + fileName + ", peso total: " + fileSize + " bytes.</span>");
    });

    //al enviar el formulario
    $('#subir').click(function () {
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
        var message = "";
        //hacemos la petición ajax  
        $.ajax({
            url: $('.formulario').attr('action'),
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                showMessage(message);
            },
            //una vez finalizado correctamente
            success: function (data) {
                //  var file = $("#imagen")[0].files[0];
                //fileName = file.name;

                message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                showMessage(message);
                if (isImage(fileExtension))
                {
                    var sizeImg = new Image();
                    //obtenemos el tamaño de la imagen para redirmensionarla si no es del tamaño adecuado
                    sizeImg.src = "/UPE/bootstrap/images/publicaciones/" + fileName;
                    
                    if (sizeImg.width < 500) {
                        $(".showImage").html("<img  align=center src='/UPE/bootstrap/images/publicaciones/" + fileName + "' />");
                    } else {
                        $(".showImage").html("<img width ='500' heigth='100' src='/UPE/bootstrap/images/publicaciones/" + fileName + "' />");
                    }

                }
            },
            
            //si ha ocurrido un error
            error: function () {
                message = $("<span class='error'>Ha ocurrido un error.</span>");
                showMessage(message);
            }
        });
    });


//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
    function showMessage(message) {
        $(".messages").html("").show();
        $(".messages").html(message);
    }

//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
    function isImage(extension)
    {
        switch (extension.toLowerCase())
        {
            case 'jpg':
            case 'gif':
            case 'png':
            case 'jpeg':
                return true;
                break;
            default:
                return false;
                break;
        }
    }
});

$('#botones').submit(function (event)
{
    console.log(document.getElementById("nombreImg").value);
//    alert(document.getElementById("extImg").value);

    event.preventDefault();
    var $form = $(this), Titulo = $form.find("input[name='titulo']").val(),
            Contenido = $form.find("textarea[name='contenido']").val(),
            url = $form.attr("action"),
            nombre = $form.children('input[id=nombreImg]').val(),
            ext = $form.children('input[name=extenImg]').val();
    
    var posting = $.post(url, {
        Titulo: Titulo,
        Contenido: Contenido,
        nombre: nombre,
        ext: ext
    });
    console.log(posting);
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

//function eliminarDiplomado(fila) {
//    codigoDiplomado = fila.id;
//    codigoDiplomado = codigoDiplomado.substring(12);
//    $('#EliminarDiplomado').modal('toggle');
//
//}