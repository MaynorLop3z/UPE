/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var codigoUsuario;
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
    var fileExtension = "";

    $(':file').change(function ()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: " + fileName + ", peso total: " + fileSize + " bytes.</span>");
    });

    //al enviar el formulario
    $(':button').click(function () {
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
                showMessage(message)
            },
            //una vez finalizado correctamente
            success: function (data) {
                message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                showMessage(message);
                if (isImage(fileExtension))
                {
                    console.log(data);
                    $(".showImage").html("<img src='/UPE/bootstrap/images/publicaciones/" + data + "' />");
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


