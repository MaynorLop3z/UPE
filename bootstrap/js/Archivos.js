//Variables globales 
var codigoUsuarioArc;
var fileExtensionArc = "";
var fileNameArc;
var codigoPubliArc;
var fileSizeArc;
var Grupo;
var Categoria;
var CCategoria;
var CoGrPerUs;
var CoDel;
var gru;
//prepara form para nueva publicacion
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
        fileNameArc = n+ofileName;
        //obtenemos la extensión del archivo
        fileExtensionArc = fileNameArc.substring(fileNameArc.lastIndexOf('.') + 1);
        $('#nombreArchivo').val(fileNameArc);
        $('#nombremodArchivo').val(fileNameArc);
        $('#extArchivo').val(fileExtensionArc);

        //obtenemos el size del archivo
        fileSizeArc= file.size;
        
        if (fileSizeArc>=1024 & fileSizeArc<1048576){
            fileSizeArc = Math.round(fileSizeArc/1024) +" Kb";
        }else if(fileSizeArc>=1048576){
            fileSizeArc = (fileSizeArc/1048576).toFixed(2) +" Mb";
        }else{
            fileSizeArc=fileSizeArc+" bytes";
        }
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: " + ofileName + ", peso total: " + fileSizeArc +".</span>");
    });

    //al enviar el formulario
    $('#subirArchivo').click(function () {
        //información del formulario
        var formData = new FormData($("#formArchivo")[0]);
        var message = "";
        if (IsValidFormat(fileExtensionArc) === true) {
            //hacemos la petición ajax  
            $.ajax({
                url: $('#formArchivo').attr('action'),
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
                    if (IsValidFormat(fileExtensionArc) === true)
                    {
                        $('#nombreArchivo').val(fileNameArc);
                        $('#extArchivo').val(fileExtensionArc);
                        message = $("<span class='success' style='color:#00b33b;'>El archivo se ha subido correctamente.</span>");
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

//guarda el registro nuevo y actualiza tabla
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
            
            var tabla = '#table-g'+Grupo;
            var d = new Date();
            function pad(s) { return (s < 10) ? '0' + s : s; }
            var curr_date = pad(d.getDate());
            var curr_month = pad(d.getMonth()+1);
            var curr_year = d.getFullYear();
            $(tabla+' tr:first').after('<tr id="dip'+obj+'"> <td class="Archivo">'+Titulo+'</td>'+
                    '<td class="Descripción">'+Contenido+'</td>'+
                    '<td class="Publicado" >'+curr_year+'-'+curr_month+'-'+curr_date+'</td>'+
                    '<td class="TipoArchivo">'+Extension.toUpperCase()+'</td>'+ 
                    '<td class="TamArchivo" style="width:100px;">'+fileSizeArc+'</td>'+
                    '<td class="gestion_dip" style="width:150px;">'+
                        '<button id="downArc'+obj+'" onclick="goArchivo(\'ArchivosController/downloads/'+fileNameArc+'\')"  title="Descargar Archivo" class="btndeldip btn btn-warning" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-download-alt"></span></button> '+
                        '<button id="deleArc'+obj+'" onclick="delArchivo(\''+obj+'\',\''+Titulo+'\',\''+Grupo+'\')"  title="Eliminar Archivo" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>'+
                    '</td>'+
            '</tr>');
            var badge='#badge-grupo'+Grupo;
            $(badge).hide();
            var num = $(badge).text();
            $(badge).html(parseInt(num)+1);
            $(badge).show();
            $('#NuevoArchivo').modal("toggle");
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});

// limpia el form al cancelar
$('#btnCancelarPArchivo').on('click', function (e) {
    e.preventDefault();
//    var $form = $(this);
//    var Nombre = $('#botonesArchivo').find("input[name='nombreArchivo']").val();
    if (fileNameArc !== null) {
        $.post("ArchivosController/borrarArchCarpeta/", {Nombre: fileNameArc});
    }
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
    document.getElementById("formArchivo").reset();
    document.getElementById("archivotexarea").value = "";
    document.getElementById("btnAceptarArchivo").disabled = true;
    $('#NuevoArchivo').modal("toggle");
});

//limpia el form al resetear
$('#btnLimpiarPubliArchivo').on('click', function (e) {
    e.preventDefault();
//    var Nombre = $('#botonesArchivo').find("input[name='nombreArchivo']").val();
    if (fileNameArc !== null) {
        $.post("ArchivosController/borrarArchCarpeta/", {Nombre: fileNameArc});
    }
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
    document.getElementById("formArchivo").reset();
    document.getElementById("archivotexarea").value = "";
    document.getElementById("btnAceptarArchivo").disabled = true;
});

//prepara form para eliminar
function delArchivo(pub,nam, ur){
    CoDel=pub;
    gru=ur;
    $('#nombreDipPubGr').html(nam);
    $("#EliminarPublicacionGrupo").modal();
}

//elimina y actualiza tabla
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
    
//-----------------DESCARGAS------------------

//function goArchivo(arch){
  //  location.href = arch;
//}

