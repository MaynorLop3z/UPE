/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Variables globales 
var codigoUsuario;
var fileExtension = "";
var fileName;
var codigoPublicacion;
var filaEdit;
var codi;


$(document).ready(function () {
//    document.getElementById('btnAceptar').disable=true;

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
        if (isImage(fileExtension) === true) {
            //hacemos la petición ajax  
            $.ajax({
                url: $('.formulario').attr('action'),
                type: 'POST',
                // Form data
                //datos del formulario
                //necesario para subir archivos via ajax
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                // enviamos el archivo
                beforeSend: function () {
                    message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                    showMessage(message);
                },
                //una vez finalizado correctamente
                success: function (data) {
                    //  var file = $("#imagen")[0].files[0];
//                    fileName = file.name;
                    if (isImage(fileExtension) === true)
                    {
                        var sizeImg = new Image();
                        //obtenemos el tamaño de la imagen para redirmensionarla si no es del tamaño adecuado
                        sizeImg.src = "/UPE/bootstrap/images/publicaciones/" + fileName;
//damos un tamaño fijo a la imagen para que no se desconfigure la modal
                        $(".showImage").html("<img width ='300' heigth='300' src='/UPE/bootstrap/images/publicaciones/" + fileName + "' />");
                        $('#nombreImg').val(fileName);
                        $('#extImg').val(fileExtension);
                        message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                        showMessage(message);

                    }
//                    El boton aceptar solo se pone enable cuando la imagen se ha subido correctamente.
                    document.getElementById("btnAceptar").disabled = false;
                },
                //si ha ocurrido un error
                error: function () {
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                    showMessage(message);
                }
            });
        }
//        si el archivo que se intenta subir no es un img
        else {
            message = $("<span class='error'>Ha ocurrido un error, El archivo no es una Imagen.</span>");
            showMessage(message);
        }

    });


//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
    function showMessage(message) {
        $(".messages").html("").show();
        $(".messages").html(message);
    }

//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
//si no cumple  con alguna de las extensiones del case  devuelve error
    function isImage(extension)
    {
        switch (extension.toLowerCase())
        {
            case 'jpg':
                return true;
                break;
            case 'gif':
                return true;
                break;
            case 'png':
                return true;
                break;
            case 'jpeg':
                return true;
                break;
            default:
                return false;
                break;
        }
    }
});


//metodo que lleva el post a la base de datos

$('#botones').submit(function (event)
{
    event.preventDefault();

    var $form = $(this), Titulo = $form.find("input[name='titulo']").val(),
            Contenido = $form.find("textarea[name='contenido']").val(),
            url = $form.attr("action"),
            Nombre = $form.find("input[name='nombreImg']").val(),
            Extension = $form.find("input[name='extImg']").val(),
            categoria = $form.find("select[name='categoriasl']").val();

    var posting = $.post(url, {
        Titulo: Titulo,
        Contenido: Contenido,
        Nombre: Nombre,
        Extension: Extension,
        Categoria: categoria
    });

    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            //dejamos todo en blanco  para la siguiente pulicacion
            $(".showImage").html("");
            $(":text").each(function () {
                $($(this)).val('');
            });
            $(".messages").html("").show();
//    $('#subir').reset();
            document.getElementById("imgform").reset();
            document.getElementById("pubtexarea").value = "";
            document.getElementById("btnAceptar").disabled = true;
            $('#NuevaPublicacion').modal("toggle");

        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});

//boton que elimina el archivo de ala carpeta y limpia el form al dar cancelar, cierra la modal depues de dar cancelar
$('#btnCancelarP').on('click', function (e) {
    e.preventDefault();
    var $form = $(this);
    var Nombre = $('#botones').find("input[name='nombreImg']").val();
//   <?php echo base_url() ?>index.php/PublicacionesController/borrarImgCarpeta/
    if (Nombre !== null) {
//        Nombre= "" + Nombre;
        $.post("PublicacionesController/borrarImgCarpeta/", {Nombre: Nombre});
    }
//    alert(Nombre);
    $(".showImage").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
//    $('#subir').reset();
    document.getElementById("imgform").reset();
    document.getElementById("pubtexarea").value = "";
    document.getElementById("btnAceptar").disabled = true;
    $('#NuevaPublicacion').modal("toggle");
});

//boton que elimina el archivo de ala carpeta y limpia el form al dar cancelar, NO cierra la modal depues de dar limpiar
$('#btnLimpiarPubli').on('click', function (e) {
    e.preventDefault();
    var Nombre = $('#botones').find("input[name='nombreImg']").val();
//   <?php echo base_url() ?>index.php/PublicacionesController/borrarImgCarpeta/
    if (Nombre !== null) {
//        Nombre= "" + Nombre;
        $.post("PublicacionesController/borrarImgCarpeta/", {Nombre: Nombre});
    }
//    alert(Nombre);
    $(".showImage").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
//    $('#subir').reset();
    document.getElementById("imgform").reset();
    document.getElementById("pubtexarea").value = "";
    document.getElementById("btnAceptar").disabled = true;
});


//_________________________ from here doesn't work yet ______________________________
function eliminarPublicacion(fila) {
    codigoPublicacion = fila.id;
    codigoPublicacion = codigoPublicacion.substring(12);
    $('#EliminarPublicacion').modal('toggle');

}


$("#EliminarPublicacion").on('show.bs.modal', function (event) {
    var dip = $('#dip' + codigoPublicacion);

    var NombreDiplomadoE = dip.find(".titulo").html().toString().trim();
    $('#nombreDipPub').html(TituloDiplomado);
});


