//Variables globales 
var codigoUsuario;
var fileExtension = "";
var fileName;
var codigoPublicacion;
var filaEdit;
var fileSize;
var codi;
var Grupo;
var Categoria;
var CCategoria;
var CoGrPerUs;
var CoDel;
var gru;

function setVarsOpenModal(gru,cat,ccat,cgperu){
   Grupo = gru;
   Categoria=cat;
   CCategoria=ccat;
   CoGrPerUs=cgperu;
   $("#CategoriaArchivo").html(Categoria);
   $("#NuevoArchivo").modal();
}

$(document).ready(function () {
    $(".messages").hide();
    $('#formArchivo').change(function ()
    {
        var file = $("#fileArchivo")[0].files[0];
        var ofileName = file.name;
        //generando un nombre con menos posibilidad de duplicado
        var d = new Date();
        var n = d.getTime();
        fileName = n+ofileName;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        $('#nombreArchivo').val(fileName);
        $('#nombremodArchivo').val(fileName);
        $('#extArchivo').val(fileExtension);

        //obtenemos el size del archivo
        fileSize= file.size;
        var labeltemp = "bytes";
        if (fileSize>=1024 & fileSize<1048576){
            fileSize = fileSize/1024;
            labeltemp= "Kb";
        }else if(fileSize>=1048576){
            fileSize = fileSize/1048576;
            labeltemp= "Mb";
        }
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: " + ofileName + ", peso total: " + fileSize.toFixed(2) + " " + labeltemp +".</span>");
    });

    //al enviar el formulario
    $('#subirArchivo').click(function () {
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
        var message = "";
        if (IsValidFormat(fileExtension) === true) {
            //hacemos la petición ajax  
            $.ajax({
                url: $('.formulario').attr('action'),
                type: 'POST',
                //datos del formulario
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
                    if (IsValidFormat(fileExtension) === true)
                    {
                        $('#nombreArchivo').val(fileName);
                        $('#extArchivo').val(fileExtension);
                        message = $("<span class='success'>El archivo se ha subido correctamente.</span>");
                        showMessage(message);
                    }
//                  habilitado si se ha subido correctamente.
                    document.getElementById("btnAceptarArchivo").disabled = false;
                },
                //si ha ocurrido un error
                error: function () {
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                    showMessage(message);
                }
            });
        }
        else {
            message = $("<span class='error'>Ha ocurrido un error, El archivo no es valido.</span>");
            $('#btnLimpiarPubliArchivo').click();
            showMessage(message);
        }

    });

    function showMessage(message) {
        $(".messages").html("").show();
        $(".messages").html(message);
    }

    function IsValidFormat(extension)
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
            case 'tar':
                return true;
                break;
            case 'gz':
                return true;
                break;
            case 'xls':
                return true;
                break;
            case 'xlsm':
                return true;
                break;
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

function delArchivo(pub,nam, ur){
    CoDel=pub;
    gru=ur;
    $('#nombreDipPubGr').html(nam);
    $("#EliminarPublicacionGrupo").modal();
}

$('#btnEliminarPubGr').on("click", function(e){
    e.preventDefault();
    if (CoDel !== null) {
        $.post("ArchivosController/eliminarPublicacion/", {Cod: CoDel});
     }
     var badge='#badge-grupo'+gru;
     $(badge).hide();
     var num = $(badge).text();
     $(badge).html(parseInt(num)-1);
     $(badge).show();
     var eli='#dip'+CoDel;
    $(eli).hide('slow');
    $('#EliminarPublicacionGrupo').modal('toggle');
});
    
//guarda el registro
$('#botonesArchivo').submit(function (event){
    event.preventDefault();
    var $form = $(this), Titulo = $form.find("input[name='tituloArchivo']").val(),
            Contenido = $form.find("textarea[name='contenidoArchivo']").val(),
            url = $form.attr("action"),
            Nombre = $form.find("input[name='nombreArchivo']").val(),
            Extension = $form.find("input[name='extArchivo']").val(),
            categoria = CCategoria,
            ccategoria = CCategoria;
            grupo = Grupo,
            grupus = CoGrPerUs;

    var posting = $.post(url, {
        Titulo: Titulo,
        Contenido: Contenido,
        Nombre: Nombre,
        Extension: Extension,
        Categoria: categoria,
        CCategoria: ccategoria,
        CodGruPe: grupo,
        CodGruPeUs: grupus
        
    });

    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            //limpia
            $(":text").each(function () {
                $($(this)).val('');
            });
            $(".messages").html("").show();
            document.getElementById("formArchivo").reset();
            document.getElementById("archivotexarea").value = "";
            document.getElementById("btnAceptarArchivo").disabled = true;
            $('#NuevoArchivo').modal("toggle");
            
            var tabla = '#table-g'+Grupo;
            var d = new Date();
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            $(tabla+' tr:first').after('<tr> <td class="Archivo">'+Titulo+'</td>'+
                    '<td class="Descripción">'+Contenido+'</td>'+
                    '<td class="Publicado" >'+curr_year+'-'+curr_month+'-'+curr_date+'</td>'+
                    '<td class="TipoArchivo">'+Extension.toLowerCase()+'</td>'+ 
                    '<td class="TamArchivo" style="width:100px;">'+fileSize.toFixed(2)+'</td>'+
                    '<td class="gestion_dip" style="width:150px;">Acciones se procesaran hasta refrescar la pagina</td>'+
            '</tr>'); 
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
    if (fileName !== null) {
//        Nombre= "" + Nombre;
        $.post("ArchivosController/borrarArchCarpeta/", {Nombre: fileName});
    }
//    alert(Nombre);
   // $(".showImage").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
//    $('#subir').reset();
    document.getElementById("formArchivo").reset();
    document.getElementById("archivotexarea").value = "";
    document.getElementById("btnAceptarArchivo").disabled = true;
    $('#NuevoArchivo').modal("toggle");
});

//boton que elimina el archivo de ala carpeta y limpia el form al dar cancelar, NO cierra la modal depues de dar limpiar
$('#btnLimpiarPubliArchivo').on('click', function (e) {
    e.preventDefault();
    var Nombre = $('#botonesArchivo').find("input[name='nombreArchivo']").val();
//   <?php echo base_url() ?>index.php/PublicacionesController/borrarImgCarpeta/
    if (fileName !== null) {
//        Nombre= "" + Nombre;
        $.post("ArchivosController/borrarArchCarpeta/", {Nombre: fileName});
    }
//    alert(Nombre);
    //$(".showImage").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
//    $('#subir').reset();
    document.getElementById("formArchivo").reset();
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

