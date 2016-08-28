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
var CoPubDel;
var existeImgtemporal=false;
var imgPublicada="";
var idPublicacion="";

$(document).ready(function () {
//    document.getElementById('btnAceptar').disable=true;

    $(".messages").hide();
    //queremos que esta variable sea global
    
    $('#openNuevaPublicacion').click(function(){//se reemplazo para evitar doble modal al hacer clic en el enlace de "Nueva Publicacion"
        $('#NuevaPublicacion').modal('toggle');
    });

    $('#imgform').change(function ()
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
        
        var formData = new FormData($("#imgform")[0]);
        var message = "";
        if (isImage(fileExtension) === true) {
            //hacemos la petición ajax  
            $.ajax({
                url: $('#imgform').attr('action'),
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
                        message = $("<span class='success' style='color:#00b33b;>La imagen ha subido correctamente.</span>");
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
    
    
    
///***********MODIFICACION DE LA IMAGEN**********//    
//Para modificar la imagen de la publicacion
    $('#imgformMod').change(function (){
        if(existeImgtemporal){//verificamos que no exista una imagen temporal subida y no guardada
            var Nombre = $('#botonesMod').find("input[name='nombreImgMod']").val();
            $.post("PublicacionesController/borrarImgCarpeta/", {Nombre: Nombre});
            existeImgtemporal=false;
            $("#showImgMod").html("<img width ='300' heigth='300' src='" + imgPublicada + "' />").show();   
        }
        var file = $("#imagenMod")[0].files[0];
        fileName = file.name;
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        $('#nombreImgMod').val(fileName);
        $('#extImgMod').val(fileExtension);
        var fileSize = file.size;
        $('#msgMod').html("<span class='info'>Archivo para subir: " + fileName
                + ", peso total: " + fileSize + " bytes.</span>").show();
        $("#subirMod").prop('disabled', false);
        
    });
//Sube la imagen modificada
    $('#subirMod').click(function () {
        var formData = new FormData($("#imgformMod")[0]);
        if (isImage(fileExtension) === true) {
            $.ajax({
                url: $('#imgformMod').attr('action'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#msgMod').html("<span class='before'>Subiendo la imagen, por favor espere...</span>").show();
                },
                success: function (data) {
                    if (isImage(fileExtension) === true)
                    {
                        var sizeImg = new Image();
                        sizeImg.src = "/UPE/bootstrap/images/publicaciones/" + fileName;
                        $("#showImgMod").html("<img width ='300' heigth='300' src='/UPE/bootstrap/images/publicaciones/" + fileName + "' />");
                        existeImgtemporal=true;
                        $('#nombreImgMod').val(fileName);
                        $('#extImgMod').val(fileExtension);
                        $('#msgMod').html("<span class='success' style='color:#00b33b;>La imagen ha subido correctamente.</span>");
                    }
                    $("#subirMod").prop('disabled', true);
                },
                error: function () {
                    $('#msgMod').html("<span class='error'>Ha ocurrido un error.</span>").show();
                }
            });
        }
        else {
            $('#msgMod').html("<span class='error'>Ha ocurrido un error, El archivo no es una Imagen.</span>");
        }
    });
    
///***********FIN MODIFICACION DE LA IMAGEN**********//
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
            categoria = $form.find("select[name='categoriasl']").val(),
            cat= $form.find("select[name='categoriasl']").find(":selected").text();//obtiene el nombre de la categoria

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
            $("#showImg").html("");
            $(":text").each(function () {
                $($(this)).val('');
            });
            $(".messages").html("").show();

            document.getElementById("imgform").reset();
            document.getElementById("pubtexarea").value = "";
            document.getElementById("btnAceptar").disabled = true
            //Actualiza la tabla con la nueva publicacion
            $('#tableTitulo tr:first').after('<tr id="diplo'+obj+'"> <td class="Titulo">'+Titulo+'</td>'+
                    '<td class="Categoria">'+cat+'</td>'+
                    '<td class="gestion_dip">'+
                        '<button id="editPublicacion'+obj+'" onclick="editarPublicacion(\''+obj+'\')"  title="Editar Publicacion" class="btnmoddi btn btn-success"><span class=" glyphicon glyphicon-pencil"></span></button> '+
                        '<button id="delPub'+obj+'" onclick="eliminarPublicacion(\''+obj+'\')"  title="Eliminar Publicacion" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>'+
                    '</td>'+
            '</tr>');
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
    $("#showImg").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
    $('#imagen').val(null);
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
    $("#showImg").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $(".messages").html("").show();
    $('#imagen').val(null);
//    $('#subir').reset();
    document.getElementById("imgform").reset();
    document.getElementById("pubtexarea").value = "";
    document.getElementById("btnAceptar").disabled = true;
});


//_________________________ it works already :) ______________________________
function eliminarPublicacion(pub,nam) {//prepara para la eliminacion
    CoPubDel =pub;
    $('#nombreDipPub').html(nam);
    $("#EliminarPublicacion").modal();
}

//elimina la publicacion al confirmar la advertencia
$("#btnEliminarPub").on("click", function(e){
    e.preventDefault();
    if (CoPubDel !== null) {
        $.post("PublicacionesController/eliminarPublicacion/", {Cod: CoPubDel});
     }
     //actualiza la tabla
    var elif='#diplo'+CoPubDel;
    $(elif).hide('slow');
    $('#EliminarPublicacion').modal('toggle');
});

// limpia el form de eliminar al cancelar
$('#btnLimpiarPub').on('click', function (e) {
    e.preventDefault();
    $('#EliminarPublicacion').modal("toggle");
});

//////////////PARA MODIFICAR PUBLICACION///////////////////////////
//carga la publicacion para ser modificada
function editarPublicacion(id){
    var postmod=$.post("PublicacionesController/obtenerPublicacion/", {idpub: id});
    postmod.done(function(data){
        var data=jQuery.parseJSON(data);
        $('#showImgMod').html('<img  width =\'300\' heigth=\'300\' src="/UPE/bootstrap'+data.Ruta+'">');
        $('#selectCategoriaMod option[value="'+data.CodigoCategoriaDiplomado+'"]').attr('selected', 'selected');
        $('#tituloModPub').val(data.Titulo);
        $('#pubtexareaModificacionP').val(data.Contenido);
        imgPublicada="/UPE/bootstrap"+data.Ruta;
        idPublicacion=id;
    });
    $('#ModificarPublicacion').modal('toggle');
}

//limpia y cancela la modificacion
$('#btnCancelarModificacionP').on('click', function (e) {
    e.preventDefault();
    if (existeImgtemporal) {
        var Nombre = $('#botonesMod').find("input[name='nombreImgMod']").val();
        $.post("PublicacionesController/borrarImgCarpeta/", {Nombre: Nombre});
    }
    $('#imagenMod').val('');
    $("#showImgMod").html("");
    $(":text").each(function () {
        $($(this)).val('');
    });
    $("#msgMod").html("").show();
    $('#extImgMod').val("");
    $('#nombreImgMod').val("");
    document.getElementById("imgformMod").reset();
    document.getElementById("pubtexareaModificacionP").value = "";
    $("#subirMod").prop('disabled', true);
    existeImgtemporal=false;
    $('#ModificarPublicacion').modal("toggle");
});

/////////////////ENVIO/////////////////
 $('#botonesMod').submit(function (event){//////GUARDA CAMBIOS
    event.preventDefault();
    var $form = $(this), Titulo = $form.find("input[name='tituloMod']").val(),
            Contenido = $form.find("textarea[name='contenidoMod']").val(),
            url = $form.attr("action"),
            Nombre = $form.find("input[name='nombreImgMod']").val(),
            Extension = $form.find("input[name='extImgMod']").val(),
            categoria = $form.find("select[name='categoriaslMod']").val(),
            cat= $form.find("select[name='categoriaslMod']").find(":selected").text();//obtiene el nombre de la categoria
            if(!existeImgtemporal){
                Extension = "";
                Nombre = "";
            }
    $('#btnAceptarModificacionP').prop('disabled',true);
    
    var posting = $.post(url, {
        PId: idPublicacion,
        Titulo: Titulo,
        Contenido: Contenido,
        Nombre: Nombre,
        Extension: Extension,
        Categoria: categoria
    });

    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            $('#TutuloPubTabla'+idPublicacion).html(Titulo);//actualiza la tabla
            $('#CategoriaPubTabla'+idPublicacion).html(cat);//catualiza la tabla
            $("#showImgMod").html("");
            $(":text").each(function () {
                $($(this)).val('');
            });
            $("#msgMod").html("").show();
            $('#imagenMod').val(null);
            $('#extImgMod').val(null);
            $('#nombreImgMod').val(null);
            $('#botonesMod').find("input[name='nombreImgMod']").val("");
            existeImgtemporal=false;
            idPublicacion="";
            document.getElementById("imgformMod").reset();
            document.getElementById("pubtexareaModificacionP").value = "";
            $("#subirMod").prop('disabled', true);
            $('#btnAceptarModificacionP').prop('disabled',false);
            $("#subirMod").prop('disabled', true);
            $('#ModificarPublicacion').modal("toggle");
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        $('#btnAceptarModificacionP').prop('disabled',false);
        alert("error" + xhr.responseText);
    });
});

////////////PAGINACION DE PUBLICACIONES//////////////
    
    $("#TablaPublicacionesWeb").on("click", "#aFirstPagPubWeb", function (e) {
        paginarPublicaciones("data_ini", $(this).data("datainic"));
    });

    $("#TablaPublicacionesWeb").on("click", "#aLastPagPubWeb", function (e) {
        paginarPublicaciones("data_ini", $(this).data("datainic"));
    });

    $("#TablaPublicacionesWeb").on("click", "#aPrevPagPubWeb", function (e) {
        paginarPublicaciones("data_inip", null);
    });

    $("#TablaPublicacionesWeb").on("click", "#aNextPagPubWeb", function (e) {
        paginarPublicaciones("data_inin", null);
    });
    
    function paginarPublicaciones(dat, op){
        var data_in = $('#txtPagingSearchUsrPubWeb').data("datainic");     
        var url = 'PublicacionesController/paginPublicaciones/';
        var opcion="";
        if(dat==="data_inin"){
             opcion={"data_inin":data_in};
        }else if(dat==="data_inip"){
            opcion={"data_inip":data_in};
        }else if(dat==="data_ini"){
            data_in= op;
            opcion={"data_ini":data_in};
        }
        var posting = $.post(url, opcion);
        posting.done(function (data) {
            if (data !== null) {
                $('#TablaPublicacionesWeb').empty();
                $('#TablaPublicacionesWeb').html(data);
            }
        });
        posting.fail(function (data) {
            alert("Error");
        });
    }