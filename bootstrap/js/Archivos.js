//Variables globales 
var codigoUsuario;
var fileExtension = "";
var fileName;
var codigoPublicacion;
var filaEdit;
var codi;
var Grupo;
var Categoria;

function setVarsOpenModal(gru,cat){
   Grupo = gru;
   Categoria=cat;
   $("#CategoriaArchivo").html(Categoria);
   $("#NuevoArchivo").modal();
}

$(document).ready(function () {
//    document.getElementById('btnAceptar').disable=true;
    
    $(".messages").hide();
    //queremos que esta variable sea global


    $(':file').change(function ()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#fileArchivo")[0].files[0];
        //obtenemos el nombre del archivo
        fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        $('#nombreArchivo').val(fileName);
        $('#extArchivo').val(fileExtension);

        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        var labeltemp = "bytes";
       
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: " + fileName + ", peso total: " + fileSize + " " + labeltemp +".</span>");
    });

    //al enviar el formulario
    $('#subirArchivo').click(function () {

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
                    message = $("<span class='before'>Subiendo el archivo, por favor espere...</span>");
                    showMessage(message);
                },
                //una vez finalizado correctamente
                success: function (data) {
                    //  var file = $("#imagen")[0].files[0];
//                    fileName = file.name;
                    if (isImage(fileExtension) === true)
                    {
                        /*var sizeImg = new Image();
                        //obtenemos el tamaño de la imagen para redirmensionarla si no es del tamaño adecuado
                        sizeImg.src = "/UPE/bootstrap/images/publicaciones/" + fileName;
                        //damos un tamaño fijo a la imagen para que no se desconfigure la modal
                        $(".showImage").html("<img width ='300' heigth='300' src='/UPE/bootstrap/images/publicaciones/" + fileName + "' />");
                        $('#nombreImg').val(fileName);
                        $('#extImg').val(fileExtension);
                        message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                        showMessage(message);*/

                    }
//                    El boton aceptar solo se pone enable cuando la imagen se ha subido correctamente.
                    document.getElementById("btnAceptarArchivo").disabled = false;
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
            message = $("<span class='error'>Ha ocurrido un error, El archivo no es valido.</span>");
            $('#btnLimpiarPubliArchivo').click();
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
            case 'txt':
                return true;
                break;
            case 'pdf':
                return true;
                break;
            case 'doc':
                return true;
                break;
            case 'docx':
                return true;
                break;
            case 'rar':
                return true;
                break;
            case 'zip':
                return true;
                break;
            case 'xls':
                return true;
                break;
            case 'xlsm':
                return true;
            case 'ppt':
                return true;
                break;
            case 'pptx':
                return true;
                break;
            case 'odt':
                return true;
                break;
            case 'odf':
                return true;
                break;
            case 'ods':
                return true;
                break;
            case 'odp':
                return true;
                break;
            case 'rtf':
                return true;
                break;
            default:
                return false;
                break;
        }
    }
});


//metodo que lleva el post a la base de datos

$('#botonesArchivo').submit(function (event)
{
    event.preventDefault();

    var $form = $(this), Titulo = $form.find("input[name='tituloArchivo']").val(),
            Contenido = $form.find("textarea[name='contenidoArchivo']").val(),
            url = $form.attr("action"),
            Nombre = $form.find("input[name='nombreArchivo']").val(),
            Extension = $form.find("input[name='extArchivo']").val(),
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
            //$(".showImage").html("");
            $(":text").each(function () {
                $($(this)).val('');
            });
            $(".messages").html("").show();
//    $('#subir').reset();
            document.getElementById("archivoform").reset();
            document.getElementById("archivotexarea").value = "";
            document.getElementById("btnAceptarArchivo").disabled = true;
            $('#NuevoArchivo').modal("toggle");

        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});

//boton que elimina el archivo de ala carpeta y limpia el form al dar cancelar, cierra la modal depues de dar cancelar
$('#btnCancelarPArchivo').on('click', function (e) {
    e.preventDefault();
    var $form = $(this);
    var Nombre = $('#botonesArchivo').find("input[name='nombreArchivo']").val();
//   <?php echo base_url() ?>index.php/PublicacionesController/borrarImgCarpeta/
    if (Nombre !== null) {
//        Nombre= "" + Nombre;
        $.post("ArchivosController/borrarImgCarpeta/", {Nombre: Nombre});
    }
//    alert(Nombre);
   // $(".showImage").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
//    $('#subir').reset();
    document.getElementById("archivoform").reset();
    document.getElementById("archivotexarea").value = "";
    document.getElementById("btnAceptarArchivo").disabled = true;
    $('#NuevoArchivo').modal("toggle");
});

//boton que elimina el archivo de ala carpeta y limpia el form al dar cancelar, NO cierra la modal depues de dar limpiar
$('#btnLimpiarPubliArchivo').on('click', function (e) {
    e.preventDefault();
    var Nombre = $('#botonesArchivo').find("input[name='nombreArchivo']").val();
//   <?php echo base_url() ?>index.php/PublicacionesController/borrarImgCarpeta/
    if (Nombre !== null) {
//        Nombre= "" + Nombre;
        $.post("ArchivosController/borrarImgCarpeta/", {Nombre: Nombre});
    }
//    alert(Nombre);
    //$(".showImage").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
//    $('#subir').reset();
    document.getElementById("archivoform").reset();
    document.getElementById("archivotexarea").value = "";
    document.getElementById("btnAceptarArchivo").disabled = true;
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


//-----------------DESCARGAS------------------

//function goArchivo(arch){
  //  location.href = arch;
//}

