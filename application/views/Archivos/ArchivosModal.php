<?php $this->load->helper('url'); ?> 

<script src="../bootstrap/js/Archivos.js"></script>
<link href="../bootstrap/css/archivos.css" rel="stylesheet">


<!---------Modal para nuevo archivo-------------------------->
<div id="NuevoArchivoMod" class="modal fade decorateStyleCrud" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarDiArchivos"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <legend class="modal-header">Nuevo Archivo</legend> 
                <div class="form-group" class="form-inline" role="form" id="divPubArchivos">

                    <div class="col-lg-9">
                        <!--La linea de abajo abre el selector de imgs -->
                        <form class="formulario" enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>index.php/ArchivosController/do_upload/" id="formArchivo">
                            <fieldset> 
                                <input type="file" size="20" name="archivoArchivo" id="fileArchivo" >
                                <input type="hidden" id="nombremodArchivo" name="nombremodArchivo" value="" readonly>
                                <!--div para visualizar mensajes-->
                                <div class="messages"></div><br /><br />
                                <input type="button" value="Subir el Archivo" class="btn btn-default" id="subirArchivo" />
  
                            </fieldset>
                        </form>
                          <br>
                        <div>
                            <form class="form-group-lg" id="botonesArchivo" method="post" action="<?php echo base_url() ?>index.php/ArchivosController/subirBd/">
                                <!--en las lineas de abajo esta el cuerpo de la publicacion-->
                                <fieldset> 
                                    <label for="categoriasl" class=" control-label">Categoria: </label> 
                                    <!--Listamos las categorias de las publicaciones-->
                                    <span name="categoriasl"  id="CategoriaArchivo">
                                        la categoria
                                    </span>
                                    <br>
                                    <br>
                                    <label for="titulo" class="col-lg-3 control-label">Titulo:</label> 
                                    <input type="text" class="form-control"  placeholder="Titulo o nombre del archivo"  name="tituloArchivo" required>
                                    <!--Los input tipo hidden son para obtener el nombre y la extension de la imagen de la publicacion,-->
                                    <input type="hidden" id="nombreArchivo" name="nombreArchivo" value="" readonly>
                                    <input type="hidden" id="extArchivo" name="extArchivo" value="" readonly>
                                    <br>
                                    <label for="contenidoArchivo" class="col-lg-3 control-label">Descripción:</label>
                                    <textarea  class="form-control"  placeholder="Contenido" name="contenidoArchivo" id="archivotexarea" required></textarea>
                                    <br>
                                    <div class="modal-footer">

                                        <button type="submit" id="btnAceptarArchivo" onclick="" class=" btn btn-default" name="aceptar"  disabled="true">Publicar Archivo</button>
                                        <button type="reset" id="btnLimpiarPubliArchivo" onclick="" class=" btn btn-default" name="Limpiar" >Limpiar</button>
                                        <button type="reset" id="btnCancelarPArchivo" onclick="" class=" btn btn-default" name="cancelar" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </fieldset>
                            </form>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--end modal nuevo-->



<!--Modal para eliminar publicaciones-->
<div id="EliminarPublicacionGrupo" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                <form id="frmDELpubGr" action="" class="form-horizontal" class="form-horizontal" method="post" >
                    <legend class="modal-header">Borrar Archivo:</legend> 
                    <div class="form-group">
                        <div class="col-lg-9">
                            <label>¿Realmente desea eliminar el Archivo <mark id="nombreDipPubGr"></mark>?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="buton" id="btnEliminarPubGr" class=" btn btn-danger btn-ok" name="Eliminar"> SI </button>
                        <button type="button" id="btnCancelarPubGr" class="btn btn-default" data-dismiss="modal" name="Limpiar">NO</button>
                    </div>
                    
                </form>
            </div>
        </div>   
    </div>
</div>

<!--------------------- End modal eliminar Publicaciones  ---------------------->
